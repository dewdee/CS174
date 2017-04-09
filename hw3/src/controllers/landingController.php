<?php

namespace controllers;


require_once 'Controller.php';

class landingController extends Controller {
    public function __construct() {
        parent::__construct();
        $this->view = new \views\landingView("landingLayout");
    }
    public function index(){
        if(!isset($this->model['list']) && !isset($this->model['note'])){
            $this->model['list'] = new \models\listModel();
            $this->model['note'] = new \models\noteModel();

            $data['lists'] = $this->model['list']->selectMultiple();
            $data['notes'] = $this->model['note']->selectMultiple();
            $this->view->display($data);
        }
        else{
            echo 'already created';
        }
    }
}