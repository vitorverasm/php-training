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

    public function createTask($data)
    {
        $data = json_decode($data, true);
        if (empty($data['name'])) {
            return "Task title empty! ";
        }
        if (empty($data['description'])) {
            return "Task description empty! ";
        }
        if ($data['deadline'] == '0000-00-00T00:00:00' || empty($data['deadline'])) {
            return "Invalid deadline! ";
        }
        $deadline = explode("T", $data['deadline']);
        $deadline = $deadline[0] . " " . $deadline[1];
        $data['deadline'] = $deadline;

        $data['priority'] = (int)$data['priority'];
        $data['status'] = (int)$data['status'];

        $result = $this->model->insert($data);
        if ($result) {
            return "Task successfully created";
        } else {
            return "Creation of task failed";
        }
    }
    public function showAllTasks()
    {
        $result = $this->model->showAll();
        if (!empty($result)) {
            return $result;
        } else {
            return "No tasks created";
        }
    }

    public function deleteTask($id)
    {
        $result = $this->model->delete($id);
        if ($result) {
            return "Task deleted";
        } else {
            return "Task deletion error";
        }
    }
}