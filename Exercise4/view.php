<?php
// View.php
abstract class View
{
    public $layout;
    public function __construct(string $layout) 
    {
        $this->layout = new $layout($this);
    }
    public final function display($data = [])
    {
        $this->layout->renderHeader($data);
        $this->render($data);
        $this->layout->renderFooter($data);
    }
    public abstract function render($data = []);
}
