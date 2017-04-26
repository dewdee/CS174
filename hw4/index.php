<?php

namespace mn\hw4;

require_once 'src/configs/config.php';
$loader = require 'vendor/autoload.php';
$loader->add('AppName', __DIR__.'/../src/');
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
use Monolog\Formatter\LineFormatter;

// Create the logger
$logger = new Logger('spread');
$handler = new StreamHandler(__DIR__.'/app_data/spread.log', Logger::DEBUG);
$formatter = new LineFormatter(null, null, true, true);
$handler->setFormatter($formatter);
// Now add some handlers
$logger->pushHandler($handler);
// Push logger into controller

if(!isset($_REQUEST['c'])) {
    $controller = new controllers\landingController($logger);
    $controller->index();
}
else{
    if($_REQUEST['c'] == "main"){
        if(isset($_REQUEST['m']) && isset($_REQUEST['arg1'])){
            switch($_REQUEST['m']){
                case "edit":
                    $controller = new controllers\sheetController($logger, "edit");
                    $controller->index();
                    break;
                case "read":
                    $controller = new controllers\sheetController($logger, "read");
                    $controller->index();
                    break;

            }
        }
    }
}