<?php

namespace App\Models;

use PDO;

class Model
{
    private $conn;
    private $config;
    public function __construct()
    {
        $this->config = parse_ini_file($_SERVER['DOCUMENT_ROOT'] . '/lib/config.ini');
        $this->conn = $this->connectDB();
        $this->initializeTable();
    }
    public function initializeTable()
    {
        $sql = "
        CREATE TABLE IF NOT EXISTS {$this->config['tablename']}(
            id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
            name VARCHAR(30) NOT NULL,
            description VARCHAR(100) NOT NULL,
            deadline DATETIME,
            priority INT,
            status TINYINT(1)
            );
        ";
        try {
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
            die();
        }
    }
    public function connectDB()
    {
        try {
            $conn = new PDO("mysql:host=" . $this->config['host'] . ";dbname=" . $this->config['dbname'] . ";charset=utf8", $this->config['username'], $this->config['password']);
            echo 'Conected!';
            return $conn;
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }
    public function showAllTasks()
    {
        // READ: retorna toda tabela de tarefas
    }
    public function showTask($id)
    {
        // READ: retorna uma específica linha utilizando o $id
    }
    public function createTask($data)
    {
        // CREATE: recebe um array de dados da tarefa do controller e cria uma nova linha no banco com as informacoes.
        $sql = "
        INSERT INTO {$this->config['tablename']} (name, description, deadline, priority, status)
        VALUES (?, ?, ?, ?, ?)
        ";
        try {
            $stmt = $this->conn->prepare($sql);
            
            // $stmt->bindParam(':name', $data['name'], PDO::PARAM_STR);
            // $stmt->bindParam(':description', $data['description'], PDO::PARAM_STR);
            // $stmt->bindParam(':deadline', $data['deadline'], PDO::PARAM_STR);
            // $stmt->bindParam(':priority', $data['priority'], PDO::PARAM_INT);
            // $stmt->bindParam(':status', $data['status'], PDO::PARAM_INT);

            $stmt->execute([$data['name'], $data['description'], $data['deadline'], $data['priority'], $data['status']]);

        } catch (PDOException $e) {
            if($e->errorInfo[1] === 1062) echo 'Duplicate entry';
        }
    }
    public function deleteTask($id)
    {
        // DELETE: deleta uma tarefa específica do banco utilizando $id.
    }
    public function updateTask($id)
    {
        // UPDATE: atualiza uma tarefa específica utilizando o $id.
    }

}