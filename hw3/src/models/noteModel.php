<?php
/*
 * Only subclasses of Model interact with the database.
 */

namespace models;

require_once 'Model.php';

class noteModel extends Model{
    public function __construct(){
        $this->connection = $this->connect();
    }

    public  function insertQuery(){
        // TODO: Implement insertQuery() method.
    }
    public function selectQuery(){
        // TODO: Implement selectQuery() method.
    }
    public function selectMultiple(){
        $sql = "SELECT name FROM notes ORDER BY NAME DESC";
        $notes = [];
        if($result = $this->connection->query($sql)){
            while($row = $result->fetch_row()){
                $notes = array_merge($row, $notes);
            }
        }

        return $notes;
    }
}