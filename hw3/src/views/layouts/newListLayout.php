<?php

require_once 'Layout.php';

class newListLayout extends Layout{
    public function renderHeader($data){
        ?>
        <!DOCTYPE html>
        <html>
        <head>
            <link rel="stylesheet" type="text/css" href="src/styles/styles.css"/>
            <title><?php
                if(!empty($data['title'])){
                    echo $data['title'];
                }
                ?>
            </title>
        </head>
        <body>
        <?php
    }
    public function renderFooter($data){
        ?>
        </body>
        </html>
        <?php
    }
}