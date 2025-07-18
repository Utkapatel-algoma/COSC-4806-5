<?php

class App {

    protected $controller = 'login'; // Default controller
    protected $method = 'index'; // Default method
    protected $params = []; // URL parameters

    public function __construct() {
        // Start session if not already started
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $url = $this->parseUrl();

        // Determine the controller from the URL
        $requested_controller = isset($url[1]) ? strtolower($url[1]) : $this->controller;

        // Check if the controller file exists
        if (file_exists(CONTROLLERS . DS . $requested_controller . '.php')) {
            $this->controller = $requested_controller;
        } else {
            // If requested controller does not exist, check authentication
            if (isset($_SESSION['auth']) && $_SESSION['auth'] == 1) {
                // Authenticated: Redirect to home if controller is invalid
                header('Location: /home');
                exit;
            } else {
                // Not authenticated: Default to login if controller is invalid
                $this->controller = 'login';
            }
        }

        // --- Core Access Control Logic ---
        // If user is NOT authenticated AND trying to access a restricted controller (not login or create)
        $is_authenticated = (isset($_SESSION['auth']) && $_SESSION['auth'] == 1);
        $is_public_controller = ($this->controller === 'login' || $this->controller === 'create');

        if (!$is_authenticated && !$is_public_controller) {
            // If trying to access a private page directly when not logged in
            $_SESSION['error'] = 'Please login to access this page.';
            header('Location: /login'); // Redirect to login
            exit;
        }

        // If user IS authenticated AND trying to access 'login' or 'create'
        if ($is_authenticated && $is_public_controller) {
            header('Location: /home'); // Redirect to home
            exit;
        }
        // --- End Core Access Control Logic ---

        // Load the controller file
        require_once CONTROLLERS . DS . $this->controller . '.php';
        $this->controller = new $this->controller;

        // Determine the method
        if (isset($url[2]) && method_exists($this->controller, $url[2])) {
            $this->method = $url[2];
        }

        // Get parameters
        $this->params = $url ? array_values(array_slice($url, 2)) : [];

        // Call the controller method with parameters
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