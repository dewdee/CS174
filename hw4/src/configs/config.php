<?php

$host = "localhost";
$username = "root";
$password = "password"; //change password according to system settings
$database = "hw4_mn";

define("DS", DIRECTORY_SEPARATOR);
define('ROOT', dirname(dirname(__FILE__)).DS);

define("CONFIG_PATH", ROOT."configs".DS);
define("CONTROLLER_PATH", ROOT."controllers".DS);
define("MODEL_PATH", ROOT."models".DS);
define("VIEW_PATH", ROOT."views".DS);

define("LAYOUT_PATH", VIEW_PATH."layouts".DS);