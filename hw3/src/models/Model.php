<?php
/*
 * Only subclasses of Model interact with the database. The base Model class has methods for performing the initial connection to the database.
 * Model classes have methods to marshal a particular kind of object from one or more tables,
 * and to take already created objects and unmarshal them persistently into the database.
 */
namespace models;


abstract class Model{
    protected $connection;

    public function connect(){
        //call variables into function scope
        require_once(CONFIG_PATH."config.php");
        global $host, $username, $password, $database;
        $connection = new \mysqli($host, $username, $password, $database);
        if($connection->connect_error){
            die("Connection failed: " . $connection->connect_error);
        }
        return $connection;
    }
    public abstract function insertQuery();
    public abstract function selectQuery();
    public abstract function selectMultiple();
}