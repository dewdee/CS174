<?php
//index.php
require_once "LetsBuildView.php";
require_once "WebLayout.php";

$data['title'] = "Let's Build Something";
$data['content'] = "<p>Yippee! It works!</p>";
$data['content'] .= "<p>I should figure out how to get this to work with controllers</p>";
$view = new LetsBuildView("WebLayout");
$view->display($data);