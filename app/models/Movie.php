<?php
// app/models/Movie.php

class Movie {
    private $omdbApiKey;

    public function __construct() {
        // Constructor to initialize with the OMDB API key from config
        $this->omdbApiKey = OMDB_API_KEY;
    }

    /**
     * Searches for movies by title using the OMDB API.
     * @param string $title The movie title to search for.
     * @return array|false Returns an array of movie results or false on API error.
     */
    public function searchMovies($title) {
        $url = "http://www.omdbapi.com/?s=" . urlencode($title) . "&apikey=" . $this->omdbApiKey;

        // Use cURL to make the API request
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($httpCode != 200) {
            error_log("OMDB API Search Error: HTTP Code " . $httpCode . " for title: " . $title);
            return false; // Indicate API error
        }

        $data = json_decode($response, true);

        if ($data && $data['Response'] == 'True') {
            return $data['Search']; // Return the array of search results
        } else {
            // No movies found or API returned an error message
            error_log("OMDB API Search Response Error: " . ($data['Error'] ?? 'Unknown Error') . " for title: " . $title);
            return false;
        }
    }

    /**
     * Fetches detailed information for a single movie by IMDB ID.
     * @param string $imdbId The IMDB ID of the movie.
     * @return array|false Returns an associative array of movie details or false on API error/not found.
     */
    public function getMovieDetails($imdbId) {
        $url = "http://www.omdbapi.com/?i=" . urlencode($imdbId) . "&apikey=" . $this->omdbApiKey . "&plot=full";

        // Use cURL to make the API request
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($httpCode != 200) {
            error_log("OMDB API Details Error: HTTP Code " . $httpCode . " for IMDB ID: " . $imdbId);
            return false; // Indicate API error
        }

        $data = json_decode($response, true);

        if ($data && $data['Response'] == 'True') {
            return $data; // Return the full movie details array
        } else {
            // Movie not found or API returned an error message
            error_log("OMDB API Details Response Error: " . ($data['Error'] ?? 'Unknown Error') . " for IMDB ID: " . $imdbId);
            return false;
        }
    }
}
