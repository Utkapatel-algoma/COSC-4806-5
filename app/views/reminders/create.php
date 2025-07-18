<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Reminder</title>
</head>
<body>
    <h1>Create New Reminder</h1>
    <form action="/reminders/store" method="post">
        <label for="subject">Reminder Subject:</label><br>
        <input type="text" id="subject" name="subject" required><br><br>
        <input type="submit" value="Add Reminder">
        <a href="/reminders">Cancel</a>
    </form>
</body>
</html>