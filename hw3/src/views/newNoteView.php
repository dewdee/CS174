<?php

namespace views;


class newNoteView extends View {
    public function render($data = []){
        $curr = isset($_REQUEST['listName']) ? $_REQUEST['listName'] : '';
        $prev = isset($_REQUEST['previousList']) ? $_REQUEST['previousList'] : '';
        ?>
        <h1><a href="index.php">Note-A-List</a>
            <?php
            if(!empty($data['path']) && !empty($data['path'][0])){
                $count = count($data['path']);
                if($count == 1){
                    ?>/<a href="index.php?c=listController&m=selectList&previousList=&listName=<?=urlencode($curr)?>"><?php echo $data['path'][0]?></a>
                    <?php
                }
                else if($count < 5){

                    foreach ($data['path'] as $path) {
                        ?>/<a href="index.php?c=listController&m=selectList&previousList=<?= urlencode($prev) ?>&listName=<?= urlencode($path) ?>"><?php echo $path?></a>
                        <?php
                    }
                }
                else if($count >= 5){
                    for($i = 0; $i < $count - 2; $i++){
                        array_shift($data['path']);
                    }
                    ?>/.. <?php
                    foreach ($data['path'] as $path) {
                        ?>/<a href="index.php?c=listController&m=selectList&previousList=<?= urlencode($prev) ?>&listName=<?= urlencode($path) ?>"><?php echo $path?></a>
                        <?php
                    }
                }
            }
            ?>
        </h1>
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