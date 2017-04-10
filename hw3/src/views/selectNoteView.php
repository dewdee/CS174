<?php

namespace views;

require_once 'View.php';

class selectNoteView extends View{
    public function render($data = []){
        $noteName = key($data['note']);
        $content = $data['note'][$noteName];
        ?>
            <h2>Read: <?=$noteName ?></h2><br><br>
            <div><?=$content ?></div>
        <?php
    }
}