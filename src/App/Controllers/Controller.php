<?php

namespace App\Controllers;

use App\Models\Model;

class Controller
{
    private $model;
    public function __construct()
    {
        $model = new Model();
    }

    public function createTask($json)
    {
        $data = json_decode($json, true);
        $result = $this->model->insert($data);
        if ($result){
            echo "erro";
        }else{
            echo "deu certo insere";
        }
    }
}