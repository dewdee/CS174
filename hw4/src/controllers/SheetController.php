<?php

namespace mn\hw4\controllers;

require_once 'Controller.php';

use mn\hw4\views\editView;
use mn\hw4\views\readView;

class sheetController extends Controller {
    public function __construct($type) {
        parent::__construct();
        switch($type){
            case "edit":
                $this->view = new editView("editLayout");
                break;
            case "read":
                $this->view = new readView("readLayout");
                break;
        }
    }

    public function index(){
        $data['sheetName'] = $_REQUEST['arg1'];
        $this->view->display($data);
    }
}