<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL);
use App\Controllers\Controller;

require 'vendor/autoload.php';

$controller = new Controller();
$result = $controller->showAllTasks();

require_once './index.html';
