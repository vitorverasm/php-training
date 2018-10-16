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
            echo "Task title empty! ";
            return;
        }
        if (empty($data['description'])) {
            echo "Task description empty! ";
            return;
        }
        if ($data['deadline'] == '0000-00-00T00:00:00' || empty($data['deadline'])) {
            echo "Invalid deadline! ";
            return;
        }
        $deadline = explode("T", $data['deadline']);
        $deadline = $deadline[0] . " " . $deadline[1];
        $data['deadline'] = $deadline;

        $data['priority'] = (int)$data['priority'];
        $data['status'] = (int)$data['status'];

        $result = $this->model->insert($data);
        if ($result) {
            //TODO: mandar todas as respostas no formato abaixo.
            $response = array(
                'status'=>'200',
                'message'=>'Task successfully created'
            );
            echo "Task successfully created";
        } else {
            echo "Creation of task failed";
        }
    }

    public function showAllTasks()
    {
        $result = $this->model->showAll();
        if (!empty($result)) {
            foreach ($result as $key => $val) {
                $result[$key] = $this->filter($val);
            }
            $response = json_encode($result, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
            // echo $response;
            return $result;
        } else {
            echo "No tasks created";
        }
    }

    public function showTask($id)
    {
        $result = $this->model->show($id);
        if (!empty($result)) {
            $result = $this->filter($result);
            $response = json_encode($result, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
            echo($response);
        } else {
            echo "Can't get information about this task";
        }
    }

    public function deleteTask($id)
    {
        $result = $this->model->delete($id);
        if ($result) {
            echo "Task deleted";
        } else {
            echo "Task deletion error";
        }
    }

    public function editTask($id, $task)
    {
        if (empty($task['name'])) {
            echo "Task title empty! ";
            return;
        }
        if (empty($task['description'])) {
            echo "Task description empty! ";
            return;
        }
        if ($task['deadline'] == '0000-00-00T00:00:00' || empty($task['deadline'])) {
            echo "Invalid deadline! ";
            return;
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
            echo "Can't update task information";
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