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
        $this->initializeDB();
        $this->connectDB();
    }
    public function initializeDB()
    {
        // inicializa o banco de dados de tarefas, com as colunas propostas
    }
    public function connectDB()
    {
        try {
            $this->conn = new PDO("mysql:host=" . $this->config['host'] . ";dbname=" . $this->config['dbname'], $this->config['username'], $this->config['password']);
            echo 'Conected!';
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