<?php

namespace views;


class newNoteView extends View {
    public function render($data = []){
        ?>
        <h1><a href="index.php">Note-A-List
            </a>
        </h1>
        <h1>New Note</h1>

        <form method="get">
            <input type="hidden" name="m" value="newNote">
            <input type="hidden" name="c" value="noteController">
            <?php
            $curr = isset($_REQUEST['previousList']) ? $_REQUEST['previousList'] : '';
            ?>
            <input type="hidden" name="currentList" value="<?=$curr?>">
            Title:<input type="text" name="noteName" placeholder="Enter a new note name" maxlength="20">
            <br><br>
            Note<br><textarea name="noteContent" rows="30" cols="80" style="width:5in;height:2in;" rows="3"
                       cols="50"></textarea>
            <input type="submit" value="Save">
        </form>

        <?php
    }
}