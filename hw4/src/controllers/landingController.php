<?php

namespace mn\hw4\controllers;

use mn\hw4\views\landingView;

require_once 'Controller.php';

class landingController extends Controller {
    public function __construct() {
        parent::__construct();
        $this->view = new landingView("landingLayout");
    }

    public function index(){
        $this->view->display([]);
    }
}