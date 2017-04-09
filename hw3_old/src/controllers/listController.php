<?php

namespace controllers;

require_once 'Controller.php';

class listController extends Controller{
    public function __construct($data){
        $this->model = new \models\listModel();
    }
    public function add($data){
        $this->view = new \views\newListView("newListLayout");
        $this->view->display($data);
        $data["name"] = (isset($_GET['listName'])) ?
            filter_var($_GET['listName'], FILTER_SANITIZE_STRING) : "";
        $this->model->insertQuery($data["name"]);
        $this->view = new \views\landingView("landingLayout");
        $this->view->display($data);
    }
    public function select(){
        // TODO: Implement select() method.
        return $this->view;
    }
    public function display(){
        $data['lists'] = $this->model->selectMultiple();
        return $data['lists'];
    }
}