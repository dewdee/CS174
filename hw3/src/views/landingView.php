<?php


namespace views;

require_once 'View.php';

class landingView extends View {
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
                        <li><a href="index.php?c=listController&m=newList&a=new">[New List]</a></li>
                        <?php
                        if(!empty($data['lists'])){
                            foreach($data['lists'] as $name){
                                ?>
                                <li><a href="index.php?c=listController&m=selectList&a=view&listName=<?=urlencode($name)
                                    ?>"><?=$name?></a></li>
                                <?php
                            }
                        }
                        ?>
                    </ul>
                </td>
                <td><ul>
                        <li><a href="index.php?c=noteController&m=newNote&a=new">[New Note]</a></li>
                        <?php
                        if(!empty($data['notes'])){
                            foreach($data['notes'] as $name => $created){
                                ?>
                                <li><a href="index.php?c=noteController&m=noteModel&a=view&noteName=<?=urlencode($name)?>"><?=$name?></a> <?=$created?></li>
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