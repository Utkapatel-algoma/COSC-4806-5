<?php
// index.php - Main Application Entry Point

// IMPORTANT: All session-related ini_set and session_set_cookie_params MUST be set
// BEFORE session_start() is called.
ini_set('session.gc_maxlifetime', 28800);
ini_set('session.gc_probability', 1);
ini_set('session.gc_divisor', 1);
$sessionCookieExpireTime = 28800;
session_set_cookie_params($sessionCookieExpireTime);

// session_start() MUST be the very first thing in your application
// before any output is sent to the browser.
// This ensures that session variables (like $_SESSION['logged_in'], $_SESSION['user_role'])
// are available and persist across page requests.
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Ensure error reporting is set up early
error_reporting(E_ALL);
ini_set('display_errors', 1);


// require_once 'app/init.php';
// IMPORTANT: You MUST remove the session_start(), ini_set('session.gc_maxlifetime', ...),
// ini_set('session.gc_probability', ...), ini_set('session.gc_divisor', ...),
// and session_set_cookie_params(...) calls from your app/init.php file.
// Only the require_once statements for core files should remain in init.php.
require_once 'app/init.php';

// Instantiate your main application class
$app = new App;
