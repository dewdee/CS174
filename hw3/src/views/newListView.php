<?php


namespace views;


class newListView extends View {
    public function render($data = []){
        ?>
        <h1><a href="index.php">Note-A-List
            </a>
        </h1>
            <h1>New List</h1>
            <form method="get">
                <input type="hidden" name="m" value="newList">
                <input type="hidden" name="c" value="listController">
                <?php
                $curr = isset($_REQUEST['previousList']) ? $_REQUEST['previousList'] : '';
                ?>
                <input type="hidden" name="currentList" value="<?=$curr?>">
                <input type="text" name="listName" placeholder="Enter a new list name" maxlength="20">
                <input type="submit" value="Add">
            </form>
        <?php
    }
}