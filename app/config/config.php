<?php
// app/config/config.php

// Define Directory Separator for cross-platform compatibility
define('DS', DIRECTORY_SEPARATOR);

// Define base paths for consistency
define('APPROOT', dirname(dirname(__FILE__))); // This should resolve to your 'app' directory
define('URLROOT', 'http://localhost'); // Change this to your Replit URL if needed
define('SITENAME', 'ReviewBox'); // Updated site name

// Database credentials (from your existing setup)
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'your_database_name'); // Replace with your actual database name

// OMDB API Key - IMPORTANT: Get your own key from http://www.omdbapi.com/apikey.aspx
define('OMDB_API_KEY', 'YOUR_OMDB_API_KEY_HERE'); // <<< REPLACE THIS WITH YOUR ACTUAL OMDB API KEY

// Define paths for MVC components
define('CORE', APPROOT . DS . 'core');
define('CONTROLLERS', APPROOT . DS . 'controllers');
define('MODELS', APPROOT . DS . 'models');
define('VIEWS', APPROOT . DS . 'views');
// Corrected TEMPLATES path to be inside 'views' directory
define('TEMPLATES', APPROOT . DS . 'views' . DS . 'templates'); // <<< CORRECTED PATH

