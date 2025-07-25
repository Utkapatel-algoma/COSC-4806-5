<?php
// app/init.php

// Error reporting settings (keep these if you want error display controlled by init.php)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// IMPORTANT: All session-related ini_set, session_set_cookie_params, and session_start()
// have been moved to index.php to ensure they are called at the very beginning.
// Do NOT add them back here.

// IMPORTANT: Removed require_once 'core/config.php'; as it's now loaded in index.php
// This file should now only require core framework files and model files.

// Since constants like CORE, MODELS, etc., are defined in config.php (loaded in index.php),
// and DS is also defined there, we need to ensure they are accessible.
// If DS is still undefined here, we will use DIRECTORY_SEPARATOR directly.

// Require core framework files using DIRECTORY_SEPARATOR for robustness
// Assuming APPROOT is defined and available from index.php -> config.php
require_once APPROOT . DIRECTORY_SEPARATOR . 'core' . DIRECTORY_SEPARATOR . 'App.php';
require_once APPROOT . DIRECTORY_SEPARATOR . 'core' . DIRECTORY_SEPARATOR . 'Controller.php';
require_once APPROOT . DIRECTORY_SEPARATOR . 'core' . DIRECTORY_SEPARATOR . 'database.php';

// Require model files
require_once APPROOT . DIRECTORY_SEPARATOR . 'models' . DIRECTORY_SEPARATOR . 'User.php';
require_once APPROOT . DIRECTORY_SEPARATOR . 'models' . DIRECTORY_SEPARATOR . 'Reminder.php' ;
require_once APPROOT . DIRECTORY_SEPARATOR . 'models' . DIRECTORY_SEPARATOR . 'Movie.php';
