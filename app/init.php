<?php
// app/init.php

// Error reporting settings (keep these if you want error display controlled by init.php)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// IMPORTANT: All session-related ini_set, session_set_cookie_params, and session_start()
// have been moved to index.php to ensure they are called at the very beginning.
// Do NOT add them back here.

// Require core framework files
require_once 'core/config.php';
require_once CORE . '/App.php';
require_once CORE . '/Controller.php';
require_once CORE . '/database.php';

// Require model files
require_once MODELS . '/User.php';
require_once MODELS . '/Reminder.php' ;
