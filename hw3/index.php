<?php
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

function bootstrap(){
    // a = action, c = controller, m = method
    if(!isset($_REQUEST['m']) || !isset($_REQUEST['c'])){
        $controller = new \controllers\landingController();
        $controller->index();
    }
    else{
        if(isset($_REQUEST['c']) && $_REQUEST['c'] == "listController"){
            if(isset($_REQUEST['m']) && $_REQUEST['m'] == "newList"){
                $controller = new \controllers\newListController();
                $list_id = $controller->index();
                $controller->add($list_id);
            }
            else if(isset($_REQUEST['m']) && $_REQUEST['m'] == "selectList"){
                $controller = new \controllers\selectListController();
                $controller->index();
            }
        }
        else if(isset($_REQUEST['c']) && $_REQUEST['c'] == "noteController"){
            if(isset($_REQUEST['m']) && $_REQUEST['m'] == "newNote"){
                $controller = new \controllers\newNoteController();
                $list_id = $controller->index();
                $controller->add($list_id);
            }
            else if(isset($_REQUEST['m']) && $_REQUEST['m'] == "selectNote" && isset($_REQUEST['noteName'])){
                $controller = new \controllers\selectNoteController();
                $noteName = $_REQUEST['noteName'];
                $controller->index($noteName);
            }
        }
    }
}

bootstrap();