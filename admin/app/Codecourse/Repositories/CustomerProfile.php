<?php

namespace Codecourse\Repositories;

use Codecourse\Repositories\Database as Database;


use PDO;
use PDOException;

class CustomerProfile
{
    // Database connection constructor
    private $conn;

    public function __construct()
    {
        $database = new Database();
        $dbConnection = $database->dbConnection();
        $this->conn = $dbConnection;
    }
    // View Data in Index page
    public function customerIndex($table12)
    {
        try {
            $sql = "SELECT * FROM $table12";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                while ($result = $stmt->fetch(PDO::FETCH_OBJ)) {
                    $customerData[] = $result;
                }
                return $customerData;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}
