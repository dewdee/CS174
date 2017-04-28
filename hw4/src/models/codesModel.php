<?php

namespace mn\hw4\models;

require_once 'Model.php';

class codesModel extends Model {
    public function insert($data){
        $sheetName = $data['name'];
        $id = $data['id'];
        $hashes = [];
        $hashes[0] = substr(hash("md5", $sheetName.'_e'), 0, 8);
        $hashes[1] = substr(hash("md5", $sheetName.'_r'), 0, 8);
        $hashes[2] = substr(hash("md5", $sheetName.'_f'), 0, 8);
        //if we use multi_query and have 3 queries we get unintended behavior
        //since it's only 3 inserts this is sufficient
        $sql = "INSERT INTO sheet_codes VALUES('$id', '$hashes[0]', 'e'), ('$id', '$hashes[1]', 'r'), ('$id', '$hashes[2]', 
        'f');";
        $this->connection->query($sql);
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