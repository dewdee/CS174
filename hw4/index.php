<?php

namespace mn\hw4;

require_once 'src/configs/config.php';
require_once __DIR__ . '/vendor/autoload.php';

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Formatter\LineFormatter;

// Create the logger
$logger = new Logger('spread');
$handler = new StreamHandler(__DIR__.'/app_data/spread.log', Logger::DEBUG);
$formatter = new LineFormatter(null, null, true, true);
// Set the format for the handle
$handler->setFormatter($formatter);
// Now add the handler
$logger->pushHandler($handler); // Push logger into controller

if(!isset($_REQUEST['c'])) {
    header("Location: index.php?c=main&m=view");
}
else{
    if($_REQUEST['c'] == 'main') {
        if (isset($_REQUEST['m'])) {
            if ($_REQUEST['m'] == "view") {
                $controller = new controllers\mainController($logger);
                $controller->index();
            }
        }
    }
    else if($_REQUEST['c'] == 'api') {
        if(isset($_REQUEST['m']) && isset($_REQUEST['arg1'])) {
            if($_REQUEST['m'] == 'edit') {
                $controller = new controllers\apiController($logger, "edit");
                $controller->index("edit");
            }
            else if($_REQUEST['m'] == 'read') {
                $controller = new controllers\apiController($logger, "read");
                $controller->index("read");
            }
        }
    }
}