<?php
/*
 * Only subclasses of Model interact with the database.
 */

namespace models;

require_once 'Model.php';

class listModel extends Model{
    public  function insertQuery($data){
        $listName = $data["listName"];
        $parent_id = $data["parent_id"];
        $sql = "INSERT INTO lists (NULL, '$listName', '$parent_id')";
        $this->connection->query($sql);
    }
    public  function selectQuery(){
        // TODO: Implement selectQuery() method.
    }
    public function selectMultiple(){
        $sql = "SELECT name FROM lists ORDER BY name DESC";
        $lists = [];
        if($result = $this->connection->query($sql)){
            while($row = $result->fetch_row()){
                $lists = array_merge($row, $lists);
            }
        }
        return $lists;
    }
}