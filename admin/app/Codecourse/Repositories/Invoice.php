<?php
namespace Codecourse\Repositories;

class Invoice extends Cart
{
    // Prevent duplicate entry
    public function createInvoice($table, $customerId, $sessionId)
    {
        $query = "SELECT * FROM $table WHERE customer_id = '$customerId' && session_id = :session_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':customer_id', $customerId);
        $stmt->bindParam(':session_id', $sessionId);
        $stmt->execute();
        $stmtExecute = $stmt->fetch(PDO::FETCH_OBJ);
        if ($stmtExecute) {
            return $stmtExecute;
        } else {
            return false;
        }
    }
}
