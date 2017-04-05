<?php
/*
 * Only controller classes directly handle request/form data.
 * Controllers use this information to invoke model methods that make database calls to get/set/update info in the database
 * then choose a view, instantiate it, and call its render() method to display a web page back to the requesting browser.
 */
namespace controllers;

require_once(ROOT.'/src/models/listModel.php');
require_once(ROOT.'/src/models/noteModel.php');
require_once(ROOT.'/src/views/indexView.php');

abstract class Controller{
    private $listModel;
    private $noteModel;
    public $view;

    public function __construct(){
        $this->listModel = new \models\listModel();
        $this->noteModel = new \models\noteModel();
        $this->view = new \views\indexView("indexLayout");
    }
}