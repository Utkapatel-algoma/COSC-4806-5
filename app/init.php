<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

ini_set('session.gc_maxlifetime', 28800);
ini_set('session.gc_probability', 1);
ini_set('session.gc_divisor', 1);
$sessionCookieExpireTime = 28800;
session_set_cookie_params($sessionCookieExpireTime);
session_start();

require_once 'core/config.php';

require_once CORE . '/App.php';
require_once CORE . '/Controller.php';
require_once CORE . '/database.php';
require_once MODELS . '/User.php';
require_once MODELS . '/Reminder.php';