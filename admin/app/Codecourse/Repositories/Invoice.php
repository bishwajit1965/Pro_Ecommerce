<?php

namespace Codecourse\Repositories;

use Codecourse\Repositories\Database as Database;
use PDO;
use PDOException;

class Invoice
{
    // Database connection constructor
    private $conn;

    public function __construct()
    {
        $database = new Database();
        $dbConnection = $database->dbConnection();
        $this->conn = $dbConnection;
    }
    // Processes order to buy product and inserts data in 'tbl_orders'
    public function generateInvoice($tableOrders, $sessionId, $orderId, $tableInvoice)
    {
        try {
            // Retrieves all the data from orders table
            $sql = "SELECT * FROM $tableOrders WHERE session_id = '$sessionId' && order_id = '$orderId'";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                // fethAll() is important bacause feth() will fetch only one row
                while ($orderedProductData = $stmt->fetchAll(PDO::FETCH_OBJ)) {
                    // Looping through all the data available in orders table from'fetchAll()
                    foreach ($orderedProductData as $orderedProduct) {
                        $pro_id = $orderedProduct->pro_id;
                        $pro_name = $orderedProduct->pro_name;
                        $pro_number = $orderedProduct->pro_number;
                        $pro_description = $orderedProduct->pro_description;
                        $pro_quantity = $orderedProduct->pro_quantity;
                        $pro_price = $orderedProduct->pro_price;
                        $total_price = $pro_price *  $pro_quantity;
                        $photo = $orderedProduct->photo;
                        $customer_id = $orderedProduct->customer_id;
                        $session_id = $orderedProduct->session_id;
                        $order_id = $orderedProduct->order_id;
                        // Inserts dat to invoice table
                        $query = "INSERT INTO $tableInvoice (
                            pro_id,
                            pro_name,
                            pro_number,
                            pro_description,
                            pro_quantity,
                            pro_price,
                            total_price,
                            photo,
                            customer_id,
                            customer_session,
                            order_id
                            )
                            VALUES (
                                '$pro_id',
                                '$pro_name',
                                '$pro_number',
                                '$pro_description',
                                '$pro_quantity',
                                '$pro_price',
                                '$total_price',
                                '$photo',
                                '$customer_id',
                                '$session_id',
                                '$order_id')";
                        $stmt = $this->conn->prepare($query);
                        $stmt->bindParam(":$pro_id", $pro_id);
                        $stmt->bindParam(":$pro_name", $pro_name);
                        $stmt->bindParam(":$pro_number", $pro_number);
                        $stmt->bindParam(":$pro_description", $pro_description);
                        $stmt->bindParam(":$pro_quantity", $pro_quantity);
                        $stmt->bindParam(":$pro_price", $pro_price);
                        $stmt->bindParam(":$total_price", $total_price);
                        $stmt->bindParam(":$photo", $photo);
                        $stmt->bindParam(":$customer_id", $customer_id);
                        $stmt->bindParam(":$session_id", $session_id);
                        $stmt->bindParam(":$order_id", $order_id);
                        $invoiceData = $stmt->execute();
                    }
                }
                return $invoiceData;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    // Redirect
    public function redirect($url)
    {
        header("Location: $url");
    }

    // select data from invoice table
    public function retrieveDataFromInvoice($tableInvoice)
    {
        try {
            $sql = "SELECT * FROM $tableInvoice";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                while ($customerOrder = $stmt->fetch(PDO::FETCH_OBJ)) {
                    $invoiceData[] = $customerOrder;
                }
                return $invoiceData;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    // Prevent duplicate entry
    public function preventDuplicateEntry($tableInvoice, $orderId, $sessionId)
    {
        $query = "SELECT * FROM $tableInvoice WHERE order_id = :order_id && customer_session = :session_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':order_id', $orderId);
        $stmt->bindParam(':session_id', $sessionId);
        $stmt->execute();
        $stmtExecute = $stmt->fetch(PDO::FETCH_OBJ);
        if ($stmtExecute) {
            return $stmtExecute;
        } else {
            return false;
        }
    }
    // Processes order to buy product and inserts data in 'tbl_orders'
    public function getCustomerData($tableCustomer, $customerId, $tableInvoice)
    {
        try {
            // Retrieves all the data from orders table
            $sql = "SELECT * FROM $tableCustomer WHERE id = '$customerId'";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                // fethAll() is important bacause feth() will fetch only one row
                while ($customerData = $stmt->fetch(PDO::FETCH_OBJ)) {
                    // Looping through all the data available in orders table from'fetchAll()
                    foreach ($customerData as $customer) {
                        $customer_id = $customer->id;
                        $customer_name = $customer->name;
                        $customer_email = $customer->email;
                        $customer_phone = $customer->phone;
                        $customer_address = $customer->address;
                        $customer_city = $customer->city;
                        $customer_country = $customer->country;
                        $customer_zip_code = $customer->zip_code;
                        // Inserts dat to invoice table
                        $query = "INSERT INTO $tableInvoice (
                            customer_id,
                            customer_name,
                            customer_email,
                            customer_phone,
                            customer_address,
                            customer_city,
                            customer_country,
                            customer_zip_code)
                            VALUES (
                                '$customer_id',
                                '$customer_name',
                                '$customer_email',
                                '$customer_phone',
                                '$customer_address',
                                '$customer_city',
                                '$customer_country',
                                '$customer_zip_code')";

                        $stmt = $this->conn->prepare($query);
                        $stmt->bindParam(":$customer_id", $customer_id);
                        $stmt->bindParam(":$customer_name", $customer_name);
                        $stmt->bindParam(":$customer_email", $customer_email);
                        $stmt->bindParam(":$customer_phone", $customer_phone);
                        $stmt->bindParam(":$customer_address", $customer_address);
                        $stmt->bindParam(":$customer_city", $customer_city);
                        $stmt->bindParam(":$customer_country", $customer_country);
                        $stmt->bindParam(":$customer_zip_code", $customer_zip_code);
                        $ivoiceData = $stmt->execute();
                    }
                }
                return $ivoiceData;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    public function numberOfRows($table, $sessionId)
    {
        $query = "SELECT FOUND_ROWS() FROM $table WHERE customer_session = '$sessionId'";
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
