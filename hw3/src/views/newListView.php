<?php


namespace views;


class newListView extends View {
    public function render($data = []){
        ?>
        <h1><a href="index.php">Title
            </a>
        </h1>
            <h1>New List</h1>
            <form method="get">
                <input type="hidden" name="m" value="newList">
                <input type="hidden" name="c" value="listController">
                <input type="hidden" name="a" value="new">
                <input type="text" name="listName" placeholder="Enter a new list name" maxlength="20">
                <input type="submit" value="Add">
            </form>
        <?php
    }
}