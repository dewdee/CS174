<?php

namespace mn\hw4\views;

require_once 'View.php';

class readView extends View{
    public function __construct($logger, $layout) {
        parent::__construct($logger, $layout);
        $logger->info('Visited read page');
    }
    public function render($data = []){
        $codes = array_values($data['sheetCodes']);
        $url = [];
        foreach($codes as $code){
            //index.php?c=main&m=edit&arg1=8_digit_hash_e
            $str = 'index.php?c=main&m=edit&arg1='.$code[1].'_'.$code[2];
            array_push($url, $str);
        }
        ?>
            <h1><a href="index.php">Web Sheets : <?=$data['name']?></a></h1>
            <label for="fileURL">File URL:</label>
            <input type="text" id="fileURL" value="test" disabled="disabled"/><br>
            <div id="spreadsheet"></div>
            <script>
                spreadsheet = new Spreadsheet("spreadsheet", [["Tom",5],["Sally", 6]], {"mode":"read"});
                //editable
                spreadsheet.draw();
            </script>
        <?php
    }
}