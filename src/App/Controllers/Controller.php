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
            foreach ($result as $key => $val) {
                $result[$key] = $this->filter($val);
            }
            return $result;
        } else {
            return "No tasks created";
        }
    }

    public function showTask($id)
    {
        $result = $this->model->show($id);
        if (!empty($result)) {
            return $this->filter($result);
        } else {
            return "Can't get information about this task";
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

    public function editTask($id, $task)
    {
        if (empty($task['name'])) {
            return "Task title empty! ";
        }
        if (empty($task['description'])) {
            return "Task description empty! ";
        }
        if ($task['deadline'] == '0000-00-00T00:00:00' || empty($task['deadline'])) {
            return "Invalid deadline! ";
        }
        $deadline = explode("T", $task['deadline']);
        $deadline = $deadline[0] . " " . $deadline[1];
        $task['deadline'] = $deadline;

        $task['priority'] = (int)$task['priority'];
        $task['status'] = (int)$task['status'];

        $result = $this->model->update($id, $task);
        if (!empty($result)) {
            return $result;
        } else {
            return "Can't update task information";
        }
    }

    public function filter($task)
    {
        $result = $task;
        switch ($task['priority']) {
            case '1':
                $result['priority'] = 'Low';
                break;
            case '2':
                $result['priority'] = 'Medium';
                break;
            case '3':
                $result['priority'] = 'High';
                break;
            case '4':
                $result['priority'] = 'Very high';
                break;
        }
        $task['status'] == '0' ? $result['status'] = 'Ongoing' : $result['status'] = 'Done';
        return $result;
    }
}