<?php
/*
 * Only subclasses of Model interact with the database. The base Model class has methods for performing the initial connection to the database.
 * Model classes have methods to marshal a particular kind of object from one or more tables,
 * and to take already created objects and unmarshal them persistently into the database.
 */
namespace models;

require_once(ROOT.'/src/configs/config.php');

abstract class Model{
    private $connection;

    public function connect(){
        //call variables into function scope
        global $host, $username, $password;
        $this->connection = new \mysqli($host, $username, $password);
        if($this->connection->connect_error){
            die("Connection failed: " . $this->connection->connect_error);
        }
        else{
            echo "Success!\n";
        }
    }
}