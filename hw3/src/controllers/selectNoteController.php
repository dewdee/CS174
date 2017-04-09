<?php

namespace controllers;

require_once 'Controller.php';

class selectNoteController extends Controller {

    public function __construct() {
        parent::__construct();
        $this->view = new \views\selectNoteView("selectNoteLayout");
    }

    public function index(string $noteName){
        if(!isset($this->model['note'])){
            $this->model['note'] = new \models\noteModel();
            $data['note'] = $this->model['note']->select($noteName);
            $this->view->display($data);
        }
    }
}