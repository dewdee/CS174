<?php

namespace controllers;

require_once 'Controller.php';

class newController extends Controller {
    public function __construct(string $type) {
        parent::__construct();
        if($type == 'list'){
            $this->view = new \views\newListView("newListLayout");
        }
        else if($type == 'note'){
            $this->view = new \views\newNoteView("newNoteLayout");
        }
    }
    public function index(string $type){
        if($type == 'list'){
            if(!isset($this->model['list'])){
                $this->model['list'] = new \models\listModel();
                $this->view->display($data = []);
                $parent_id = 0;
                if(isset($_REQUEST['previousList']) && !empty($_REQUEST['previousList'])){
                    $parent_id = $this->model['list']->getParentID($_REQUEST['previousList']);
                }
                return $parent_id;
            }
        }
        else if($type == 'note'){
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
    }
    public function add(int $parent_id, string $type){
        if($type == 'list'){
            if(isset($_REQUEST['listName'])){
                $data['listName'] = $_REQUEST['listName'];
                $data['parent_id'] = $parent_id;
                $this->model['list']->insert($data);

                //redirect back to landing page, index.php

                header('Location:index.php');
            }
        }
        else if($type == 'note'){
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
}