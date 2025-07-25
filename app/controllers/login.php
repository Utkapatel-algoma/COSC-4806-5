<?php

class Login extends Controller {

    public function index() {
        // Ensure session is started for toast messages if not already
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $this->view('login/index');
    }

    public function verify() {
        // Ensure session is started for session variables if not already
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';

            $userModel = $this->model('User');

            $user = $userModel->authenticate($username, $password);

            if ($user) { // Authentication successful, $user now contains the user data
                // session_start(); // Removed: Likely already started by framework or other file
                $_SESSION['logged_in'] = true;
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['user_role'] = $user['role'];

                $_SESSION['toast_message'] = 'Login successful!';
                $_SESSION['toast_type'] = 'success';
                header('Location: /home');
                exit();
            } else {
                // Authentication failed
                // session_start(); // Removed: Likely already started by framework or other file
                $_SESSION['toast_message'] = 'Invalid username or password.';
                $_SESSION['toast_type'] = 'danger';
                header('Location: /login');
                exit();
            }
        } else {
            // Not a POST request, redirect to login page
            header('Location: /login');
            exit();
        }
    }

    public function logout() {
        // Ensure session is started before destroying if not already
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        session_destroy();
        $_SESSION['toast_message'] = 'You have been logged out.';
        $_SESSION['toast_type'] = 'info';
        header('Location: /login');
        exit();
    }
}
