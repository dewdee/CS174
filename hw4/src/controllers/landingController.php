<?php

namespace mn\hw4\controllers;

require_once 'Controller.php';

class landingController extends Controller {
    public function __construct() {
        parent::__construct();
        $this->view = new \mn\hw4\views\landingView("landingLayout");
    }

    public function index(){
        $this->view->display([]);
    }
}