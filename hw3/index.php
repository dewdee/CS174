<?php

namespace mn\hw3;

define('ROOT', dirname(__FILE__));
require_once 'src/controllers/listController.php';
require_once 'src/models/listModel.php';
require_once 'src/views/landingView.php';

$data['title'] = "Note-A-List";
$controller = new \controllers\listController($data);
