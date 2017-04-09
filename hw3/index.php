<?php

namespace mn\hw3;

require_once 'src/configs/config.php';

spl_autoload_register(function ($className) {
    if(file_exists($file = ROOT.$className.'.php')){
        require_once($file);
    }
    else if(file_exists($file = VIEW_PATH.$className.'.php')) {
        require_once($file);
    }
    else if(file_exists($file = LAYOUT_PATH.$className.'.php')) {
        require_once($file);
    }
    else if(file_exists($file = CONTROLLER_PATH.$className.'.php')) {
        require_once($file);
    }
    else if(file_exists($file = MODEL_PATH.$className.'.php')) {
        require_once($file);
    }
    else if(file_exists($file = ELEMENT_PATH.$className.'.php')) {
        require_once($file);
    }
    else if(file_exists($file = HELPER_PATH.$className.'.php')) {
        require_once($file);
    }
});

function main(){
    if(!isset($_REQUEST['a'])){
        //need to fetch lists and notes to send to view
        $data['title'] = "Note-A-List";
        $listController = new \controllers\listController($data);
        $noteController = new \controllers\noteController($data);
        $data['lists'] = $listController->display();
        $data['notes'] = $noteController->display();

        $view = new \views\landingView("landingLayout");
        $view->display($data);
    }
    else if(isset($_REQUEST['c']) && isset($_REQUEST['c']) && isset($_REQUEST['c'])){
        $data['c'] = (isset($_REQUEST['c'])) ? filter_var($_REQUEST['c'], FILTER_SANITIZE_STRING) : "";
        $data['m'] = (isset($_REQUEST['m'])) ? filter_var($_REQUEST['m'], FILTER_SANITIZE_STRING) : "";
        $data['a'] = (isset($_REQUEST['a'])) ? filter_var($_REQUEST['a'], FILTER_SANITIZE_STRING) : "";
        if($data['c'] == "listController" && $data['a'] == "newList"){
            $listController = new \controllers\listController($data);
            $listController->add($data);
        }
        else if($data['c'] == "noteController" && $data['a'] == "newNote"){
            //$view = $noteController->add();
            //$view->display($data);
        }
        else if($data['c'] == "listController" && $data['a'] == "selectList"){
            //$view = $noteController->select();
            //$view->display($data);
        }
        else if($data['c'] == "noteController" && $data['a'] == "selectNote"){
            //$view = $noteController->select();
            //$view->display($data);
        }

    }
}

main();