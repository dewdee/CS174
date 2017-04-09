<?php
/*
 * Only controller classes directly handle request/form data.
 * Controllers use this information to invoke model methods that make database calls to get/set/update info in the database
 * then choose a views, instantiate it, and call its render() method to display a web page back to the requesting browser.
 * BASE_URL/index.php?c=name_of_controller&m=name_of_method&arg1=value_for_arg1& ...&argn=value_for_argn
 */
namespace controllers;

spl_autoload_register(function ($className) {
    $file = ROOT.$className.'.php';
    require_once($file);
});
abstract class Controller{
    protected $view;
    protected $model;

    public abstract function add($data);
    public abstract function select();
    public abstract function display();
}