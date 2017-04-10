<?php

require_once 'Layout.php';

class newListLayout extends \Layout {
    public function renderHeader($data){
        ?>
            <html>
            <head>
                <link rel="stylesheet" type="text/css" href="src/styles/styles.css"/>
                <title> Note-A-List
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