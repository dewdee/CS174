<?php

namespace models;

/*
 * Base model class constructor is set so that every model will connect to database properly
 */

abstract class Model{
    protected $connection;

    public function __construct() {
        echo "model constructed<br/>";
        require_once(CONFIG_PATH."config.php");
        global $host, $username, $password, $database;
        $this->connection = new \mysqli($host, $username, $password, $database);
        if($this->connection->connect_error){
            die("Connection failed: " . $this->connection->connect_error);
        }
    }
    public abstract function selectMultiple();
}