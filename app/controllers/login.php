<?php

class Login extends Controller {

    public function index() {
        $this->view('login/index');
    }

    public function verify() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';

            $user = $this->model('User');

            if ($user->authenticate($username, $password)) {
                // Authentication successful
                $_SESSION['auth'] = 1;
                $_SESSION['username'] = $username;
                $_SESSION['toast_message'] = 'Login successful!'; // Set toast message
                $_SESSION['toast_type'] = 'success'; // Set toast type
                header('Location: /home'); // Redirect to home page
                exit();
            } else {
                // Authentication failed
                $_SESSION['toast_message'] = 'Invalid username or password.'; // Set toast message for error
                $_SESSION['toast_type'] = 'danger'; // Set toast type for error
                header('Location: /login'); // Redirect back to the login page (still needed for session to persist toast)
                exit();
            }
        } else {
            // Not a POST request, redirect to login page
            header('Location: /login');
            exit();
        }
    }

    public function logout() {
        session_destroy();
        $_SESSION['toast_message'] = 'You have been logged out.';
        $_SESSION['toast_type'] = 'info';
        header('Location: /login');
        exit();
    }
}