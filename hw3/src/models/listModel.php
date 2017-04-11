<?php

namespace models;

require_once 'Model.php';

class listModel extends Model {
    public function insert($data) {
        $listName = $data['listName'];
        $parent_id = $data['parent_id'];
        $sql = "INSERT INTO lists VALUES(NULL, '$listName', '$parent_id')";
        $this->connection->query($sql);
    }
    public function select($name) {
        $sql = "SELECT name, parent_id FROM lists WHERE name = '$name'";
        if ($result = $this->connection->query($sql)) {
            $row = $result->fetch_row();
            $list_name = $row[1];
            $parent_id = $row[2];
            $note = [$list_name => $parent_id];
            return $note;
        }
    }
    public function selectMultiple(int $parent_id) {
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
}