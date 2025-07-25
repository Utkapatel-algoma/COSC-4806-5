<?php
// app/controllers/Home.php

// Ensure session is started for access checks and user data
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// ACL check: If user is not logged in, redirect to login page
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: /login');
    exit();
}

class Home extends Controller {

    public function index($name = '') {
        // We don't need to instantiate the User model just to pass a name to the view.
        // If you needed to fetch user-specific data, you would use the model here.
        // $user = $this->model('User');
        // $user->name = $name; // This line is causing the deprecated warning

        // Pass the $name directly to the view
        $this->view('home/index', ['name' => $name]);
    }
}
