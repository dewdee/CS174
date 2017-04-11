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
    public function getPath($list_id)
    {
        $path = []; //path is an array of names of folders
        $sql = "SELECT b.name, b.list_id FROM lists a INNER JOIN lists b ON (b.list_id=a.parent_id and a.list_id =?)";
        $stmt = $this->connection->stmt_init();
        if ($stmt->prepare($sql)) {
            $path =[];
            while($list_id > 1) {
                $stmt->bind_param("i", $list_id); //s == string, i == int, d==double
                $stmt->execute();
                $stmt->bind_result($name, $id);
                if($stmt->fetch()) {
                    array_push($path, $name);
                    $list_id = $id;
                }
                else{
                    break;
                }
            }
            $stmt->close();
        }
        return $path;
    }
    public abstract function insert($data);
    public abstract function select($name);
    public abstract function selectMultiple(int $parent_id);
}