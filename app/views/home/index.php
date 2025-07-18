<?php require_once VIEWS . DS . 'templates/header_private.php'; ?>

    <h2>Welcome Home!</h2>
    <p>Hello, <?php echo htmlspecialchars($_SESSION['username'] ?? 'Guest'); ?>!</p>
    <p>Today is <?php echo date("F jS, Y"); ?></p>

<?php require_once VIEWS . DS . 'templates/footer.php'; ?>