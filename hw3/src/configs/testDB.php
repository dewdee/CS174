<?php
require_once 'config.php';

$connection = new mysqli($host, $username, $password, $database);

if($connection->connect_error){
    die("Connection failed: " . $connection->connect_error);
}
$list_id = 15;
$sql = "SELECT b.name, b.list_id FROM lists a INNER JOIN lists b ON (b.list_id=a.parent_id and a.list_id =?)";
$stmt = $connection->stmt_init();
if ($stmt->prepare($sql)) {
    $path =[];
    while($list_id > 1) {
        print_r($list_id);
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

    print_r($path);
    $stmt->close();
}