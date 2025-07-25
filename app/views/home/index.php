<?php
// app/views/home/index.php

require_once TEMPLATES . DIRECTORY_SEPARATOR . 'header_private.php'; // Use DIRECTORY_SEPARATOR
?>

    <h2>Welcome Home!</h2>
    <p>Hello, <?php echo htmlspecialchars($_SESSION['username'] ?? 'Guest'); ?>!</p>
    <p>Today is <?php echo date("F jS, Y"); ?></p>

<?php require_once TEMPLATES . DIRECTORY_SEPARATOR . 'footer.php'; // Use DIRECTORY_SEPARATOR ?>
