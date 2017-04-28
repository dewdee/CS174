<?php

namespace mn\hw4\models;

require_once 'Model.php';

class sheetModel extends Model{
    public function insert($data){
        $sheetName = $data["name"];
        $sheetHash = $data['hash'];
        $sql = "INSERT INTO sheet VALUES(NULL, '$sheetName', '$sheetHash')";
        $this->connection->query($sql);
    }
    public function select($name){
        $sql = "SELECT sheet_id, sheet_data FROM sheet WHERE sheet_name = '$name'";
        if($result = $this->connection->query($sql)){
            $row = $result->fetch_row();
            if(!empty($row)){
                $sheet_id = $row[0];
                $sheet_data = $row[1];
                $result = [$sheet_id => $sheet_data];
                return $result;
            }
        }
    }
    public function getName($id){
        $sql = "SELECT sheet_name FROM sheet WHERE sheet_id = '$id'";
        if($result = $this->connection->query($sql)){
            $row = $result->fetch_row();
            if(!empty($row)){
                $name = $row[0];
                return $name;
            }
        }
    }
    public function getID($name){
        $sql = "SELECT sheet_id FROM sheet WHERE sheet_name = '$name'";
        if($result = $this->connection->query($sql)){
            $row = $result->fetch_row();
            if(!empty($row)){
                $sheet_id = $row[0];
                return $sheet_id;
            }
        }
    }
}