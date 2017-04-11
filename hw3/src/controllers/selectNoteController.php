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
            $parent_id = $this->model['list']->getParentID($_REQUEST['listName']);
            //get array of list paths
            $data['path'] = $this->model['list']->getPath($parent_id);
            $data['path'] = array_reverse($data['path']);
            array_push($data['path'], $_REQUEST['listName']);
            //for when the list path is too long, get rid of all but last
            $this->view->display($data);
        }
    }
}