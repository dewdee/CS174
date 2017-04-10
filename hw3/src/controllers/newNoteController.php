<?php

namespace controllers;

require_once 'Controller.php';

class newNoteController extends Controller {
    public function __construct() {
        parent::__construct();
        $this->view = new \views\newNoteView("newNoteLayout");
    }
    public function index(){
        if(!isset($this->model['note'])){
            $this->model['note'] = new \models\noteModel();
            $this->view->display($data = []);
            $parent_id = 0;
            if(isset($_REQUEST['previousList']) && !empty($_REQUEST['previousList'])){
                $parent_id = $this->model['note']->getParentID($_REQUEST['previousList']);
            }
            return $parent_id;
        }
    }
    public function add(int $parent_id){
        if(isset($_REQUEST['noteName']) && $_REQUEST['noteContent']){
            $data['noteName'] = $_REQUEST['noteName'];
            $data['parent_id'] = $parent_id;
            $data['noteContent'] = $_REQUEST['noteContent'];
            $this->model['note']->insert($data);

            //redirect back to landing page, index.php
            header('Location:index.php');
        }
    }
}