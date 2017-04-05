<?php

namespace mn\hw3;

define('ROOT', dirname(__FILE__));
require_once 'src/controllers/mainController.php';
require_once 'src/models/listModel.php';
require_once 'src/views/indexView.php';

$data['title'] = "Let's Build Something";
$data['content'] = "<p>Yippee! It works!</p>";
$controller = new \controllers\mainController();
$controller->view->display($data);