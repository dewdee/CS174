<?php

namespace models;

require_once 'Model.php';

class noteModel extends Model{
    public function selectMultiple(){
        $sql = "SELECT name, created FROM notes ORDER BY created DESC";
        $notes = [];
        if($result = $this->connection->query($sql)){
            while($row = $result->fetch_row()){
                $name = $row[0];
                $created = $row[1];
                $notes = array_merge([$name => $created], $notes);
            }
        }

        return $notes;
    }
}