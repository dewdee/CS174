<?php

namespace mn\hw4\controllers;

abstract class Controller {
    protected $view;
    protected $model;

    public function __construct() {
        $this->model = [];
    }

}