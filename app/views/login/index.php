<?php require_once VIEWS . DS . 'templates/header_public.php'; ?>

    <h2 class="mb-4">Login Page</h2>
    <form action="/login/verify" method="post">
        <div class="mb-3">
            <label for="username" class="form-label">Username:</label>
            <input type="text" class="form-control" id="username" name="username" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password:</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <button type="submit" class="btn btn-primary">Login</button>
    </form>
    <p class="mt-3">Don't have an account? <a href="/create">Create a new account</a></p>

<?php require_once VIEWS . DS . 'templates/footer.php'; ?>