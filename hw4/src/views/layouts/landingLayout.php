<?php

namespace mn\hw4\views\layouts;

require_once 'Layout.php';

class landingLayout extends Layout{
    public function renderHeader($data){
        ?>
        <html>
        <head>
            <link rel="stylesheet" type="text/css" href="src/styles/styles.css"/>
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