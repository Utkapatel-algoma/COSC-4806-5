<?php
// app/controllers/home.php

// Ensure session is started for access checks and user data
// This check is good practice, but session_start() should ideally be in index.php
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
        $user = $this->model('User');
        $user->name = $name; // This sets a property on the User model instance
        $this->view('home/index', ['name' => $user->name]);
    }
}
