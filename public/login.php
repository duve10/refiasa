<?php

require_once '../config/config.php';
require_once '../core/Controller.php';
require_once '../core/Model.php';
require_once '../app/controllers/AuthController.php';

$controller = new AuthController();
$controller->login();
