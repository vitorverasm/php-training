<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL);
use App\Controllers\Controller;

require 'vendor/autoload.php';

$json = '{"name":"Almoço","description":"Almoço na casa da Ana.","deadline":"2018-10-02 12:00:00","priority":1, "status":0}';
$c = new Controller();
// $c->createTask($json);
var_dump ($c->showAllTasks());