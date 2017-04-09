<?php
//BASE_URL/index.php?c=name_of_controller&m=name_of_method&arg1=value_for_arg1& ...&argn=value_for_argn

namespace controllers;

require_once 'Controller.php';

class noteController extends Controller{
    public function __construct($data){
        $this->model = new \models\noteModel();
    }
    public  function add($data){
        // TODO: Implement add() method.
        return $this->view;
    }
    public function select(){
        return $this->view;
    }
    public function display(){
        $data['notes'] = $this->model->selectMultiple();
        return $data['notes'];
    }
}