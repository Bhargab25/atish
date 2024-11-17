<?php
// Enable error reporting for debugging during development
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
include_once('../../include_commons.php'); 

// Initialize Savant3 template system
$savant = new Savant3();
$savant->addPath("template", "../../includes/");

if (isset($_SESSION['userid'])) {
    if ($_SERVER['REQUEST_METHOD'] === 'GET' && !empty($_GET['id'])) {
        $uid = $_SESSION['userid'];
        $id = $_GET['id'];  // Invoice ID

        // Fetch invoice details
        $invoice_deatils = invoiceModel::ReadSingle($id);

        // Open database connection
        $mysqli = Config::OpenDBConnection();
        // Retrieve the previous current_amount from leadger_sd table
        $query = "SELECT * FROM invoice_gst_history WHERE entry_id = ?";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->bind_param('s', $id);
        $stmt->execute();
        $stmt->bind_result($id,$entry_id,$created_at,$product,$name,$qty,$unit,$gross_amount,$total_ammount);
        $products = [];
            while ($stmt->fetch()) {
                $products[] = [$id,$entry_id,$created_at,$product,$name,$qty,$unit,$gross_amount,$total_ammount];
            }
        $stmt->fetch();
        $stmt->close(); 

        try {
            // Retrieve products and quantities from invoice history
            // $query1 = "SELECT product, qty FROM invoice_gst_history WHERE entry_id = ?";
            // $stmt1 = Config::CreateStatement($mysqli, $query1);
            // $stmt1->bind_param("s", $id);
            // $stmt1->execute();
            // $stmt1->bind_result($product, $qty);

            // $products = [];
            // while ($stmt1->fetch()) {
            //     $products[] = ['product' => $product, 'qty' => $qty];
            // }

            // // Error check for query 1
            // if ($stmt1->error) {
            //     throw new Exception('Error in query 1: ' . $stmt1->error);
            // }

            // Update stock for each product
            // foreach ($products as $p) {
            //     $query2 = "UPDATE product_sub SET current_stock = current_stock + ? WHERE id = ?";
            //     $stmt2 = Config::CreateStatement($mysqli, $query2);
            //     $stmt2->bind_param("ds", $p['qty'], $p['product']);
            //     $stmt2->execute();

            //     // Error check for query 2
            //     if ($stmt2->error) {
            //         throw new Exception('Error in query 2: ' . $stmt2->error);
            //     }
                
            // }

            // Update due amount in sdentity table
            // $query4 = "UPDATE sdentity SET `due_ammount` = `due_ammount` - ? WHERE id = ?";
            // $stmt4 = Config::CreateStatement($mysqli, $query4);
            // $stmt4->bind_param('ds', $invoice_deatils->total_amount, $invoice_deatils->c_id);
            // $stmt4->execute();

            // if ($stmt4->error) {
            //     throw new Exception('Error in query 4: ' . $stmt4->error);
            // }
            

            // Retrieve the previous current_amount from leadger_sd table
            // $queryRetrieve = "SELECT current_amomount FROM leadger_sd WHERE sdid = ? ORDER BY created_at DESC LIMIT 1";
            // $stmtRetrieve = Config::CreateStatement($mysqli, $queryRetrieve);
            // $stmtRetrieve->bind_param('s', $invoice_deatils->c_id);
            // $stmtRetrieve->execute();
            // $stmtRetrieve->bind_result($previous_current_amount);
            // $stmtRetrieve->fetch();
            // $stmtRetrieve->close();

            // if (is_null($previous_current_amount)) {
            //     $previous_current_amount = 0;
            // }

            // Calculate the new current amount
            // $current_amount = $previous_current_amount - $invoice_deatils->total_amount;
            // $type = "Invoice Delete";
            // $mode = "Delete";
            // $date = date('Y-m-d'); 

            // // // Insert the record into leadger_sd table
            // $query5 = "INSERT INTO leadger_sd (`sdid`, `date`, `type`, `current_amomount`, `truns_ammount`, `mode`, `remarks`, `refno`, `created_by`)
            //             VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
            // $stmt5 = Config::CreateStatement($mysqli, $query5);
            // $stmt5->bind_param('sssddssss', $invoice_deatils->c_id, $date, $type, $current_amount, $invoice_deatils->total_amount, $mode, $type, $id, $uid);
            // $stmt5->execute();

            // if ($stmt5->error) {
            //     throw new Exception('Error in query 5: ' . $stmt5->error);
            // }

            // Delete the invoice
            // $query6 = "DELETE FROM invoice_gst_main WHERE id=?";
            // $stmt6 = Config::CreateStatement($mysqli, $query6);
            // $stmt6->bind_param('s', $id);
            // $stmt6->execute();

            // if ($stmt6->error) {
            //     throw new Exception('Error in query 6: ' . $stmt6->error);
            // }

            // Commit the transaction
            $mysqli->commit();
            $mysqli->close();

            // Success response
            $response = [
                'main' => $invoice_deatils,
                'history' => $products,
                'status' => 'success'
            ];
            echo json_encode($response);

        } catch (Exception $e) {
            // Rollback the transaction on error
            $mysqli->rollback();
            $mysqli->close();
            $errorResponse = ['error' => $e->getMessage(), 'status' => 'Failed'];
            echo json_encode($errorResponse);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Invalid request']);
    }
} else {
    header('Location: ../login/index.php');
    exit();
}