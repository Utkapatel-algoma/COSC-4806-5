<?php

class App {

    protected $controller = 'login';
    protected $method = 'index';
    protected $special_url = ['apply']; // Example of special URLs
    protected $params = [];

    public function __construct() {
        // Start session if not already started
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $url = $this->parseUrl();

        // Determine the requested controller from the URL
        $requested_controller = isset($url[1]) ? strtolower($url[1]) : $this->controller;

        // Check if controller file exists. If not, fallback to default or handle error.
        if (file_exists(CONTROLLERS . DS . $requested_controller . '.php')) {
            $this->controller = $requested_controller;
        } else {
            // If requested controller does not exist
            if (isset($_SESSION['auth']) && $_SESSION['auth'] == 1) {
                // If authenticated, redirect to home for invalid controller
                $this->controller = 'home';
                header('Location: /home');
                exit;
            } else {
                // If not authenticated, default to login controller for invalid controller
                $this->controller = 'login';
            }
        }

        // --- Authentication and Access Control ---
        // If user is NOT authenticated AND trying to access a restricted page (not login or create)
        if (!isset($_SESSION['auth']) || $_SESSION['auth'] != 1) {
            if ($this->controller !== 'login' && $this->controller !== 'create') {
                // Set an error message if they try to access a private page directly
                $_SESSION['toast_message'] = 'Please login to access this page.'; // Using toast for this
                $_SESSION['toast_type'] = 'warning';
                header('Location: /login'); // Redirect to login page
                exit;
            }
        } else {
            // If user IS authenticated and trying to access 'login' or 'create'
            if ($this->controller === 'login' || $this->controller === 'create') {
                header('Location: /home'); // Redirect to home page
                exit;
            }
        }
        // --- End Authentication and Access Control ---

        $_SESSION['controller'] = $this->controller; // Store current controller in session

        require_once CONTROLLERS . DS . $this->controller . '.php';
        $this->controller = new $this->controller;

        // Determine the method
        $this->method = 'index'; // Default method
        if (isset($url[2]) && method_exists($this->controller, $url[2])) {
            $this->method = $url[2];
        }

        $_SESSION['method'] = $this->method; // Store current method in session

        // Prepare parameters
        $this->params = $url ? array_values(array_slice($url, 2)) : [];
        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    public function parseUrl() {
        $u = $_SERVER['REQUEST_URI'] ?? '';
        $u = strtok($u, '?');
        $u = strtok($u, '#');
        $url = explode('/', filter_var(rtrim($u, '/'), FILTER_SANITIZE_URL));
        if (empty($url[0])) {
            unset($url[0]);
        }
        return $url;
    }
}