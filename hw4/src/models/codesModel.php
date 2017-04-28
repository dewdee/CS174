<?php

namespace mn\hw4\models;

require_once 'Model.php';

class codesModel extends Model {
    public function insert($data){
        $sheetID = key($data);
        $sheetHash = reset($data);
        //if we use multi_query and have 3 queries instead we get unintended behavior
        //since it's only 3 inserts this is sufficient
        $sql = "INSERT INTO sheet_codes VALUES('$sheetID', '$sheetHash', 'e'), ('$sheetID', '$sheetHash', 'r'), ('$sheetID', '$sheetHash', 'f');";
        $this->connection->query($sql);
        return $sheetID;
    }
    public function select($id){
        $sql = "SELECT sheet_id, hash_code, code_type FROM sheet_codes where sheet_id = $id";
        if($result = $this->connection->query($sql)){
            $sheetCodes = [];
            while($row = $result->fetch_row()){
                array_push($sheetCodes, $row);
            }
            return $sheetCodes;
        }
    }
    public function getID($hash){
        $sql = "SELECT sheet_id FROM sheet_codes WHERE hash_code = '$hash'";
        if($result = $this->connection->query($sql)){
            $row = $result->fetch_row();
            if(!empty($row)){
                $sheet_id = $row[0];
                return $sheet_id;
            }
        }
    }
    public function existsHash($hash){
        $sql = "SELECT hash_code FROM sheet_codes WHERE hash_code = '$hash'";
        if($result = $this->connection->query($sql)){
            $row = $result->fetch_row();
            if(!empty($row)){
                return true;
            }
        }
    }
}