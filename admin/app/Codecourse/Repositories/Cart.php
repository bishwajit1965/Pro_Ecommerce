<?php

namespace Codecourse\Repositories;

use PDO;
use PDOException;
use Codecourse\Repositories\Database as Database;

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
    public function index($table)
    {
        try {
            $sql = "SELECT * FROM $table";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                while ($cData = $stmt->fetch(PDO::FETCH_OBJ)) {
                    $cartData[] = $cData;
                }
                return $cartData;
            }
        } catch (PDOException $e) {
            echo $e->getMesssage();
        }
    }

    // Insert data
    public function addToCart($table5, $table3, $productId, $quantity, $sessionId)
    {
        try {
            $query = "SELECT * FROM $table3 WHERE pro_id = :pro_id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':pro_id', $productId);
            $stmt->execute([':pro_id' => $productId]);
            $cartItem = $stmt->fetch(PDO::FETCH_OBJ);

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

    // View data to update
    public function updateView($id, $table)
    {
        try {
            $sql = "SELECT * FROM $table WHERE id = :edit_id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(':edit_id', $id);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_OBJ);
            if ($result) {
                return $result;
            } else {
                return false;
            }

            return $result;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    // Update data i database
    public function update($fields, $id, $table)
    {
        // Delete photo from uploads folder
        $stmt = $this->conn->prepare("SELECT photo FROM $table WHERE id = :id");
        $stmt->execute([':id' => $_GET['edit_id']]);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        while ($photo_data = $stmt->fetch(PDO::FETCH_OBJ)) {
            $del_photo = $photo_data->photo;
            unlink($del_photo);
        }
        try {
            $st = '';
            $counter = 1;
            $totalFields = count($fields);
            foreach ($fields as $key => $value) {
                if ($counter === $totalFields) {
                    $set = "$key = :".$key;
                    $st = $st.$set;
                } else {
                    $set = "$key = :".$key.', ';
                    $st = $st.$set;
                    ++$counter;
                }
            }
            $sql = '';
            $sql .= "UPDATE $table SET ".$st;
            $sql .= ' WHERE id = '.$id;
            $stmt = $this->conn->prepare($sql);
            foreach ($fields as $key => $value) {
                $stmt->bindValue(':'.$key, $value);
            }
            $result = $stmt->execute();
            if ($result) {
                return $result;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    // Update eithout photo
    public function updateWithoutPhoto($fields, $id, $table)
    {
        try {
            $st = '';
            $counter = 1;
            $totalFields = count($fields);
            foreach ($fields as $key => $value) {
                if ($counter === $totalFields) {
                    $set = "$key = :".$key;
                    $st = $st.$set;
                } else {
                    $set = "$key = :".$key.' , ';
                    $st = $st.$set;
                    ++$counter;
                }
            }
            $sql = '';
            $sql .= "UPDATE $table SET ".$st;
            $sql .= ' WHERE id = '.$id;
            $stmt = $this->conn->prepare($sql);
            foreach ($fields as $key => $value) {
                $stmt->bindValue(':'.$key, $value);
            }
            $result = $stmt->execute();
            if ($result) {
                return $result ? true : false;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    // View data to destroy
    public function destroyView($id, $table)
    {
        try {
            $sql = "SELECT * FROM $table WHERE id = :delete_id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(':delete_id', $id);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_OBJ);
            if ($result) {
                return $result;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
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

    public function numberOfRows($table)
    {
        $query = "SELECT FOUND_ROWS() FROM $table";
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