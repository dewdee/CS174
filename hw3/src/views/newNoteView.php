<?php

namespace views;


class newNoteView extends View {
    public function render($data = []){
        ?>
        <h1><a href="index.php">Title
            </a>
        </h1>
        <h1>New Note</h1>

        <form method="get">
            <input type="hidden" name="m" value="newNote">
            <input type="hidden" name="c" value="noteController">
            <input type="hidden" name="a" value="new">
            Title:<input type="text" name="noteName" placeholder="Enter a new note name" maxlength="20">
            <br><br>
            Note<br><textarea name="noteContent" rows="30" cols="80" style="width:5in;height:2in;" rows="3"
                       cols="50"></textarea>
            <input type="submit" value="Save">
        </form>

        <?php
    }
}