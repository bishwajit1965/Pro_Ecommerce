<?php

namespace Codecourse\Repositories;

use PDO;
use PDOException;
use Codecourse\Repositories\Database as Database;
use Codecourse\Repositories\Session as Session;

Session::init();

class Cart
{
    // Database connection constructor
    private $conn;

    public function __construct()
    {
        $database = new Database();
        $dbConnection = $database->dbConnection();
        $this->conn = $dbConnection;
    }
    // Input data validation
    public function validate($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    // View Data in Index page
    public function index($table, $sessionId)
    {
        try {
            $sql = "SELECT * FROM $table WHERE session_id = '$sessionId'";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                while ($cData = $stmt->fetch(PDO::FETCH_OBJ)) {
                    $cartData[] = $cData;
                }
                return $cartData;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    // Insert data
    public function addToCart($table5, $table3, $productId, $quantity, $sessionId)
    {
        try {
            // selected from products table
            $query = "SELECT * FROM $table3 WHERE pro_id = :pro_id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':pro_id', $productId);
            $stmt->execute([':pro_id' => $productId]);
            $cartItem = $stmt->fetch(PDO::FETCH_OBJ);

            // Insert inti cart table
            $query = "INSERT INTO $table5 (session_id, pro_id, pro_name, pro_price, pro_quantity , photo) VALUES('$sessionId', '$productId', '$cartItem->pro_name', '$cartItem->present_price', '$quantity' , '$cartItem->photo')";

            $stmt = $this->conn->prepare($query);
            $stmt->bindValue(":$sessionId", $sessionId);
            $stmt->bindValue(":$productId", $productId);
            $stmt->bindValue(":$cartItem->pro_name", $cartItem->pro_name);
            $stmt->bindValue(":$cartItem->present_price", $cartItem->present_price);
            $stmt->bindValue(":$quantity", $quantity);
            $stmt->bindValue(":$cartItem->photo", $cartItem->photo);
            $stmtExec = $stmt->execute();
            if ($stmtExec) {
                $lastId = $this->conn->lastInsertId();
                return $lastId ? true : false;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    // Prevent duplicate entry
    public function preventDuplicateEntry($table5, $productId, $sessionId)
    {
        $query = "SELECT * FROM $table5 WHERE pro_id = :pro_id && session_id = :session_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':pro_id', $productId);
        $stmt->bindParam(':session_id', $sessionId);
        $stmt->execute();
        $stmtExecute = $stmt->fetch(PDO::FETCH_OBJ);
        if ($stmtExecute) {
            return $stmtExecute;
        } else {
            return false;
        }
    }
    // Update product quantity
    public function updateCartQuantity($table5, $productQuantity, $productId)
    {
        $query = "UPDATE $table5 SET pro_quantity = :pro_quantity WHERE pro_id = :pro_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':pro_quantity', $productQuantity);
        $stmt->bindParam(':pro_id', $productId);
        $updatedQuantity = $stmt->execute();
        if ($updatedQuantity) {
            return $updatedQuantity;
        } else {
            return false;
        }
    }
    // Delete data from database
    public function destroy($id, $table)
    {
        try {
            $sql = "DELETE FROM $table WHERE cart_id = :cart_id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(':cart_id', $id);
            $stmtExec = $stmt->execute();
            if ($stmtExec) {
                return $stmtExec ? true : false;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function redirect($url)
    {
        header("Location: $url");
    }

    public function numberOfRows($table, $sessionId)
    {
        $query = "SELECT FOUND_ROWS() FROM $table WHERE session_id = '$sessionId'";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $rows = $stmt->rowCount();
        if ($rows) {
            return $rows;
        } else {
            return false;
        }
    }
}