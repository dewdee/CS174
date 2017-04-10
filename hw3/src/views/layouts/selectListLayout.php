<?php

require_once 'Layout.php';

class selectListLayout extends Layout {
    public function renderHeader($data){
        ?>
        <html>
        <head>
            <link rel="stylesheet" type="text/css" href="src/styles/styles.css"/>
            <title> This is a temporary title
            </title>
        </head>
        <body>
        <?php
    }
    public function renderFooter($data) {
        ?>
        </body>
        </html>
        <?php
    }
}