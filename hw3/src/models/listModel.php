<?php

namespace models;

require_once 'Model.php';

class listModel extends Model{
    public function insert($data){
        $listName = $data["listName"];
        $parent_id = $data["parent_id"];
        $sql = "INSERT INTO lists VALUES(NULL, '$listName', '$parent_id')";
        $this->connection->query($sql);
    }
    public function selectMultiple(){
        $sql = "SELECT name, list_id FROM lists ORDER BY name DESC";
        $lists = [];
        if($result = $this->connection->query($sql)){
            while($row = $result->fetch_row()){
                $list_id = $row[0];
                $name = $row[1];
                $lists = array_merge([$name => $list_id], $lists);
            }
        }

        return $lists;
    }
}