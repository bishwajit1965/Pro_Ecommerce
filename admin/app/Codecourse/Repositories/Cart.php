<?php

namespace Codecourse\Repositories;

use Codecourse\Repositories\Database as Database;
use Codecourse\Repositories\Session as Session;
use PDO;
use PDOException;

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

    // View Data in Index page
    public function priceDisplay($table, $sessionId)
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

    // Processes order to buy product and inserts data in 'tbl_orders'
    public function processOrderToBuyProduct($tableCart, $sessionId, $tableOrders)
    {
        try {
            // selects all the data from cart table
            $sql = "SELECT * FROM $tableCart WHERE session_id = '$sessionId'";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                // fethAll() is important bacause feth() will fetch only one row
                while ($productData = $stmt->fetchAll(PDO::FETCH_OBJ)) {
                    // Looping through all the data available in cart table from'fetchAll()
                    foreach ($productData as $cartProduct) {
                        $cart_id = $cartProduct->cart_id;
                        $customer_id = $cartProduct->customer_id;
                        $session_id = $cartProduct->session_id;
                        $pro_id = $cartProduct->pro_id;
                        $pro_name = $cartProduct->pro_name;
                        $pro_price = $cartProduct->pro_price;
                        $pro_quantity = $cartProduct->pro_quantity;
                        $total_price = $pro_price *  $pro_quantity;
                        $photo = $cartProduct->photo;

                        // Inserts dat to orders table
                        $query = "INSERT INTO $tableOrders (cart_id, customer_id, session_id, pro_id, pro_name, pro_price, pro_quantity, total_price, photo) VALUES ('$cart_id', '$customer_id', '$session_id', '$pro_id', '$pro_name', '$pro_price', '$pro_quantity', '$total_price', '$photo')";

                        $stmt = $this->conn->prepare($query);
                        $stmt->bindParam(":$customer_id", $customer_id);
                        $stmt->bindParam(":$cart_id", $cart_id);
                        $stmt->bindParam(":$session_id", $session_id);
                        $stmt->bindParam(":$pro_id", $pro_id);
                        $stmt->bindParam(":$pro_name", $pro_name);
                        $stmt->bindParam(":$pro_price", $pro_price);
                        $stmt->bindParam(":$pro_quantity", $pro_quantity);
                        $stmt->bindParam(":$total_price", $total_price);
                        $stmt->bindParam(":$photo", $photo);
                        $orderedProduct = $stmt->execute();
                    }
                }
                return $orderedProduct;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    // Insert data to cart table
    public function addToCart($table5, $table3, $productId, $quantity, $sessionId)
    {
        try {
            // selected from products table
            $query = "SELECT * FROM $table3 WHERE pro_id = :pro_id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':pro_id', $productId);
            $stmt->execute([':pro_id' => $productId]);
            $cartItem = $stmt->fetch(PDO::FETCH_OBJ);
            $customerId = Session::get('customerId');
            $pro_name = $cartItem->pro_name;
            $quantity = $quantity;
            $pro_price = $cartItem->present_price;
            $photo = $cartItem->photo;

            // Insert into cart table
            $query = "INSERT INTO $table5 (customer_id, session_id, pro_id, pro_name, pro_price, pro_quantity, photo) VALUES('$customerId', '$sessionId', '$productId', '$pro_name', '$pro_price', '$quantity', '$photo')";

            $stmt = $this->conn->prepare($query);
            $stmt->bindValue(":$cartItem->id", $cartItem->id);
            $stmt->bindValue(":$sessionId", $sessionId);
            $stmt->bindValue(":$productId", $productId);
            $stmt->bindValue(":$pro_name", $pro_name);
            $stmt->bindValue(":$pro_price", $pro_price);
            $stmt->bindValue(":$quantity", $quantity);
            $stmt->bindValue(":$photo", $photo);
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
    // Check cart table if it is empty or not
    public function checkCartTable($table5, $sessionId)
    {
        $query = "SELECT * FROM $table5 WHERE session_id = :session_id";
        $stmt = $this->conn->prepare($query);
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
    // Payable amount for ordered products
    public function payableAmountForOrderedproducts($customerId, $tableOrders)
    {
        try {
            $sql = "SELECT * FROM $tableOrders WHERE customer_id = '$customerId' && ordered_on = NOW()";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                while ($ordrData = $stmt->fetch(PDO::FETCH_OBJ)) {
                    $orderRelatedData[] = $ordrData;
                }
                return $orderRelatedData;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    // Checks if customer id is emp0ty or not
    public function checksCustomerIdInOrdersTable($customerId, $tableOrders)
    {
        try {
            $sql = "SELECT * FROM $tableOrders WHERE customer_id = '$customerId'";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                while ($ordrData = $stmt->fetch(PDO::FETCH_OBJ)) {
                    $orderRelatedCustomerIdData[] = $ordrData;
                }
                return $orderRelatedCustomerIdData;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    // To display customer order details
    public function customerOrderDetails($tableOrders, $customerId)
    {
        try {
            $sql = "SELECT * FROM $tableOrders WHERE customer_id = '$customerId' ORDER BY ordered_on DESC";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                while ($customerOrder = $stmt->fetch(PDO::FETCH_OBJ)) {
                    $customerOrderDetails[] = $customerOrder;
                }
                return $customerOrderDetails;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    // To display customer order details in admin order inbox
    public function customerOrders($tableOrders)
    {
        try {
            $sql = "SELECT * FROM $tableOrders ORDER BY ordered_on DESC";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                while ($customerOrder = $stmt->fetch(PDO::FETCH_OBJ)) {
                    $customerOrderDetails[] = $customerOrder;
                }
                return $customerOrderDetails;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    // Update order status in orders table by admin from admin
    public function updateOrderStatus($tableOrders, $order_id, $pro_price, $ordered_on, $ordered_status)
    {
        $sql = "UPDATE $tableOrders SET status = '1' WHERE status = '$ordered_status' && order_id = '$order_id' && pro_price = '$pro_price' && ordered_on = '$ordered_on'";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':$order_id', $order_id);
        $stmt->bindValue(':$pro_price', $pro_price);
        $stmt->bindValue(':$ordered_on', $ordered_on);
        $stmt->bindValue(':$ordered_status', $ordered_status);
        $statusUpdated = $stmt->execute();
        if ($statusUpdated) {
            return $statusUpdated;
        } else {
            return false;
        }
    }

    // Revke order status in orders table by admin from admin
    public function revokeOrderStatus($tableOrders, $order_id, $pro_price, $ordered_on, $ordered_status)
    {
        $sql = "UPDATE $tableOrders SET status = '0' WHERE status = '$ordered_status' && order_id = '$order_id' && pro_price = '$pro_price' && ordered_on = '$ordered_on'";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':$order_id', $order_id);
        $stmt->bindValue(':$pro_price', $pro_price);
        $stmt->bindValue(':$ordered_on', $ordered_on);
        $stmt->bindValue(':$ordered_status', $ordered_status);
        $statusUpdated = $stmt->execute();
        if ($statusUpdated) {
            return $statusUpdated;
        } else {
            return false;
        }
    }

    // Confirm order status in orders table by admin from admin
    public function confirmOrderStatus($tableOrders, $order_id, $customer_id, $ordered_on, $ordered_status)
    {
        $sql = "UPDATE $tableOrders SET status = '2' WHERE status = '$ordered_status' && order_id = '$order_id' && customer_id = '$customer_id' && ordered_on = '$ordered_on'";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':$order_id', $order_id);
        $stmt->bindValue(':$customer_id', $customer_id);
        $stmt->bindValue(':$ordered_on', $ordered_on);
        $stmt->bindValue(':$ordered_status', $ordered_status);
        $confirmOrderStatus = $stmt->execute();
        if ($confirmOrderStatus) {
            return $confirmOrderStatus;
        } else {
            return false;
        }
    }
    // Delete order data
    public function deleteOrder($tableOrders, $order_id, $customer_id, $ordered_on, $ordered_status)
    {
        try {
            $sql = "DELETE FROM $tableOrders WHERE order_id = '$order_id' && customer_id = '$customer_id' && ordered_on = '$ordered_on' && status = '$ordered_status'";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(':$order_id', $order_id);
            $stmtExec = $stmt->execute();
            if ($stmtExec) {
                return $stmtExec ? true : false;
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

    // Desyroy data from cart table as per session id
    public function destroyDataFromCartTableOnLogOut($sessionId, $tableCart)
    {
        try {
            $sql = "DELETE FROM $tableCart WHERE session_id = :session_id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(':session_id', $sessionId);
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
