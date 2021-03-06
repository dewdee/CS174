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
                $parent_id = empty($_REQUEST['currentList']) ? 0 : $this->model['list']->getParentID($_REQUEST['currentList']);
                //get array of list paths
                $data['path'] = $this->model['list']->getPath($parent_id);
                $data['path'] = array_reverse($data['path']);
                array_push($data['path'], $_REQUEST['previousList']);
                $this->add($parent_id, $type);
                $this->view->display($data);
            }
        }
        else if($type == 'note'){
            if(!isset($this->model['note'])){
                $this->model['note'] = new \models\noteModel();
                $parent_id = empty($_REQUEST['currentList']) ? 0 : $this->model['note']->getParentID($_REQUEST['currentList']);
                //get array of list paths
                $data['path'] = $this->model['note']->getPath($parent_id);
                $data['path'] = array_reverse($data['path']);
                array_push($data['path'], $_REQUEST['previousList']);
                $this->add($parent_id, $type);
                $this->view->display($data);
            }
        }
    }
    public function add(int $parent_id, string $type){
        if($type == 'list'){
            if(isset($_REQUEST['listName'])){
                $data['listName'] = $_REQUEST['listName'];
                $data['parent_id'] = $parent_id;
                $this->model['list']->insert($data);

                //redirect back to last visited list
                if(isset($_REQUEST['currentList']) && !empty($_REQUEST['currentList'])){
                    $url = "index.php?c=listController&m=selectList&listName=" . $_REQUEST['currentList'];
                    header('Location:'.$url);
                }
                else if(isset($_REQUEST['currentList']) && empty($_REQUEST['currentList'])){
                    header('Location:index.php');
                }
            }
        }
        else if($type == 'note'){
            if(isset($_REQUEST['noteName']) && $_REQUEST['noteContent']){
                $data['noteName'] = $_REQUEST['noteName'];
                $data['parent_id'] = $parent_id;
                $data['noteContent'] = $_REQUEST['noteContent'];
                $this->model['note']->insert($data);

                //redirect back to last visited list
                if(isset($_REQUEST['currentList']) && !empty($_REQUEST['currentList'])){
                    $url = "index.php?c=listController&m=selectList&listName=" . $_REQUEST['currentList'];
                    header('Location:'.$url);
                }
                else if(isset($_REQUEST['currentList']) && empty($_REQUEST['currentList'])){
                    header('Location:index.php');
                }
            }
        }

    }
}