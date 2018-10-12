<?php
use App\Controllers\Controller;

require '../../../vendor/autoload.php';

if (!empty($_POST)) {
    $controller = new Controller();
    echo $controller->createTask($_POST);
}