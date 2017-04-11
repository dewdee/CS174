<?php

namespace views\helpers;

class Helper {
    public function draw($curr, $data){
        ?>
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