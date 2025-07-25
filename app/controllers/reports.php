<?php
// app/controllers/reports.php

// Ensure session is started for access checks and user data
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Access Control List (ACL) Check:
// Only allow access if the user is logged in AND their role is 'admin'.
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true || !isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') {
    // If not an admin or not logged in, redirect to the login page
    header('Location: /login');
    exit();
}

// If the user passes the ACL check, then proceed with the controller logic
class Reports extends Controller {

    public function index() {
        // This is where your reports page logic would go.
        // For now, we'll just load a view.
        $this->view('reports/index');
    }

    // You can add other methods for specific report functionalities here
    // public function userActivity() {
    //     // Logic for user activity report
    //     $this->view('reports/user_activity');
    // }
}
