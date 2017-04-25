<?php

namespace mn\hw4\views\layouts;

abstract class Layout {
    public $view;

    public function __construct($view) {
        $this->view = $view;
    }

    public abstract function renderHeader($data);

    public abstract function renderFooter($data);
}