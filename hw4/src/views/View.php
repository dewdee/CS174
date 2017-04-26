<?php

namespace mn\hw4\views;

use mn\hw4\views\layouts;

abstract class View {
    public $layout;

    public function __construct($logger, string $layout) {
        $this->layout = new layouts\webLayout($this);
    }

    public final function display($data = []) {
        $this->layout->renderHeader($data);
        $this->render($data);
        $this->layout->renderFooter($data);
    }

    public abstract function render($data = []);
}