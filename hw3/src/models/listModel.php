<?php
/*
 * Only subclasses of Model interact with the database.
 */

namespace models;

require_once 'Model.php';

class listModel extends Model{
    public function __construct(){
        $this->connect();
    }
    public  function insertQuery($sql){
        // TODO: Implement insertQuery() method.

    }
    public  function selectQuery($sql){
        // TODO: Implement selectQuery() method.
    }
}