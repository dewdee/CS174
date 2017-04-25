<?php

namespace mn\hw4\views;

require_once 'View.php';

class landingView extends View {
    public function render($data = []){
        ?>
        <h1><a href="index.php?c=main&m=view">Web Sheets</a></h1>
        <form>
            <input id="sheetID"/>
            <input type="button" value="Enter" onclick="display();"/>
        </form>
        <?php
    }
}