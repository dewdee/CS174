<?php

namespace controllers;

require_once 'Controller.php';

class selectListController extends Controller {
    public function __construct() {
        parent::__construct();
        $this->view = new \views\landingView("landingLayout");
    }
    public function index(){
        if(!isset($this->model['list']) && !isset($this->model['note'])){
            $this->model['list'] = new \models\listModel();
            $this->model['note'] = new \models\noteModel();

            if(isset($_REQUEST['listName'])){
                $parent_id = $this->model['list']->getParentID($_REQUEST['listName']);
                $data['lists'] = $this->model['list']->selectMultiple($parent_id);
                $data['notes'] = $this->model['note']->selectMultiple($parent_id);
                //get array of list paths
                $data['path'] = $this->model['list']->getPath($parent_id);
                array_push($data['path'], $_REQUEST['listName']);
                //for when the list path is too long, get rid of all but last
                if(count($data['path']) > 4){
                    for($i = 0; $i < 4; $i++){
                        array_shift($data['path']);
                    }
                }
                print_r($data['path']);
                $this->view->display($data);
            }
        }
    }
}