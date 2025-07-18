<?php require_once VIEWS . DS . 'templates/header_private.php'; ?>

    <h1>Create New Reminder</h1>
    <form action="/reminders/store" method="post">
        <label for="subject">Reminder Subject:</label><br>
        <input type="text" id="subject" name="subject" required><br><br>
        <input type="submit" value="Add Reminder">
        <a href="/reminders">Cancel</a>
    </form>

<?php require_once VIEWS . DS . 'templates/footer.php'; ?>