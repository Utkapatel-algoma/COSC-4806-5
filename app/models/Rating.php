<?php
// app/models/Rating.php

class Rating {
    private $db;

    public function __construct() {
        // Establish database connection
        $this->db = db_connect();
    }

    /**
     * Submits a new movie rating or updates an existing one.
     * @param int $userId The ID of the user submitting the rating.
     * @param string $imdbId The IMDB ID of the movie.
     * @param int $rating The rating value (1-5).
     * @return bool True on success, false on failure.
     */
    public function submitRating($userId, $imdbId, $rating) {
        // Check if a rating already exists for this user and movie
        $stmt = $this->db->prepare("SELECT id FROM movie_ratings WHERE user_id = ? AND imdb_id = ?");
        $stmt->execute([$userId, $imdbId]);
        $existingRating = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($existingRating) {
            // Update existing rating
            $stmt = $this->db->prepare("UPDATE movie_ratings SET rating = ?, created_at = CURRENT_TIMESTAMP WHERE id = ?");
            return $stmt->execute([$rating, $existingRating['id']]);
        } else {
            // Insert new rating
            $stmt = $this->db->prepare("INSERT INTO movie_ratings (user_id, imdb_id, rating) VALUES (?, ?, ?)");
            return $stmt->execute([$userId, $imdbId, $rating]);
        }
    }

    /**
     * Gets a user's rating for a specific movie.
     * @param int $userId The ID of the user.
     * @param string $imdbId The IMDB ID of the movie.
     * @return int|null The rating value (1-5) if found, null otherwise.
     */
    public function getUserRating($userId, $imdbId) {
        $stmt = $this->db->prepare("SELECT rating FROM movie_ratings WHERE user_id = ? AND imdb_id = ?");
        $stmt->execute([$userId, $imdbId]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ? (int)$result['rating'] : null;
    }

    /**
     * Gets all ratings for a specific movie.
     * @param string $imdbId The IMDB ID of the movie.
     * @return array An array of all ratings for the movie, including username.
     */
    public function getAllRatingsForMovie($imdbId) {
        $stmt = $this->db->prepare("SELECT mr.rating, mr.created_at, u.username
                                     FROM movie_ratings mr
                                     JOIN users u ON mr.user_id = u.id
                                     WHERE mr.imdb_id = ?
                                     ORDER BY mr.created_at DESC");
        $stmt->execute([$imdbId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
