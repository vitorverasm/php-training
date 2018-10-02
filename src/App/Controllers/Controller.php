<?php

namespace App\Controllers;

use App\Models\Model;

class Controller
{
    private $model;
    public function __construct()
    {
        $this->model = new Model();
    }

    public function createTask($json)
    {
        $data = json_decode($json, true);
        $result = $this->model->insert($data);
        if ($result) {
            return "Tarefa criada com sucesso";
        } else {
            return "Falha na criação da tarefa";
        }
    }
    public function showAllTasks()
    {
        $result = $this->model->showAll();
        if (!empty($result)) {
            return $result;
        } else {
            return "Nenhuma tarefa criada";
        }
    }
}