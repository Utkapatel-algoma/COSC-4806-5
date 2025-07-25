<?php
// app/controllers/Movie.php

class Movie extends Controller {

    public function index() {
        // Default view for the movie search page
        $this->view('movie/search');
    }

    public function search() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['search_query'])) {
            $searchQuery = trim($_POST['search_query']);

            if (empty($searchQuery)) {
                $_SESSION['toast_message'] = 'Please enter a movie title to search.';
                $_SESSION['toast_type'] = 'info';
                $this->view('movie/search', ['results' => []]); // Show empty results
                return;
            }

            $movieModel = $this->model('Movie');
            $results = $movieModel->searchMovies($searchQuery);

            if ($results) {
                $this->view('movie/search', ['results' => $results, 'query' => $searchQuery]);
            } else {
                $_SESSION['toast_message'] = 'No movies found for "' . htmlspecialchars($searchQuery) . '". Please try a different title.';
                $_SESSION['toast_type'] = 'danger';
                $this->view('movie/search', ['results' => [], 'query' => $searchQuery]);
            }
        } else {
            // If not a POST request or no search query, just show the search form
            $this->view('movie/search');
        }
    }

    public function details($imdbId = '') {
        if (empty($imdbId)) {
            $_SESSION['toast_message'] = 'No movie ID provided.';
            $_SESSION['toast_type'] = 'danger';
            header('Location: /movie'); // Redirect back to search
            exit();
        }

        $movieModel = $this->model('Movie');
        $details = $movieModel->getMovieDetails($imdbId);

        // Fetch user's existing rating and all other ratings for the movie
        $userRating = null;
        $allRatings = [];
        if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
            $ratingModel = $this->model('Rating');
            $userRating = $ratingModel->getUserRating($_SESSION['user_id'], $imdbId);
        }
        $allRatings = $this->model('Rating')->getAllRatingsForMovie($imdbId);


        if ($details) {
            $this->view('movie/details', [
                'details' => $details,
                'user_rating' => $userRating,
                'all_ratings' => $allRatings
            ]);
        } else {
            $_SESSION['toast_message'] = 'Could not retrieve details for the movie.';
            $_SESSION['toast_type'] = 'danger';
            header('Location: /movie'); // Redirect back to search
            exit();
        }
    }

    public function submitRating() {
        // Ensure session is started for session variables if not already
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        // Only logged-in users can submit ratings
        if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
            $_SESSION['toast_message'] = 'You must be logged in to submit a rating.';
            $_SESSION['toast_type'] = 'danger';
            header('Location: /login');
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $imdbId = $_POST['imdb_id'] ?? '';
            $rating = $_POST['rating'] ?? '';
            $userId = $_SESSION['user_id'];

            // Validate inputs
            if (empty($imdbId) || !is_numeric($rating) || $rating < 1 || $rating > 5 || floor($rating) != $rating) {
                $_SESSION['toast_message'] = 'Invalid rating submitted. Rating must be a whole number between 1 and 5.';
                $_SESSION['toast_type'] = 'danger';
                header('Location: /movie/details/' . urlencode($imdbId));
                exit();
            }

            $ratingModel = $this->model('Rating');
            if ($ratingModel->submitRating($userId, $imdbId, (int)$rating)) {
                $_SESSION['toast_message'] = 'Your rating has been submitted successfully!';
                $_SESSION['toast_type'] = 'success';
            } else {
                $_SESSION['toast_message'] = 'Failed to submit your rating. Please try again.';
                $_SESSION['toast_type'] = 'danger';
            }
            header('Location: /movie/details/' . urlencode($imdbId));
            exit();
        } else {
            // Not a POST request, redirect back to movie details
            header('Location: /movie');
            exit();
        }
    }
}
