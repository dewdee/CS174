<?php
/**
 * Created by PhpStorm.
 * User: Mike
 * Date: 4/5/2017
 * Time: 9:34 AM
 */

namespace controllers;

require_once 'Controller.php';

class listController extends Controller{
    private $listModel;

    public function __construct($data){
        parent::__construct($data);
        $this->listModel = new \models\listModel();
    }

    public function addList(){

    }
    public function selectList(){

    }
}