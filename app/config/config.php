<?php
// app/config/config.php

// Define Directory Separator for cross-platform compatibility
define('DS', DIRECTORY_SEPARATOR);

// Define base paths for consistency
define('APPROOT', dirname(dirname(__FILE__))); // This should resolve to your 'app' directory
define('URLROOT', 'https://27b67e5e-8cd5-4ab2-aa74-85bad9f61387-00-fkp37w95b75o.spock.replit.dev'); // <<< IMPORTANT: REPLACE THIS with your actual Replit URL (e.g., https://your-repl-name.your-username.repl.co)
define('SITENAME', 'ReviewBox'); // Updated site name

// Database credentials for Filess.io
define('DB_HOST', '5f8v8.h.filess.io'); // <<< REPLACE with your Filess.io Host
define('DB_USER', 'cosc4806_mousefatup'); // <<< REPLACE with your Filess.io Username
define('DB_PASS', 'Assi2.'); // <<< REPLACE with your Filess.io Password
define('DB_NAME', 'cosc4806_mousefatup'); // Database name from your screenshot
define('DB_DATABASE', DB_NAME); // Define DB_DATABASE for consistency with database.php
define('DB_PORT', '3306'); // Default MySQL port, adjust if Filess.io provides a different one

// OMDB API Key - IMPORTANT: Get your own key from http://www.omdbapi.com/apikey.aspx
define('OMDB_API_KEY', '484f806d'); // <<< REPLACE THIS WITH YOUR ACTUAL OMDB API KEY

// Define paths for MVC components
define('CORE', APPROOT . DS . 'core');
define('CONTROLLERS', APPROOT . DS . 'controllers');
define('MODELS', APPROOT . DS . 'models');
define('VIEWS', APPROOT . DS . 'views');
// Corrected TEMPLATES path to be inside 'views' directory
define('TEMPLATES', APPROOT . DS . 'views' . DS . 'templates');

