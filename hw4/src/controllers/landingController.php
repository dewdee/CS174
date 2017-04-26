<?php

namespace mn\hw4\controllers;

require_once 'Controller.php';

use mn\hw4\views\landingView;

class landingController extends Controller {
    public function __construct() {
        parent::__construct();
        $this->view = new landingView("landingLayout");
    }

    public function index(){
        $this->view->display([]);
    }
}