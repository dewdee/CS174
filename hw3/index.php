<?php

namespace mn\hw3;

require_once 'src/configs/config.php';

spl_autoload_register(function ($className) {
    //autoload function is simple due to namespaces
    $file = ROOT.$className.'.php';
    require_once($file);
});

$data['title'] = "Note-A-List";
//$controller = new \controllers\listController($data);
$view = new \views\landingView("landingLayout");
$view->display($data);
if(isset($_REQUEST['m']) && isset($_REQUEST['c']) && isset($_REQQEST['a'])){
    $model = $_REQUEST['m'];
    $controller = $_REQUEST['c'];
    $action = $_REQUEST['a'];
    if($controller == "listController"){

    }
    else if($controller == "noteController"){

    }
}