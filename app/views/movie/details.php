<?php
// app/views/movie/details.php

// Include the header template
require_once TEMPLATES . DIRECTORY_SEPARATOR . 'header_private.php';

$movie = $data['details']; // Get movie details from passed data
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

            <h2 class="text-2xl font-bold text-gray-800 mb-3">Ratings</h2>
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

            <div class="mt-6 flex flex-wrap gap-4">
                <a href="/movie" class="bg-gray-500 hover:bg-gray-600 text-white font-semibold py-2 px-4 rounded-md shadow-md transition duration-300 ease-in-out transform hover:scale-105">
                    Back to Search
                </a>
                <!-- Placeholder for "Give Rating" and "Get AI Review" buttons - will be added in later commits -->
                <button class="bg-purple-600 hover:bg-purple-700 text-white font-semibold py-2 px-4 rounded-md shadow-md transition duration-300 ease-in-out transform hover:scale-105">
                    Give Rating (Coming Soon)
                </button>
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
