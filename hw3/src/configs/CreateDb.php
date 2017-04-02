<?php

$host = "localhost";
$username = "";
$password = "password";

$db = new mysqli($host, $username, $password);

if($db->connect_error){
	die("Connection failed: " . $db->connect_error);
}

$sql = "CREATE DATABASE HW3_MN";
if($db->query($sql) === TRUE){
	echo "Database created successfully";
}
else{
	echo "Error creating database: " . $conn->error;
}

$db->close();