<?php

namespace mn\hw3;

require_once 'src/configs/config.php';

spl_autoload_register(function ($className) {
    //autoload function is simple due to namespaces
    $file = ROOT.$className.'.php';
    require_once($file);
});


//need to fetch lists and notes to send to view
$data['title'] = "Note-A-List";
$listController = new \controllers\listController($data);
$noteController = new \controllers\noteController($data);
$data['lists'] = $listController->display();
$data['notes'] = $noteController->display();
print_r($data['notes']);
$view = new \views\landingView("landingLayout");
$view->display($data);

if(isset($_REQUEST['c']) && isset($_REQUEST['c']) && isset($_REQUEST['c'])){
    $data['c'] = (isset($_REQUEST['c'])) ? filter_var($_REQUEST['c'], FILTER_SANITIZE_STRING) : "";
    $data['m'] = (isset($_REQUEST['m'])) ? filter_var($_REQUEST['m'], FILTER_SANITIZE_STRING) : "";
    $data['a'] = (isset($_REQUEST['a'])) ? filter_var($_REQUEST['a'], FILTER_SANITIZE_STRING) : "";
    if($data['c'] == "listController" && $data['a'] == "new"){
        $listController->add();
    }
    else if($data['c'] == "noteController" && $data['a'] == "new"){
        $noteController->select();
    }
}