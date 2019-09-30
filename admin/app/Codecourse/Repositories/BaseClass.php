<?php

namespace Codecourse\Repositories;

use Codecourse\Repositories\Database as Database;
use PDO;
use PDOException;

class BaseClass
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
                while ($data = $stmt->fetch(PDO::FETCH_OBJ)) {
                    $indexData[] = $data;
                }
                return $indexData;
            }
        } catch (PDOException $e) {
            echo $e->getMesssage();
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
            $updateView = $stmt->fetch(PDO::FETCH_OBJ);
            if ($updateView) {
                return $updateView;
            } else {
                return false;
            }

            return $updateView;
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
            $dataUpdated = $stmt->execute();
            if ($dataUpdated) {
                return $dataUpdated;
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
        // Select uploaded photo to delete from uploads
        $query = "SELECT photo FROM $table WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([':id' => $_GET['delete_id']]);
        $stmt->bindparam(':id', $id);
        $stmt->execute();
        while ($photo_data = $stmt->fetch(PDO::FETCH_OBJ)) {
            $del_photo = $photo_data->photo;
            unlink($del_photo);
        }
        try {
            $sql = "DELETE FROM $table WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':id' => $_GET['delete_id']]);
            $stmt->bindValue(':id', $id);
            $stmtExec = $stmt->execute();
            if ($stmtExec) {
                return $stmtExec ? true : false;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    /**
     * Redirect url function.
     *
     * @param [type] $url
     *
     * @return void
     */

    public function redirect($url)
    {
        header('Location:' . $url);
    }

    /**
     * Count rows from related table
     *
     * @param [type] $table
     * @return void
     */

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
