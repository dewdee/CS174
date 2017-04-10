<?php

namespace views;

require_once 'View.php';

class selectListView extends View{
    public function render($data = []){
        ?>
        <h1><a href="index.php">Title
            </a>
        </h1>

        <table>
            <tr>
                <th>
                    <h2>Lists</h2>
                </th>
                <th colspan="2">
                    <h2>Notes</h2>
                </th>
            </tr>
            <tr>
                <td><ul>
                        <?php
                            $current = isset($_REQUEST['listName']) ? $_REQUEST['listName'] : '';
                        ?>
                        <li><a href="index.php?c=listController&m=newList&currentList=<?=urlencode($current)?>">[New
                                List]</a></li>
                        <?php
                        if(!empty($data['lists'])){
                            foreach($data['lists'] as $name){
                                ?>
                                <li><a href="index.php?c=listController&m=selectList&currentList=<?=urlencode($current)?>&listName=<?=urlencode($name)
                                    ?>"><?=$name?></a></li>
                                <?php
                            }
                        }
                        ?>
                    </ul>
                </td>
                <td><ul>
                        <li><a href="index.php?c=noteController&m=newNote&currentList=<?=urlencode($current)?>">[New Note]</a></li>
                        <?php
                        if(!empty($data['notes'])){
                            foreach($data['notes'] as $name => $created){
                                ?>
                                <li><a href="index.php?c=noteController&m=selectNote&&currentList=<?=urlencode($current)?>&noteName=<?=urlencode($name)
                                    ?>"><?=$name?></a> <?=$created?></li>
                                <?php
                            }
                        }
                        ?>
                    </ul>
                </td>
            </tr>
        </table>
        <?php
    }
}