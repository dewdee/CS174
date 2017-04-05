<?php

require_once 'Layout.php';

class indexLayout extends Layout{
    public function renderHeader($data){
        ?>
        <!DOCTYPE html>
        <head>
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