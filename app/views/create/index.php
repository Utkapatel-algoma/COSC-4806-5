<?php require_once VIEWS . DS . 'templates/header_public.php'; ?>

    <h2 class="mb-4">Create New Account</h2>
    <form action="/create/register" method="post">
        <div class="mb-3">
            <label for="username" class="form-label">Username:</label>
            <input type="text" class="form-control" id="username" name="username" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password:</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <button type="submit" class="btn btn-primary">Register</button>
    </form>
    <p class="mt-3">Already have an account? <a href="/login">Login here</a></p>

<?php require_once VIEWS . DS . 'templates/footer.php'; ?>