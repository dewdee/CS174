<?php

namespace models;

/*
 * Base model class constructor is set so that every model will connect to database properly
 */

abstract class Model{
    protected $connection;

    public function __construct() {
        require_once(CONFIG_PATH."config.php");
        global $host, $username, $password, $database;
        $this->connection = new \mysqli($host, $username, $password, $database);
        if($this->connection->connect_error){
            die("Connection failed: " . $this->connection->connect_error);
        }
    }
    public function getParentID(string $listName){
        $sql = "SELECT list_id FROM lists WHERE name = '$listName'";
        if($result = $this->connection->query($sql)){
            $row = $result->fetch_row();
            $parent_id = $row[0];
            return $parent_id;
        }
    }
    public abstract function insert($data);
    public abstract function selectMultiple(int $parent_id);
}