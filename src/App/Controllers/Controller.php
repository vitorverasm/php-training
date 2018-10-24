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

    public function sendResponse($statusCode, $message, $data = null)
    {
        $response = array(
            'status' => $statusCode,
            'message' => $message,
            'data' => $data
        );
        $response = json_encode($response, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
        echo $response;
    }

    public function getErrors($data)
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
        return false;
    }
    public function createTask($data)
    {
        $data = json_decode($data, true);
        $error = $this->getErrors($data);
        if ($error) {
            $this->sendResponse('400', $error);
            return;
        }
        $deadline = explode("T", $data['deadline']);
        $deadline = $deadline[0] . " " . $deadline[1];
        $data['deadline'] = $deadline;

        $data['priority'] = (int)$data['priority'];
        $data['status'] = (int)$data['status'];

        $result = $this->model->insert($data);
        if ($result) {
            $this->sendResponse('200', 'Task successfully created');
        } else {
            $this->sendResponse('400', 'Task creation failed');
        }
    }

    public function showAllTasks()
    {
        $result = $this->model->showAll();
        if (!empty($result)) {
            foreach ($result as $key => $val) {
                $result[$key] = $this->filter($val);
            }
            $this->sendResponse('200', 'OK', $result);
        } else {
            $this->sendResponse('400', 'No tasks created');
        }
    }

    public function showTask($id)
    {
        $result = $this->model->show($id);
        if (!empty($result)) {
            $result = $this->filter($result);
            $this->sendResponse('200', 'OK', $result);
        } else {
            $this->sendResponse('400', 'Cant get information about this task');
        }
    }

    public function deleteTask($id)
    {
        $result = $this->model->delete($id);
        if ($result) {
            $this->sendResponse('200', 'Success! Task deleted');
        } else {
            $this->sendResponse('400', 'Error! Task deletion error');
        }
    }

    public function editTask($id, $task)
    {
        $task = json_decode($task, true);
        $error = $this->getErrors($task);
        if ($error) {
            $this->sendResponse('400', $error);
            return;
        }
        $deadline = explode("T", $task['deadline']);
        $deadline = $deadline[0] . " " . $deadline[1];
        $task['deadline'] = $deadline;

        $task['priority'] = (int)$task['priority'];
        $task['status'] = (int)$task['status'];

        $result = $this->model->update($id, $task);
        if (!empty($result)) {
            $this->sendResponse('200', 'Update successful!', $result);
        } else {
            $this->sendResponse('400', 'Cant update task information');
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