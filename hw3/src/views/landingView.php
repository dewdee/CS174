<?php

namespace views;

require_once 'View.php';
require_once (LAYOUT_PATH."landingLayout.php");

class landingView extends View{
    public function __construct($layout){
        parent::__construct($layout);

    }

    public  function render($data = []){
        ?>
        <h1><a href="index.php"><?php
                if(!empty($data['title'])){
                    echo $data['title'];
                }?>
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
                            <li><a href="index.php?c=listController&m=listModel&a=newList">[New List]</a></li>
                            <?php
                                if(!empty($data['lists'])){
                                    foreach($data['lists'] as $name){
                                        ?>
                                        <li><a href="index.php?c=listController&m=listModel&a=view&listName=<?=urlencode($name)?>"><?=$name?></a></li>
                                        <?php
                                    }
                                }
                            ?>
                        </ul>
                    </td>
                    <td><ul>
                            <li><a href="index.php?c=noteController&m=noteModel&a=newNote">[New Note]</a></li>
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