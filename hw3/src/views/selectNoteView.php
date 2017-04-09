<?php

namespace views;

require_once 'View.php';

class selectNoteView extends View{
    public function render($data = []){
        $noteName = key($data['note']);
        $content = reset($data['note']);
        ?>
            <h2>Read: <?=$noteName ?></h2><br><br>
            <div><?=$content ?></div>
        <?php
    }
}