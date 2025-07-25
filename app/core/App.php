<?php
// app/core/App.php

class App {
    protected $controller = 'home'; // Default controller
    protected $method = 'index';    // Default method
    protected $params = [];         // Default parameters

    public function __construct() {
        $url = $this->parseUrl();

        // Determine the base path for controllers
        // __DIR__ gives the directory of the current file (app/core)
        // dirname(__DIR__) goes up one level to 'app'
        // dirname(dirname(__DIR__)) goes up another level to 'workspace' (project root)
        // So, we need to go up two levels from app/core to get to the project root,
        // then append app/controllers.
        $controllerBasePath = dirname(__DIR__) . '/controllers/';


        // --- DEBUGGING START ---
        error_log("Parsed URL: " . print_r($url, true));
        $requestedControllerName = ucfirst($url[0] ?? $this->controller);
        $controllerFilePath = $controllerBasePath . $requestedControllerName . '.php';
        error_log("Attempting to load controller (Absolute Path): " . $controllerFilePath);
        error_log("File exists check: " . (file_exists($controllerFilePath) ? 'TRUE' : 'FALSE'));
        // --- DEBUGGING END ---

        // Check if a controller exists in the 'controllers' directory
        // Use the default controller if $url[0] is not set or empty
        $requestedController = isset($url[0]) && !empty($url[0]) ? ucfirst($url[0]) : ucfirst($this->controller); // Ensure default is also capitalized

        if (file_exists($controllerBasePath . $requestedController . '.php')) {
            $this->controller = $requestedController; // Store the capitalized name
            unset($url[0]);
        } else {
            // If the requested controller doesn't exist, fall back to the default 'home' controller
            // and log a warning if it's not the default that was requested
            if (isset($url[0]) && !empty($url[0]) && $url[0] !== 'home') {
                error_log("Controller '" . $url[0] . "' not found. Falling back to default 'home' controller.");
            }
            // Ensure the default controller file exists using the absolute path
            if (!file_exists($controllerBasePath . ucfirst($this->controller) . '.php')) {
                die("Fatal Error: Default controller '" . ucfirst($this->controller) . ".php' not found at path: " . $controllerBasePath . ucfirst($this->controller) . ".php" . ". Please ensure it exists in app/controllers.");
            }
            // The default controller 'home' is already set, no need to change $this->controller
            // However, we must ensure $this->controller is capitalized for the require_once below
            $this->controller = ucfirst($this->controller);
        }


        // Include the controller file using the absolute path
        require_once $controllerBasePath . $this->controller . '.php'; // Use the potentially capitalized $this->controller

        // Instantiate the controller
        $this->controller = new $this->controller;

        // Check for method
        if (isset($url[1])) {
            if (method_exists($this->controller, $url[1])) {
                $this->method = $url[1];
                unset($url[1]);
            }
        }

        // Get parameters
        $this->params = $url ? array_values($url) : [];

        // Call the controller method with parameters
        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    public function parseUrl() {
        if (isset($_GET['url'])) {
            return $url = explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
        }
        return []; // Return an empty array if no URL is set
    }
}
