<?php
// app/views/movie/details.php

// Include the header template
require_once TEMPLATES . DIRECTORY_SEPARATOR . 'header_private.php';

$movie = $data['details']; // Get movie details from passed data
$userRating = $data['user_rating'] ?? null; // Get user's existing rating
$allRatings = $data['all_ratings'] ?? []; // Get all ratings for the movie
?>

<div class="container mx-auto p-4 md:p-8">
    <div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow-lg flex flex-col md:flex-row items-start gap-8">
        <div class="md:w-1/3 flex-shrink-0">
            <img
                src="<?= ($movie['Poster'] !== 'N/A') ? htmlspecialchars($movie['Poster']) : 'https://placehold.co/300x450/cccccc/333333?text=No+Poster' ?>"
                alt="<?= htmlspecialchars($movie['Title']) ?> Poster"
                class="w-full h-auto rounded-lg shadow-md object-cover"
                onerror="this.onerror=null;this.src='https://placehold.co/300x450/cccccc/333333?text=No+Poster';"
            >
        </div>
        <div class="md:w-2/3">
            <h1 class="text-4xl font-extrabold text-gray-900 mb-3"><?= htmlspecialchars($movie['Title']) ?></h1>
            <p class="text-gray-600 text-lg mb-4">
                <span class="font-semibold">Year:</span> <?= htmlspecialchars($movie['Year']) ?> |
                <span class="font-semibold">Rated:</span> <?= htmlspecialchars($movie['Rated']) ?> |
                <span class="font-semibold">Runtime:</span> <?= htmlspecialchars($movie['Runtime']) ?>
            </p>

            <p class="text-gray-700 text-base mb-4"><?= htmlspecialchars($movie['Plot']) ?></p>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-y-2 gap-x-6 text-gray-800 mb-6">
                <p><span class="font-semibold">Genre:</span> <?= htmlspecialchars($movie['Genre']) ?></p>
                <p><span class="font-semibold">Director:</span> <?= htmlspecialchars($movie['Director']) ?></p>
                <p><span class="font-semibold">Writer:</span> <?= htmlspecialchars($movie['Writer']) ?></p>
                <p><span class="font-semibold">Actors:</span> <?= htmlspecialchars($movie['Actors']) ?></p>
                <p><span class="font-semibold">Language:</span> <?= htmlspecialchars($movie['Language']) ?></p>
                <p><span class="font-semibold">Country:</span> <?= htmlspecialchars($movie['Country']) ?></p>
                <p><span class="font-semibold">Awards:</span> <?= htmlspecialchars($movie['Awards']) ?></p>
                <p><span class="font-semibold">IMDB Rating:</span> <?= htmlspecialchars($movie['imdbRating']) ?>/10 (<?= htmlspecialchars($movie['imdbVotes']) ?> votes)</p>
            </div>

            <h2 class="text-2xl font-bold text-gray-800 mb-3">Ratings from OMDB</h2>
            <div class="flex flex-wrap gap-4 mb-6">
                <?php if (!empty($movie['Ratings'])): ?>
                    <?php foreach ($movie['Ratings'] as $rating): ?>
                        <div class="bg-blue-100 text-blue-800 text-sm font-medium px-3 py-1 rounded-full">
                            <?= htmlspecialchars($rating['Source']) ?>: <?= htmlspecialchars($rating['Value']) ?>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p class="text-gray-600">No external ratings available.</p>
                <?php endif; ?>
            </div>

            <!-- User Rating Section -->
            <h2 class="text-2xl font-bold text-gray-800 mb-3">Your Rating</h2>
            <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true): ?>
                <div class="bg-gray-50 p-4 rounded-lg shadow-inner mb-6">
                    <form action="/movie/submitRating" method="POST">
                        <input type="hidden" name="imdb_id" value="<?= htmlspecialchars($movie['imdbID']) ?>">
                        <label for="rating-range" class="block text-lg font-medium text-gray-700 mb-2">
                            Rate this movie (1-5):
                            <span id="rating-value" class="ml-2 text-blue-600 font-bold">
                                <?= $userRating !== null ? htmlspecialchars($userRating) : '?' ?>
                            </span>
                        </label>
                        <input
                            type="range"
                            class="form-range w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer accent-blue-600"
                            id="rating-range"
                            name="rating"
                            min="1"
                            max="5"
                            step="1"
                            value="<?= $userRating !== null ? htmlspecialchars($userRating) : '3' ?>"
                            oninput="document.getElementById('rating-value').innerText = this.value"
                        >
                        <button
                            type="submit"
                            class="mt-4 bg-purple-600 hover:bg-purple-700 text-white font-semibold py-2 px-4 rounded-md shadow-md transition duration-300 ease-in-out transform hover:scale-105"
                        >
                            <?= $userRating !== null ? 'Update Rating' : 'Submit Rating' ?>
                        </button>
                    </form>
                </div>
            <?php else: ?>
                <p class="text-gray-600 mb-6">Please <a href="/login" class="text-blue-600 hover:underline">log in</a> to submit your rating.</p>
            <?php endif; ?>

            <!-- All User Ratings Section -->
            <h2 class="text-2xl font-bold text-gray-800 mb-3">User Reviews</h2>
            <div class="space-y-4 mb-6">
                <?php if (!empty($allRatings)): ?>
                    <?php foreach ($allRatings as $ratingEntry): ?>
                        <div class="bg-gray-50 p-4 rounded-lg shadow-inner">
                            <p class="text-gray-800 font-semibold">
                                <?= htmlspecialchars($ratingEntry['username']) ?> rated:
                                <span class="text-blue-600 font-bold text-xl ml-1"><?= htmlspecialchars($ratingEntry['rating']) ?>/5</span>
                            </p>
                            <p class="text-gray-500 text-sm mt-1">
                                Rated on: <?= date('F j, Y, g:i a', strtotime($ratingEntry['created_at'])) ?>
                            </p>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p class="text-gray-600">No user ratings yet. Be the first to rate this movie!</p>
                <?php endif; ?>
            </div>


            <div class="mt-6 flex flex-wrap gap-4">
                <a href="/movie" class="bg-gray-500 hover:bg-gray-600 text-white font-semibold py-2 px-4 rounded-md shadow-md transition duration-300 ease-in-out transform hover:scale-105">
                    Back to Search
                </a>
                <button class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-4 rounded-md shadow-md transition duration-300 ease-in-out transform hover:scale-105">
                    Get AI Review (Coming Soon)
                </button>
            </div>
        </div>
    </div>
</div>

<?php
// Include the footer template
require_once TEMPLATES . DIRECTORY_SEPARATOR . 'footer.php';
?>
