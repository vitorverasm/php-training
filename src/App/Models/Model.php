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
        $this->connectDB();
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

}