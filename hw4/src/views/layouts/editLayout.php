<?php

namespace mn\hw4\views\layouts;

require_once 'Layout.php';

class editLayout extends Layout {
    public function renderHeader($data){
        $data['sheetName'] = "Temp";
        ?>
        <html>
        <head>
            <link rel="stylesheet" type="text/css" href="src/styles/styles.css"/>
            <title> Web Sheets : <?=$data['sheetName']?></title>
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