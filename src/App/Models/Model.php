<?php

namespace App\Models;

use PDO;

class Model
{
    private $conn;
    private $config;
    public function __construct()
    {
        var_dump('Chama construtor');
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
            var_dump('INITIALIZE TABLE');
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
        var_dump('Chamou método');
        // CREATE: recebe um array de dados da tarefa do controller e cria uma nova linha no banco com as informacoes.
        $sql = "
        INSERT INTO {$this->config['tablename']} (name, description, deadline, priority, status)
        VALUES (:name, :description, :deadline, :priority, :status)
        ";
        try {
            $stmt = $this->conn->prepare($sql);
            
            $values = [
                ':name' => $data['name'],
                ':description' => $data['description'],
                ':deadline' => $data['deadline'],
                ':priority' => $data['priority'],
                ':status' => $data['status'],
            ];

            // $stmt->bindParam(':name', $data['name'], PDO::PARAM_STR);
            // $stmt->bindParam(':description', $data['description'], PDO::PARAM_STR);
            // $stmt->bindParam(':deadline', $data['deadline'], PDO::PARAM_STR);
            // $stmt->bindParam(':priority', $data['priority'], PDO::PARAM_INT);
            // $stmt->bindParam(':status', $data['status'], PDO::PARAM_INT);
            echo "<pre>";
            var_dump($values);
            echo "</pre>";

            if (!$stmt->execute($values)) {
                print_r($stmt->errorInfo());
            }  

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