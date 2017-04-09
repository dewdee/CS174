<?php

namespace models;

require_once 'Model.php';

class listModel extends Model{
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