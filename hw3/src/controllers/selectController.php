<?php

namespace controllers;

require_once 'Controller.php';

class selectController extends Controller {
    public function __construct(string $type) {
        parent::__construct();
        if($type == 'list'){
            $this->view = new \views\landingView("landingLayout");
        }
        else if($type == 'note'){
            $this->view = new \views\selectNoteView("selectNoteLayout");
        }
    }
    public function indexList(){
        if(!isset($this->model['list']) && !isset($this->model['note'])){
            $this->model['list'] = new \models\listModel();
            $this->model['note'] = new \models\noteModel();

            if(isset($_REQUEST['listName'])){
                $parent_id = empty($_REQUEST['listName']) ? 0 : $this->model['list']->getParentID($_REQUEST['listName']);
                $data['lists'] = $this->model['list']->selectMultiple($parent_id);
                $data['notes'] = $this->model['note']->selectMultiple($parent_id);
                //get array of list paths
                $data['path'] = $this->model['list']->getPath($parent_id);
                $data['path'] = array_reverse($data['path']);
                array_push($data['path'], $_REQUEST['listName']);
                //for when the list path is too long, get rid of all but last
                $this->view->display($data);
            }
        }
    }
    public function indexNote(string $noteName){
        if(!isset($this->model['note'])){
            $this->model['note'] = new \models\noteModel();

            $data['note'] = $this->model['note']->select($noteName);
            $parent_id = empty($_REQUEST['previousList']) ? 0 : $this->model['note']->getParentID($_REQUEST['previousList']);
            //get array of list paths
            $data['path'] = $this->model['note']->getPath($parent_id);
            $data['path'] = array_reverse($data['path']);
            array_push($data['path'], $_REQUEST['previousList']);
            //for when the list path is too long, get rid of all but last
            $this->view->display($data);
        }
    }
}