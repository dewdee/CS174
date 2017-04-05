<?php
//BASE_URL/index.php?c=name_of_controller&m=name_of_method&arg1=value_for_arg1& ...&argn=value_for_argn

namespace controllers;

require_once 'Controller.php';

class noteController extends Controller{
    private $noteModel;

    public function __construct($data){
        parent::__construct($data);
        $this->noteModel = new \models\noteModel();
    }

    public function addNote(){

    }
    public function selectNote(){

    }
}