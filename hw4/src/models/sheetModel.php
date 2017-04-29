<?php

namespace mn\hw4\models;

require_once 'Model.php';

class sheetModel extends Model{
    public function insert($data){
        $sheetName = $data["name"];
        $sheetData = $data['sheetData'];
        $sql = "INSERT INTO sheet VALUES(NULL, '$sheetName', '$sheetData')";
        $this->connection->query($sql);
    }
    public function select($name){
        $sql = "SELECT sheet_id FROM sheet WHERE sheet_name = '$name'";
        if($result = $this->connection->query($sql)){
            $row = $result->fetch_row();
            if(!empty($row)){
                $sheet_id = $row[0];
                return $sheet_id;
            }
        }
    }
    public function selectData($name){
        $sql = "SELECT sheet_data FROM sheet WHERE sheet_name = '$name'";
        if($result = $this->connection->query($sql)){
            $row = $result->fetch_row();
            if(!empty($row)){
                $sheet_id = $row[0];
                return $sheet_id;
            }
        }
    }
    public function selectDataID($id){
        $sql = "SELECT sheet_data FROM sheet WHERE sheet_id = '$id'";
        if($result = $this->connection->query($sql)){
            $row = $result->fetch_row();
            if(!empty($row)){
                $sheet_data = $row[0];
                return $sheet_data;
            }
        }
    }
    public function updateData($data){
        $sheetID = $data["id"];
        $sheetData = $data['sheetData'];
        $sql = "UPDATE sheet SET sheet_data = '$sheetData' WHERE sheet_id = '$sheetID'";
        $this->connection->query($sql);
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