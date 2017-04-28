<?php

namespace mn\hw4\views;

require_once 'View.php';

class editView extends View{
    public function __construct($logger, $layout) {
        parent::__construct($logger, $layout);
        $logger->info('Visited edit page');
    }
    public function render($data = []){
        $codes = array_values($data['sheetCodes']);
        $url = [];
        foreach($codes as $code){
            //index.php?c=api&m=edit&arg1=8_digit_hash_e
            $m = "";
            switch($code[2]){
                case 'e':
                    $m = "edit";
                    break;
                case 'r':
                    $m = "read";
                    break;
                case 'f':
                    $m = "file";
                    break;
            }
            $str = $_SERVER['SERVER_NAME'].'/cs174/hw4/index.php?c=api&m='.$m.'&arg1='.$code[1];
            array_push($url, $str);
        }
        ?>
            <h1><a href="index.php">Web Sheets</a> : <?=$data['name']?></h1>
            <label for="editURL">Edit URL:</label>
            <input type="text" id="editURL" value="<?=$url[0]?>" disabled="disabled"/><br>
            <label for="readURL">Read URL:</label>
            <input type="text" id="readURL" value="<?=$url[1]?>" disabled="disabled"/><br>
            <label for="fileURL">File URL:</label>
            <input type="text" id="fileURL" value="<?=$url[2]?>" disabled="disabled"/><br>
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