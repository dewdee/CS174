<?php

namespace views;

require_once 'View.php';

class newListView extends View {
    public function render($data = []){
        $curr = isset($_REQUEST['listName']) ? $_REQUEST['listName'] : '';
        $prev = isset($_REQUEST['previousList']) ? $_REQUEST['previousList'] : '';
        $this->element->display($curr, $prev, $data);
        ?>
            <h1>New List</h1>
            <form method="get">
                <input type="hidden" name="m" value="newList">
                <input type="hidden" name="c" value="listController">
                <input type="hidden" name="currentList" value="<?=$prev?>">
                <input type="text" name="listName" placeholder="Enter a new list name" maxlength="20">
                <input type="submit" value="Add">
            </form>
        <?php
    }
}