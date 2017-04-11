<?php

namespace views;

require_once 'View.php';

class selectNoteView extends View{
    public function render($data = []){
        $prev = isset($_REQUEST['previousList']) ? $_REQUEST['previousList'] : '';
        $this->element->display($curr = '', $prev, $data);
        $noteName = key($data['note']);
        $content = $data['note'][$noteName];
        ?>
            <h2>Read: <?=$noteName ?></h2><br><br>
            <div><?=$content ?></div>
        <?php
    }
}