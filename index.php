<?php

require 'vendor/autoload.php';

use App\Controllers\Controller;
use App\Models\Model;
use App\Views\View;

$controller = new Controller;
$model = new Model;
$view = new View;

echo $controller->index();
echo $model->index();
echo $view->index();