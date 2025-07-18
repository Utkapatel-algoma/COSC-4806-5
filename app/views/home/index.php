<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>
<body>
    <h1>Welcome Home!</h1>
    <p>Hello, <?php echo htmlspecialchars($_SESSION['username'] ?? 'Guest'); ?>!</p>
    <p>Today is <?php echo date("F jS, Y"); ?></p>
    <p><a href="/logout">Click here to logout</a></p>
    <p><a href="/reminders">View Reminders</a></p>
</body>
</html>