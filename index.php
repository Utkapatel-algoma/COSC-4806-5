<?php
// index.php - Main Application Entry Point

// Load the configuration file FIRST, as it defines crucial constants like DS, CORE, MODELS, etc.
require_once 'app/config/config.php'; // <<< MOVED config.php inclusion here, to the very top

// Ensure error reporting is set up early
error_reporting(E_ALL);
ini_set('display_errors', 1);

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

// Now load the initialization file.
// app/init.php should NOT contain session-related ini_set, session_set_cookie_params, or session_start().
// It also should NOT require config.php.
require_once 'app/init.php';

// Instantiate your main application class
$app = new App;
