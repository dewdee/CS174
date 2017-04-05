<?php

namespace views;

require_once 'View.php';
require_once(ROOT.'/src/views/layouts/indexLayout.php');

class indexView extends View{
    public  function render($data = []){
        ?>
        <h1><a href="index.php"><?php
                if(!empty($data['title'])){
                    echo $data['title'];
                }?>
            </a>
        </h1>
        <h2>
            <table>
                <tr>
                    <th>
                        Lists
                    </th>
                    <th colspan="2">
                        Notes
                    </th>
                </tr>
                <tr>
                    <td><ul>
                            <li><a href="index.php?a=newList">[New List]</a></li>
                            <li><b>list 1</b></li>
                            <li><b>list 2</b></li>
                        </ul>
                    </td>
                    <td><ul>
                            <li><a href="index.php?a=newNote">[New Note]</a></li>
                            <li><b>note 1</b></li>
                            <li><b>note 2</b></li>
                        </ul>
                    </td>
                </tr>
            </table>
        </h2>
        <?php
    }
}