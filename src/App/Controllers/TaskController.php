<?php
use App\Controllers\Controller;

require '../../../vendor/autoload.php';
if (!empty($_POST) && !empty($_POST['action']) && !empty($_POST['body'])) {
    $controller = new Controller();
    switch ($_POST['action']) {
        case 'create':
            $controller->createTask($_POST['body']);
    }
}