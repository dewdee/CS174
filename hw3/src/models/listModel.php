<?php
/*
 * Only subclasses of Model interact with the database.
 */

namespace models;

require_once 'Model.php';

class listModel extends Model{
    public function __construct(){
        $this->connection = $this->connect();
    }
    public  function insertQuery(){
        // TODO: Implement insertQuery() method.

    }
    public  function selectQuery(){
        // TODO: Implement selectQuery() method.
    }
    public function selectMultiple(){
        $sql = "SELECT name FROM lists";
        $lists = [];
        if($result = $this->connection->query($sql)){
            while($row = $result->fetch_row()){
                $lists = array_merge($row, $lists);
            }
        }
        return $lists;
    }
}