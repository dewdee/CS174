<?php

namespace views;

require_once 'View.php';

class selectNoteView extends View{
    public function render($data = []){
        $curr = isset($_REQUEST['listName']) ? $_REQUEST['listName'] : '';
        $prev = isset($_REQUEST['previousList']) ? $_REQUEST['previousList'] : '';
        ?>
        <h1><a href="index.php">Note-A-List</a>
            <?php
            if(!empty($data['path']) && !empty($data['path'][0])){
                $count = count($data['path']);
                if($count == 1){
                    ?>/<a href="index.php?c=listController&m=selectList&listName="><?php echo $data['path'][0] ?></a>
                    <?php
                }
                else if($count < 5){
                    foreach ($data['path'] as $path) {
                        ?>/<a href="index.php?c=listController&m=selectList&listName=<?= urlencode($prev) ?>"><?php
                            echo $path?></a>
                        <?php
                    }
                }
                else if($count >= 5){
                    for($i = 0; $i < $count - 2; $i++){
                        array_shift($data['path']);
                    }
                    ?>/.. <?php
                    foreach ($data['path'] as $path) {
                        ?>/<a href="index.php?c=listController&m=selectList&listName=<?= urlencode($prev) ?>"><?php echo $path?></a>
                        <?php
                    }
                }
            }
            ?>
        </h1>
        <?php
        $noteName = key($data['note']);
        $content = $data['note'][$noteName];
        ?>
            <h2>Read: <?=$noteName ?></h2><br><br>
            <div><?=$content ?></div>
        <?php
    }
}