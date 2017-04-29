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
        $url = $_SERVER['SERVER_NAME'].'/cs174/hw4/index.php?c=api&m=file&arg1=';
        $url .= $codes[2][1]; //From our code list, file code is 3rd and hash code is index 1
        $spreadsheet = [["", ""],["", ""]];
        ?>
            <h1><a href="index.php">Web Sheets : <?=$data['name']?></a></h1>
            <label for="fileURL">File URL:</label>
            <input type="text" id="fileURL" value=<?=$url?> disabled="disabled"/><br/>
            <div id="spreadsheet"></div>
            <script>
                spreadsheet = new Spreadsheet("spreadsheet", <?php echo json_encode($spreadsheet)?>, {"mode":"read"});
                spreadsheet.draw();
            </script>
        <?php
    }
}