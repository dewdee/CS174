<?php

namespace views;

require_once 'View.php';

class landingView extends View {
    public function render($data = []){
        $curr = isset($_REQUEST['listName']) ? $_REQUEST['listName'] : '';
        $prev = isset($_REQUEST['previousList']) ? $_REQUEST['previousList'] : '';
        $this->element->display($curr, $prev, $data);
        $this->helper->draw($curr, $data);
    }
}