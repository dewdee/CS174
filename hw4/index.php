<?php

namespace mn\hw4;

require_once 'src/configs/config.php';
spl_autoload_register(function ($className) {
    //fetch class name only, exclude namespace
    $className = substr($className, strrpos($className, '\\') + 1);
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
});

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\FirePHPHandler;

$loader = require 'vendor/autoload.php';
$loader->add('AppName', __DIR__.'/../src/');

// Create the logger
$logger = new Logger('my_logger');
// Now add some handlers
$logger->pushHandler(new StreamHandler(__DIR__.'/app_data/spread.log', Logger::DEBUG));
$logger->pushHandler(new FirePHPHandler());

// You can now use your logger
$logger->info('My logger is now ready');
if(!isset($_REQUEST['c'])) {
    $controller = new controllers\landingController();
    $controller->index();
}
else{
    if($_REQUEST['c'] == "sheet"){
        if(isset($_REQUEST['m'])){
            switch($_REQUEST['m']){
                case "edit":
                    echo 'edit';
                    break;
                case "read":
                    echo 'read';
                    break;

            }
        }
    }
}