<?php
use App\Controllers\Controller;

if (!empty($_POST) && isset($_POST['action']) && $_POST['action'] == 'create') {
    $controller = new Controller();
    $controller->createTask($_POST['data']);
}