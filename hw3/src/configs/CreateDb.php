<?php
require_once 'config.php';

$db = new mysqli($host, $username, $password);

if($db->connect_error){
	die("Connection failed: " . $db->connect_error);
}

$sql = "CREATE DATABASE hw3_mn";
if($db->query($sql) == TRUE){
	echo "Database created successfully.\n";
}
else{
	echo "Error creating database: " . $db->error . "\n";
}

$db->close();

//open new connection with dbname
$connection = new mysqli($host, $username, $password, $database);

if($connection->connect_error){
	die("Connection failed: " . $connection->connect_error);
}
$sql = file_get_contents("sql.txt");

if($connection->query($sql) == TRUE){
	echo "Table created successfully.\n";
}
else{
	echo "Error creating table: " . $connection->error ."\n";
}

$connection->close();