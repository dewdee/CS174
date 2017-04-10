<?php

namespace models;

require_once 'Model.php';

class noteModel extends Model{
    public function insert($data){
        $noteName = $data["noteName"];
        $parent_id = $data["parent_id"];
        $note = $data['noteContent'];
        $created = date("Y-m-d");
        $sql = "INSERT INTO notes VALUES(NULL, '$noteName', '$note','$created' ,'$parent_id')";
        $this->connection->query($sql);
    }
    public function select(string $noteName){
        $sql = "SELECT name, note FROM notes WHERE name = '$noteName'";
        if($result = $this->connection->query($sql)){
            $row = $result->fetch_row();
            $name = $row[0];
            $content = $row[1];
            $note = [$name => $content];
            return $note;
        }
    }
    public function selectMultiple(int $parent_id){
        $sql = "SELECT name, created FROM notes where fk_list_id = $parent_id ORDER BY created DESC";
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