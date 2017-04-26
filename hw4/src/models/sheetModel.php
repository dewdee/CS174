<?php

namespace mn\hw4\models;

require_once 'Model.php';

class sheetModel extends Model{
    public function insert($data){
        $sheetName = $data["sheetName"];
        $sheetHash = $data['hash'];
        $sql = "INSERT INTO sheet VALUES(NULL, '$sheetName', '$sheetHash')";
        $this->connection->query($sql);
    }
    public function insertCodes($data){
        $sheetID = key($data);
        $sheetHash = reset($data);
        //if we use multi_query and have 3 queries instead we get unintended behavior
        //since it's only 3 inserts this is sufficient
        $sql = "INSERT INTO sheet_codes VALUES('$sheetID', '$sheetHash', 'e'), ('$sheetID', '$sheetHash', 'r'), ('$sheetID', '$sheetHash', 'f');";
        $this->connection->query($sql);
        return $sheetID;
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
    public function selectCodes(int $id){
        $sql = "SELECT sheet_id, hash_code, code_type FROM sheet_codes where sheet_id = $id";
        if($result = $this->connection->query($sql)){
            $sheetCodes = [];
            while($row = $result->fetch_row()){
                array_push($sheetCodes, $row);
            }
            return $sheetCodes;
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