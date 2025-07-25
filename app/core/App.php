<?php
// app/core/App.php

class App {
    protected $controller = 'Home'; // Default controller (capitalized)
    protected $method = 'index';    // Default method
    protected $params = [];         // Default parameters

    public function __construct() {
        $url = $this->parseUrl();

        // Determine the base path for controllers
        $controllerBasePath = APPROOT . DIRECTORY_SEPARATOR . 'controllers' . DIRECTORY_SEPARATOR;

        // Check if a controller exists in the 'controllers' directory
        // Use the default controller if $url[0] is not set or empty
        $requestedController = isset($url[0]) && !empty($url[0]) ? ucfirst($url[0]) : $this->controller;

        $controllerFilePath = $controllerBasePath . $requestedController . '.php';

        if (file_exists($controllerFilePath)) {
            $this->controller = $requestedController;
            unset($url[0]);
        } else {
            // If the requested controller doesn't exist, fall back to the default 'Home' controller
            // Ensure the default controller file exists
            $defaultControllerFilePath = $controllerBasePath . $this->controller . '.php';
            if (!file_exists($defaultControllerFilePath)) {
                die("Fatal Error: Default controller '" . $this->controller . ".php' not found at path: " . $defaultControllerFilePath . ". Please ensure it exists in app/controllers.");
            }
            // No need to change $this->controller as it's already set to 'Home'
        }

        // Include the controller file
        require_once $controllerBasePath . $this->controller . '.php';

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
