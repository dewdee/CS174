<?php

namespace mn\hw4\views\layouts;

require_once 'Layout.php';

class webLayout extends Layout{
    public function renderHeader($data){
        ?>
        <html>
        <head>
            <link rel="stylesheet" type="text/css" href="src/styles/styles.css"/>
            <script type="text/javascript" src="src/resources/spreadsheet.js"></script>
            <meta http-equiv='cache-control' content='no-cache'>
            <meta http-equiv='expires' content='0'>
            <meta http-equiv='pragma' content='no-cache'>
            <title> Web Sheets </title>
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