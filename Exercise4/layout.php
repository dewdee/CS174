<?php
//Layout.php
abstract class Layout
{
    public $view;
    public function __construct(View $view)
    //notice type hinting allowed for objects
    {
        $this->view = $view;
    }
    public abstract function renderHeader($data);
    public abstract function renderFooter($data);
}