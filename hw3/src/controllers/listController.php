<?php

namespace controllers;

require_once 'Controller.php';

class listController extends Controller{
    public function __construct($data){
        $this->model = new \models\listModel();
    }
    public function add(){

    }
    public function select(){
        // TODO: Implement select() method.
    }
    public function display(){
        $data['lists'] = $this->model->selectMultiple();
        return $data['lists'];
    }
}