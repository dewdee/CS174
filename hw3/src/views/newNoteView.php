<?php

namespace views;


class newNoteView extends View {
    public function render($data = []){
        ?>
        <h1><a href="index.php">Note-A-List
            </a>
        </h1>
        <h2>New Note</h2><br><br>

        <form method="get">
            <input type="hidden" name="m" value="newNote">
            <input type="hidden" name="c" value="noteController">
            <?php
            $curr = isset($_REQUEST['previousList']) ? $_REQUEST['previousList'] : '';
            ?>
            <input type="hidden" name="currentList" value="<?=$curr?>">
            Title:<input type="text" name="noteName" placeholder="Enter a new note name" maxlength="30">
            <br>Note<br>
            <textarea name="noteContent" rows="10" cols="60"></textarea><br><br><br><br><br><br><br><br><br>
            <br>
            <br>
            <input type="submit" value="Save">
        </form>

        <?php
    }
}