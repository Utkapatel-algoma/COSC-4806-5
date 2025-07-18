<?php

class Controller {

    public function model ($model) {
        // Use the MODELS constant for absolute path
        require_once MODELS . DS . $model . '.php';
        return new $model();
    }

    public function view ($view, $data = []) {
        // Extract the data to make it available in the view
        extract($data);
        // Use the VIEWS constant for absolute path
        require_once VIEWS . DS . $view . '.php';
    }

}