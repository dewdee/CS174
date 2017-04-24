<?php

namespace mn\hw4;

require_once 'src/configs/config.php';

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
    header("Location: index.php?c=main&m=view");
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