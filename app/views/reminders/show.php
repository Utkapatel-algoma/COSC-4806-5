<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Show Reminder</title>
</head>
<body>
    <h1>Reminder Details</h1>
    <?php if (isset($reminder) && $reminder): ?>
        <p>Subject: <?= htmlspecialchars($reminder['subject']); ?></p>
        <p>ID: <?= htmlspecialchars($reminder['id']); ?></p>
    <?php else: ?>
        <p>Reminder not found.</p>
    <?php endif; ?>
    <p><a href="/reminders">Back to Reminders</a></p>
</body>
</html>