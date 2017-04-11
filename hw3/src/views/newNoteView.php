<?php

namespace views;

require_once 'View.php';

class newNoteView extends View {
    public function render($data = []){
        $curr = isset($_REQUEST['listName']) ? $_REQUEST['listName'] : '';
        $prev = isset($_REQUEST['previousList']) ? $_REQUEST['previousList'] : '';
        $this->element->display($curr, $prev, $data);
        ?>
        <h2>New Note</h2><br><br>

        <form method="get">
            <input type="hidden" name="m" value="newNote">
            <input type="hidden" name="c" value="noteController">
            <input type="hidden" name="currentList" value="<?=$prev?>">
            Title:<input type="text" name="noteName" placeholder="Enter a new note name" maxlength="30">
            <br>Note<br>
            <textarea name="noteContent" rows="10" cols="60"></textarea><br>
            <input type="submit" value="Save">
        </form>

        <?php
    }
}