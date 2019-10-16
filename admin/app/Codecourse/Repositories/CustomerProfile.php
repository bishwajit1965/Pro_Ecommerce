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
                    $set = "$key = :" . $key;
                    $st = $st . $set;
                } else {
                    $set = "$key = :" . $key . ', ';
                    $st = $st . $set;
                    ++$counter;
                }
            }
            $sql = '';
            $sql .= "UPDATE $table SET " . $st;
            $sql .= ' WHERE id = ' . $id;
            $stmt = $this->conn->prepare($sql);
            foreach ($fields as $key => $value) {
                $stmt->bindValue(':' . $key, $value);
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
                    $set = "$key = :" . $key;
                    $st = $st . $set;
                } else {
                    $set = "$key = :" . $key . ' , ';
                    $st = $st . $set;
                    ++$counter;
                }
            }
            $sql = '';
            $sql .= "UPDATE $table SET " . $st;
            $sql .= ' WHERE id = ' . $id;
            $stmt = $this->conn->prepare($sql);
            foreach ($fields as $key => $value) {
                $stmt->bindValue(':' . $key, $value);
            }
            $result = $stmt->execute();
            if ($result) {
                return $result ? true : false;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    public function redirect($url)
    {
        header("Location: $url");
    }
    // Delete data from database
    public function destroy($id, $table)
    {
        // Select uploaded photo to delete from uploads
        // $query = "SELECT photo FROM $table WHERE id = :id";
        // $stmt = $this->conn->prepare($query);
        // $stmt->execute([':id' => $_GET['delete_id']]);
        // $stmt->bindparam(':id', $id);
        // $stmt->execute();
        // while ($photo_data = $stmt->fetch(PDO::FETCH_OBJ)) {
        //     $del_photo = $photo_data->photo;
        //     unlink($del_photo);
        // }
        try {
            $sql = "DELETE FROM $table WHERE id = :delete_customer_id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':delete_customer_id' => $_GET['delete_customer_id']]);
            $stmt->bindValue(':delete_customer_id', $id);
            $stmtExec = $stmt->execute();
            if ($stmtExec) {
                return $stmtExec ? true : false;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}
