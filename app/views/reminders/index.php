<?php require_once VIEWS . DS . 'templates/header_private.php'; ?>

    <h1>Your Reminders</h1>
    <a href="/reminders/create">Add New Reminder</a>

    <?php if (!empty($reminders)): ?>
        <table border="1">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Subject</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($reminders as $reminder): ?>
                    <tr>
                        <td><?= htmlspecialchars($reminder['id']); ?></td>
                        <td><?= htmlspecialchars($reminder['subject']); ?></td>
                        <td><?= htmlspecialchars($reminder['created_at']); ?></td>
                        <td>
                            <a href="/reminders/show/<?= htmlspecialchars($reminder['id']); ?>">View</a> |
                            <a href="/reminders/update/<?= htmlspecialchars($reminder['id']); ?>">Edit</a> |
                            <a href="/reminders/delete/<?= htmlspecialchars($reminder['id']); ?>" onclick="return confirm('Are you sure you want to delete this reminder?');">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No reminders found. Add your first reminder!</p>
    <?php endif; ?>

<?php require_once VIEWS . DS . 'templates/footer.php'; ?>