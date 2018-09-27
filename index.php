<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL);
use App\Models\Model;

require 'vendor/autoload.php';

$json = '{"name":"Reunião","description":"Reunião com o setor de tecnologia","deadline":"2018-09-28 21:30:00","priority":4, "status":1}';
$data = json_decode($json, true);

$m = new Model();
$m->createTask($data);