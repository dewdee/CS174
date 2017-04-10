<?php

namespace views;

require_once 'View.php';

class selectNoteView extends View{
    public function render($data = []){
        ?>
        <h1><a href="index.php">Note-A-List
            </a>
        </h1>
        <?php
        $noteName = key($data['note']);
        $content = $data['note'][$noteName];
        ?>
            <h2>Read: <?=$noteName ?></h2><br><br>
            <div><?=$content ?></div>
        <?php
    }
}