<?php

namespace views;

require_once 'View.php';

class newListView extends View {
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