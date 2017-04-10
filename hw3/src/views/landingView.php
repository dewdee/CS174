<?php

namespace views;

require_once 'View.php';

class landingView extends View {
    public function render($data = []){
        $curr = isset($_REQUEST['listName']) ? $_REQUEST['listName'] : '';
        $prev = isset($_REQUEST['previousList']) ? $_REQUEST['previousList'] : '';
        ?>
        <h1>
            <a href="index.php">Note-A-List</a>
            <?php
            if(!empty($data['path'])){
                if(count($data['path']) == 1){
                    ?>
                    / <a href="index.php?c=listController&m=selectList&previousList=&listName=<?=urlencode($curr)?>"><?php echo $data['path'][0]?></a>
                    <?php
                }
                else {
                    foreach ($data['path'] as $path) {
                        ?>
                        /
                        <a href="index.php?c=listController&m=selectList&previousList=<?= urlencode($prev) ?>&listName=<?= urlencode($path) ?>"><?php echo $path?></a>
                        <?php
                    }
                }
            }
            ?>
        </h1>
        <div>
            <table>
                <tr>
                    <th>
                        <h2>Lists</h2>
                    </th>
                </tr>
                <tr>
                    <td><ul>
                            <li><a href="index.php?c=listController&m=newList&previousList=<?=urlencode($curr)?>">[New List]</a></li>
                            <?php
                            if(!empty($data['lists'])){
                                foreach($data['lists'] as $name){
                                    ?>
                                    <li><a href="index.php?c=listController&m=selectList&previousList=<?=urlencode($curr)?>&listName=<?=urlencode($name)
                                        ?>"><?=$name?></a></li>
                                    <?php
                                }
                            }
                            ?>
                        </ul>
                    </td>
                </tr>
            </table>
        </div>
        <div>
            <table>
                <tr>
                    <th colspan="2">
                        <h2>Notes</h2>
                    </th>
                </tr>
                <tr>
                    <td><ul>
                            <li><a href="index.php?c=noteController&m=newNote&previousList=<?=urlencode($curr)?>">[New Note]</a></li>
                            <?php
                            if(!empty($data['notes'])){
                                foreach($data['notes'] as $name => $created){
                                    ?>
                                    <li><a href="index.php?c=noteController&m=selectNote&previousList=<?=urlencode($curr)?>&noteName=<?=urlencode($name)
                                        ?>"><?=$name?></a> <?=$created?></li>
                                    <?php
                                }
                            }
                            ?>
                        </ul>
                    </td>
                </tr>
            </table>
        </div>


        <?php
    }
}