<?php

namespace Codecourse\Repositories;

use Codecourse\Repositories\Database as Database;
use PDO;
use PDOException;

class Register
{
    // Database connection constructor
    private $conn;

    public function __construct()
    {
        $database = new Database();
        $dbConnection = $database->dbConnection();
        $this->conn = $dbConnection;
    }
    // Insert data
    public function store($fields, $table)
    {
        try {
            $columns = implode(', ', array_keys($fields));
            $placeholders = implode(', :', array_keys($fields));
            $query = "INSERT INTO $table ($columns) VALUES(:$placeholders)";
            $stmt = $this->conn->prepare($query);
            foreach ($fields as $key => $value) {
                $stmt->bindValue(':' . $key, $value);
            }
            $stmtExec = $stmt->execute();
            if ($stmtExec) {
                $lastId = $this->conn->lastInsertId();
                return $lastId ? true : false;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    public function redirect($url)
    {
        header('Location:'.$url);
    }
}
