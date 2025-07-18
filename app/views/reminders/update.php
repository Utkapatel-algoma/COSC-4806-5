<?php require_once VIEWS . DS . 'templates/header_private.php'; ?>

    <h1>Update Reminder</h1>
    <?php if (isset($reminder) && $reminder): ?>
        <form action="/reminders/saveUpdate" method="post">
            <input type="hidden" name="id" value="<?= htmlspecialchars($reminder['id']); ?>">
            <label for="subject">Reminder Subject:</label><br>
            <input type="text" id="subject" name="subject" value="<?= htmlspecialchars($reminder['subject']); ?>" required><br><br>
            <input type="submit" value="Save Changes">
            <a href="/reminders">Cancel</a>
        </form>
    <?php else: ?>
        <p>Reminder not found for update.</p>
    <?php endif; ?>

<?php require_once VIEWS . DS . 'templates/footer.php'; ?>