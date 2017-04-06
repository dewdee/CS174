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
                            <li><a href="index.php?c=listController&m=listModel&a=new">[New List]</a></li>
                        </ul>
                    </td>
                    <td><ul>
                            <li><a href="index.php?c=noteController&m=noteModel&a=new">[New Note]</a></li>

                        </ul>
                    </td>
                </tr>
            </table>
        <?php
    }
}