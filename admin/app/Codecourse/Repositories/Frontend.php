<?php

namespace Codecourse\Repositories;

use Codecourse\Repositories\Database as Database;
use PDO;
use PDOException;

class Core
{
    // Database connection constructor
    private $conn;

    public function __construct()
    {
        $database = new Database();
        $dbConnection = $database->dbConnection();
        $this->conn = $dbConnection;
    }

}
