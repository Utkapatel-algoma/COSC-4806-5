<?php
// app/views/movie/search.php

// Include the header template
require_once TEMPLATES . DIRECTORY_SEPARATOR . 'header_private.php';
?>

<div class="container mx-auto p-4 md:p-8">
    <h1 class="text-3xl font-bold text-gray-800 mb-6 text-center">Search for Movies</h1>

    <div class="max-w-xl mx-auto bg-white p-6 rounded-lg shadow-md mb-8">
        <form action="/movie/search" method="POST" class="flex flex-col md:flex-row gap-4">
            <input
                type="text"
                name="search_query"
                placeholder="Enter movie title..."
                value="<?= htmlspecialchars($data['query'] ?? '') ?>"
                class="flex-grow p-3 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                required
            >
            <button
                type="submit"
                class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-6 rounded-md shadow-lg transition duration-300 ease-in-out transform hover:scale-105"
            >
                Search
            </button>
        </form>
    </div>

    <?php if (isset($data['results']) && !empty($data['results'])): ?>
        <h2 class="text-2xl font-semibold text-gray-700 mb-4 text-center">Search Results for "<?= htmlspecialchars($data['query']) ?>"</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            <?php foreach ($data['results'] as $movie): ?>
                <div class="bg-white rounded-lg shadow-md overflow-hidden transform hover:scale-105 transition duration-300 ease-in-out">
                    <img
                        src="<?= ($movie['Poster'] !== 'N/A') ? htmlspecialchars($movie['Poster']) : 'https://placehold.co/300x450/cccccc/333333?text=No+Poster' ?>"
                        alt="<?= htmlspecialchars($movie['Title']) ?> Poster"
                        class="w-full h-72 object-cover"
                        onerror="this.onerror=null;this.src='https://placehold.co/300x450/cccccc/333333?text=No+Poster';"
                    >
                    <div class="p-4">
                        <h3 class="text-xl font-bold text-gray-900 mb-2"><?= htmlspecialchars($movie['Title']) ?></h3>
                        <p class="text-gray-600 text-sm mb-3">Year: <?= htmlspecialchars($movie['Year']) ?></p>
                        <a
                            href="/movie/details/<?= htmlspecialchars($movie['imdbID']) ?>"
                            class="block text-center bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-4 rounded-md transition duration-300 ease-in-out"
                        >
                            View Details
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php elseif (isset($data['query']) && !empty($data['query'])): ?>
        <p class="text-center text-gray-600 text-lg mt-8">No movies found for "<?= htmlspecialchars($data['query']) ?>". Please try a different title.</p>
    <?php else: ?>
        <p class="text-center text-gray-600 text-lg mt-8">Start by searching for your favorite movies!</p>
    <?php endif; ?>
</div>

<?php
// Include the footer template
require_once TEMPLATES . DIRECTORY_SEPARATOR . 'footer.php';
?>
