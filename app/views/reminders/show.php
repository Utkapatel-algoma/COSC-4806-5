<?php require_once VIEWS . DS . 'templates/header_private.php'; ?>

    <h1>Reminder Details</h1>
    <?php if (isset($reminder) && $reminder): ?>
        <p>ID: <?= htmlspecialchars($reminder['id']); ?></p>
        <p>Subject: <?= htmlspecialchars($reminder['subject']); ?></p>
        <p>Created At: <?= htmlspecialchars($reminder['created_at']); ?></p>
    <?php else: ?>
        <p>Reminder not found.</p>
    <?php endif; ?>
    <p><a href="/reminders">Back to Reminders</a></p>

<?php require_once VIEWS . DS . 'templates/footer.php'; ?>