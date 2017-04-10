<?php

namespace models;

require_once 'Model.php';

class listModel extends Model
{
    public function insert($data)
    {
        $listName = $data['listName'];
        $parent_id = $data['parent_id'];
        $sql = "INSERT INTO lists VALUES(NULL, '$listName', '$parent_id')";
        $this->connection->query($sql);
    }

    public function select(string $listName)
    {
        $sql = "SELECT name, parent_id FROM lists WHERE name = '$listName'";
        if ($result = $this->connection->query($sql)) {
            $row = $result->fetch_row();
            $name = $row[1];
            $parent_id = $row[2];
            $note = [$name => $parent_id];
            return $note;
        }
    }

    public function selectMultiple(int $parent_id)
    {
        $sql = "SELECT name, list_id FROM lists where parent_id = $parent_id ORDER BY name DESC";
        $lists = [];
        if ($result = $this->connection->query($sql)) {
            while ($row = $result->fetch_row()) {
                $list_id = $row[0];
                $name = $row[1];
                $lists = array_merge([$name => $list_id], $lists);
            }
        }

        return $lists;
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
}