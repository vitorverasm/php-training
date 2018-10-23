<?php

use App\Controllers\Controller;

require '../../../vendor/autoload.php';

if (!empty($_POST) && !empty($_POST['action'])) {
    $controller = new Controller();
    switch ($_POST['action']) {
        case 'create':
            return $controller->createTask($_POST['body']);
            break;
        case 'get':
            return $controller->showAllTasks();
            break;
        case 'getById':
            return $controller->showTask($_POST['id']);
            break;
        case 'updateById':
            return $controller->editTask($_POST['id'], $_POST['body']);
            break;
        case 'deleteById':
            return $controller->deleteTask($_POST['id']);
            break;
    }
}