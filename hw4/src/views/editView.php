<?php

namespace mn\hw4\views;

require_once 'View.php';

class editView extends View{
    public function __construct($logger, $layout) {
        parent::__construct($logger, $layout);
        $logger->info('Visited edit page');
    }
    public function render($data = []){
        ?>
            <h1><a href="index.php">Web Sheets</a> : <?=$data['sheetName']?></h1>
            <label for="editURL">Edit URL:</label>
            <input type="text" id="editURL" value="test" disabled="disabled"/><br>
            <label for="readURL">Read URL:</label>
            <input type="text" id="readURL" value="test" disabled="disabled"/><br>
            <label for="fileURL">File URL:</label>
            <input type="text" id="fileURL" value="test" disabled="disabled"/><br>
            <div id="spreadsheet"></div>
            <script>
                spreadsheet = new Spreadsheet("spreadsheet", [["", ""],["", ""]],
                {"mode":"write"});
                //editable
                spreadsheet.draw();
            </script>
        <?php
    }
}