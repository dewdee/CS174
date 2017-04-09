<?php
require_once 'config.php';

$connection = new mysqli($host, $username, $password);

if($connection->connect_error){
	die("Connection failed: " . $connection->connect_error);
}
else {
    $sql = "CREATE DATABASE IF NOT EXISTS hw3_mn";
    if ($connection->query($sql) == TRUE) {
        echo "Database created successfully.\n";
    } else {
        echo "Error creating database: " . $connection->error . "\n";
    }
    if($connection->select_db($database)){
        $sql = file_get_contents("sql.txt");
        //our sql file contains multiple queries, so use multi_query instead
        if($connection->multi_query($sql)){
            do{
                //if we don't get any results and error is not empty
                if(!($connection->store_result()) && $connection->error != ''){
                    echo "Error: " . $connection->error;
                }
                else{
                    echo "Query run successfully.\n";
                }
            }while($connection->more_results() && $connection->next_result());
        }
        else{
            echo "Error: " . $connection->error ."\n";
        }
    }
    else{
        die("Connection failed: " . $connection->connect_error);
    }
}