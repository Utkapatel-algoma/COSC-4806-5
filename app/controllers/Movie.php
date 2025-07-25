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

        if ($details) {
            $this->view('movie/details', ['details' => $details]);
        } else {
            $_SESSION['toast_message'] = 'Could not retrieve details for the movie.';
            $_SESSION['toast_type'] = 'danger';
            header('Location: /movie'); // Redirect back to search
            exit();
        }
    }
}
