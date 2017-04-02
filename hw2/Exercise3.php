<?php
    phpinfo();
?>
somechar
<?php
error_reporting(-1);
ini_set('display_errors', 'On');

session_start();
if(isset($_REQUEST['set_time'])){
    $_SESSION['time'] = time();
    if(isset($_REQUEST['foo'])){
        $_SESSION['foo'] = $_REQUEST['foo'];
    }
}

print_r($_SESSION);
//C:\xampp\tmp
?>