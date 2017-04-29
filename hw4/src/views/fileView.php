<?php

namespace mn\hw4\views;

require_once 'View.php';

class fileView extends View{
    public function __construct($logger, $layout) {
        parent::__construct($logger, $layout);
        $logger->info('Visited file page');
    }
    public function render($data = []){
        ?>
            <!DOCTYPE spreadsheet SYSTEM "spreadsheet.dtd" >
        <?php
    }
}