<?php

namespace views;

require_once 'View.php';

class landingView extends View {
    public function render($data = []){
        ?>
        <h1><a href="index.php">Note-A-List
            </a>
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
                            <?php
                            $prev = isset($_REQUEST['listName']) ? $_REQUEST['listName'] : '';
                            ?>
                            <li><a href="index.php?c=listController&m=newList&previousList=<?=urlencode($prev)?>">[New List]</a></li>
                            <?php
                            if(!empty($data['lists'])){
                                foreach($data['lists'] as $name){
                                    ?>
                                    <li><a href="index.php?c=listController&m=selectList&previousList=<?=urlencode($prev)?>&listName=<?=urlencode($name)
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
                            <li><a href="index.php?c=noteController&m=newNote&previousList=<?=urlencode($prev)?>">[New Note]</a></li>
                            <?php
                            if(!empty($data['notes'])){
                                foreach($data['notes'] as $name => $created){
                                    ?>
                                    <li><a href="index.php?c=noteController&m=selectNote&previousList=<?=urlencode($prev)?>&noteName=<?=urlencode($name)
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