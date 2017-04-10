<?php

namespace controllers;

require_once 'Controller.php';

class newListController extends Controller{
    public function __construct() {
        parent::__construct();
        $this->view = new \views\newListView("newListLayout");
    }
    public function index(){
        if(!isset($this->model['list'])){
            $this->model['list'] = new \models\listModel();
            $this->view->display($data = []);
            $parent_id = 0;
            if(isset($_REQUEST['currentList']) && !empty($_REQUEST['currentList'])){
                $parent_id = $this->model['list']->getParentID($_REQUEST['currentList']);
            }
            return $parent_id;
        }
    }
    public function add(int $parent_id){
        if(isset($_REQUEST['listName'])){
            $data['listName'] = $_REQUEST['listName'];
            $data['parent_id'] = $parent_id;
            $this->model['list']->insert($data);

            //redirect back to landing page, index.php

            header('Location:index.php');
        }
    }
}