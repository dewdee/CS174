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
        }
    }
    public function add(){
        if(isset($_REQUEST['listName'])){
            $data['listName'] = $_REQUEST['listName'];
            $data['parent_id'] = 0;
            $this->model['list']->insert($data);

            //redirect back to landing page, index.php
            header('Location:index.php');
        }
    }
}