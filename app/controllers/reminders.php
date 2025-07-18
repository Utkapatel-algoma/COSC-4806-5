<?php

class Reminders extends Controller {

    public function index() {
        $reminder = $this->model('Reminder');
        $list_of_reminders = $reminder->get_all_reminders();
        // Pass the list of reminders to the view
        $this->view('reminders/index', ['reminders' => $list_of_reminders]);
    }

    public function create() {
        $this->view('reminders/create');
    }

    public function store() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $subject = $_POST['subject'] ?? '';

            if (!empty($subject)) {
                $reminder = $this->model('Reminder');
                // Assuming user_id is 1 for now, based on your previous code
                $reminder->add_reminder(1, $subject);
                header('Location: /reminders');
                exit();
            } else {
                // Optionally set an error message here
                header('Location: /reminders/create');
                exit();
            }
        } else {
            header('Location: /reminders/create');
            exit();
        }
    }

    public function show($id = '') {
        $reminder = $this->model('Reminder');
        $single_reminder = $reminder->get_reminder_by_id($id);
        $this->view('reminders/show', ['reminder' => $single_reminder]);
    }

    public function update($id = '') {
        $reminder = $this->model('Reminder');
        $single_reminder = $reminder->get_reminder_by_id($id);
        // Pass the reminder data to the update view
        $this->view('reminders/update', ['reminder' => $single_reminder]);
    }

    public function saveUpdate() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'] ?? '';
            $subject = $_POST['subject'] ?? '';

            if (!empty($id) && !empty($subject)) {
                $reminder = $this->model('Reminder');
                $reminder->update_reminder($id, $subject);
                header('Location: /reminders'); // Redirect back to the list
                exit();
            } else {
                // Optionally set an error message for incomplete data
                header('Location: /reminders');
                exit();
            }
        } else {
            // Not a POST request, redirect
            header('Location: /reminders');
            exit();
        }
    }

    public function delete($id = '') {
        $reminder = $this->model('Reminder');
        $reminder->delete_reminder($id);
        header('Location: /reminders'); // Redirect back to list
        exit();
    }
}