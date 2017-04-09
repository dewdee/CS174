<?php


namespace views;


class newListView extends View {
    public function render($data = []){
        ?>
            <h1>New List</h1>
            <form method="get">
                <input type="hidden" name="a" value="create">
                <input type="text" name="listName" placeholder="Enter a new list name" maxlength="20">
                <input type="submit" value="Add">
            </form>
        <?php
    }
}