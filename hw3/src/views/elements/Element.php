<?php

namespace views\elements;

class Element {
    public function display($curr, $prev, $data){
        if($curr != ''){
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
                        //-2 to display parent list
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
            <?php
        }
        else{
            ?>
            <h1><a href="index.php">Note-A-List</a>
                <?php
                if(!empty($data['path']) && !empty($data['path'][0])){
                    $count = count($data['path']);
                    if($count == 1){
                        ?>/<a href="index.php?c=listController&m=selectList&listName=<?= $data['path'][0]?>"><?php
                            echo $data['path'][0]
                            ?></a>
                        <?php
                    }
                    else if($count < 5){
                        foreach ($data['path'] as $path) {
                            ?>/<a href="index.php?c=listController&m=selectList&listName=<?= urlencode($path) ?>"><?php
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
                            ?>/<a href="index.php?c=listController&m=selectList&listName=<?= urlencode($path) ?>"><?php echo $path?></a>
                            <?php
                        }
                    }
                }
                ?>
            </h1>
            <?php
        }
    }
}