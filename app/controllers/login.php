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
                $_SESSION['message'] = 'Login successful!';
                header('Location: /home'); // Still redirect to home on success
                exit();
            } else {
                // Authentication failed
                $_SESSION['error'] = 'Invalid username or password.'; // Set the error message

                // Instead of redirecting, directly call the index method to display the view
                // This keeps the error message in the current session context
                $this->index(); // Calls the index method to render the login page with the error
                exit(); // Ensure script stops after rendering
            }
        } else {
            // Not a POST request, redirect to login page
            header('Location: /login');
            exit();
        }
    }

    public function logout() {
        session_destroy();
        header('Location: /login');
        exit();
    }
}