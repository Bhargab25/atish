<?php
// Enable error reporting
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

class addStockModel extends BaseModel {

    public $id; 
    public $main_prod; 
    public $name;
    public $created_at; 
    public $current_stock; 
    public $status; 

    function __construct() {
        parent::__construct();
    }

    public static function addStock($pm, $ph, $sc, $p) {
        $mysqli = null;
        $transaction_started = false; // Flag to track transaction state
        $sucs = false; // Default success status

        try {
            $mysqli = Config::OpenDBConnection();
            $mysqli->begin_transaction();
            $transaction_started = true;

            // 1. Insert into Product entry main table
            $query1 = "INSERT INTO product_entry_main (id, chalan_no, `from`, recived_date, delivary_mode, total_amount, remarks, uid) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt1 = $mysqli->prepare($query1);
            if (!$stmt1) {
                throw new Exception("Failed to prepare query 1: " . $mysqli->error);
            }
            $stmt1->bind_param("sssssdss", $pm->id, $pm->chalan_no, $pm->from, $pm->recived_date, $pm->delivary_mode, $pm->total_amount, $pm->remarks, $pm->uid);
            if (!$stmt1->execute()) {
                throw new Exception("Error executing query 1: " . $stmt1->error);
            }
            $stmt1->close();

            // 2. Insert into product entry history table
            $query2 = "INSERT INTO product_entry_history (entry_id, product, qty, amount, remarks) VALUES (?, ?, ?, ?, ?)";
            $stmt2 = $mysqli->prepare($query2);
            if (!$stmt2) {
                throw new Exception("Failed to prepare query 2: " . $mysqli->error);
            }
            foreach ($ph->products as $product) {
                $stmt2->bind_param("ssiis", $ph->entry_id, $product['product'], $product['qty'], $product['price'], $ph->remarks);
                if (!$stmt2->execute()) {
                    throw new Exception("Error executing query 2: " . $stmt2->error);
                }
            }
            $stmt2->close();

            // Add new due amount in sc table 
            $id = scentityModel::addDue($sc);
            if (!$id) {
                throw new Exception("Error adding due amount");
            }
            

            // 3. Update stock in product_sub table
            $query3 = "UPDATE product_sub SET current_stock = CAST(current_stock AS UNSIGNED) + ? WHERE id = ?";
            $stmt3 = $mysqli->prepare($query3);
            if (!$stmt3) {
                throw new Exception("Failed to prepare query 3: " . $mysqli->error);
            }
            foreach ($p->products as $product) {
                $stmt3->bind_param("is", $product['qty'], $product['product']);
                if (!$stmt3->execute()) {
                    throw new Exception("Error executing query 3: " . $stmt3->error);
                }
            }
            $stmt3->close();

            // Commit transaction
            $mysqli->commit();
            $sucs = true; // Mark transaction as successful
        } catch (Exception $e) {
            // Rollback transaction on error
            if ($transaction_started) {
                $mysqli->rollback();
            }
            error_log("Transaction failed: " . $e->getMessage());
            $sucs = $e->getMessage();
        } finally {
            // Close connection
            if ($mysqli) {
                $mysqli->close();
            }
            return $sucs;
        }
    }
}

