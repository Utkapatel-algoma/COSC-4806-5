<?php
// app/core/Controller.php

class Controller {
    protected function model($model) {
        // Construct the path to the model file using DIRECTORY_SEPARATOR
        require_once APPROOT . DIRECTORY_SEPARATOR . 'models' . DIRECTORY_SEPARATOR . $model . '.php';
        return new $model();
    }

    protected function view($view, $data = []) {
        // Construct the path to the view file using DIRECTORY_SEPARATOR
        if (file_exists(APPROOT . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . $view . '.php')) {
            require_once APPROOT . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . $view . '.php';
        } else {
            // Error handling if view not found
            die('View does not exist: ' . APPROOT . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . $view . '.php');
        }
    }
}
