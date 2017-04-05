<?php
/*
 * Layouts are used to output common header and footer HTML that might be used by several views.
 */
abstract class Layout{
    public $view;
    //notice type hinting allowed for objects
    public function __construct(\views\View $view){

        $this->view = $view;
    }
    public abstract function renderHeader($data);
    public abstract function renderFooter($data);
}