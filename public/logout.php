<?php

require_once '../config/config.php';
require_once '../core/Auth.php';

Auth::logout();
header('Location: ' . BASE_URL . 'public/login.php');
exit();
