<?php

class App {

    protected $controller = 'login';
    protected $method = 'index';
    protected $special_url = ['apply'];
    protected $params = [];

    public function __construct() {
        // Start session if not already started
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        if (isset($_SESSION['auth']) == 1) {
            $this->controller = 'home';
        }

        $url = $this->parseUrl();

        // Check if a controller is specified in the URL
        if (isset($url[1]) && file_exists(CONTROLLERS . DS . $url[1] . '.php')) {
            $this->controller = $url[1];
            $_SESSION['controller'] = $this->controller;

            if (in_array($this->controller, $this->special_url)) {
              $this->method = 'index';
            }
            unset($url[1]);
        } else {
            // If no controller or an invalid controller, redirect to home if authenticated, else login
            if (isset($_SESSION['auth']) && $_SESSION['auth'] == 1) {
                header('Location: /home');
            } else {
                header('Location: /login');
            }
            exit; // Always exit after a header redirect
        }

        require_once CONTROLLERS . DS . $this->controller . '.php';
        $this->controller = new $this->controller;

        // Check if a method is specified and exists
        if (isset($url[2])) {
            if (method_exists($this->controller, $url[2])) {
                $this->method = $url[2];
                $_SESSION['method'] = $this->method;
                unset($url[2]);
            }
        }

        $this->params = $url ? array_values($url) : [];
        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    public function parseUrl() {
        $u = $_SERVER['REQUEST_URI'] ?? '';
        // Remove query string and fragment for routing
        $u = strtok($u, '?');
        $u = strtok($u, '#');

        // Trim leading/trailing slashes, sanitize, and explode
        $url = explode('/', filter_var(rtrim($u, '/'), FILTER_SANITIZE_URL));

        // Remove the first empty element if URL starts with a slash
        if (empty($url[0])) {
            unset($url[0]);
        }

        return $url;
    }
}