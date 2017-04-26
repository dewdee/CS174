<?php

namespace mn\hw4\views;

require_once 'View.php';

class editView extends View{
    public function render($data = []){
        ?>
            <h1><a href="index.php">Web Sheets : <?=$data['sheetName']?></a></h1>
            <label for="editURL">Edit URL:</label>
            <input type="text" id="editURL" value="test" disabled="disabled"/><br>
            <label for="readURL">Read URL:</label>
            <input type="text" id="readURL" value="test" disabled="disabled"/><br>
            <label for="fileURL">File URL:</label>
            <input type="text" id="fileURL" value="test" disabled="disabled"/><br>
        <?php
    }
}