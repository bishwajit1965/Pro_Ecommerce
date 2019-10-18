<?php

namespace Codecourse\Repositories;

use Codecourse\Repositories\Database as Database;
use PDO;
use PDOException;

class LoginCustomer
{
    // Database connection constructor
    private $conn;

    public function __construct()
    {
        $database = new Database();
        $dbConnection = $database->dbConnection();
        $this->conn = $dbConnection;
    }
    public function logIn($email, $table)
    {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM $table WHERE email=:email");
            $stmt->execute([':email' => $email]);
            $customerData = $stmt->fetch(PDO::FETCH_OBJ);
            if ($stmt->rowCount() == 1) {
                if (!empty($customerData)) {
                    return $customerData;
                } else {
                    return false;
                }
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    // Redirect to desired page
    public function redirect($url)
    {
        header("Location: $url");
    }
}
