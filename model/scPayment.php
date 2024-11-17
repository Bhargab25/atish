<?php
// Enable error reporting
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

class scPaymentModel extends BaseModel {


    function __construct() {
        parent::__construct();
    }

    public static function scPayment($pm, $sm,$p ) {
        $mysqli = null;
        $transaction_started = false; 
        $sucs = false;

        try {
            $mysqli = Config::OpenDBConnection();
            $mysqli->begin_transaction();
            $transaction_started = true;

            // 1. Insert into Product entry main table
            $query1 = "INSERT INTO sc_payment_entry (`id`, `scid`, `created_at`, `amount`, `mode`, `hisamount`, `curamount`,`remarks`,`uid`) VALUES (?, ?, ?, ?, ?, ?, ?, ? ,?)";
            $stmt1 = $mysqli->prepare($query1);
            if (!$stmt1) {
                throw new Exception("Failed to prepare sc_payment_entry query: " . $mysqli->error);
            }
            $stmt1->bind_param("sssdsddss", $pm->id, $pm->scid, $pm->created_at, $pm->amount, $pm->mode, $pm->hisamount,$pm->curamount, $pm->remarks, $pm->uid);
            if (!$stmt1->execute()) {
                throw new Exception("Error executing sc_payment_entry query: " . $stmt1->error);
            }
            $stmt1->close();

            // 2. Insert into product entry history table
            $query2 = "INSERT INTO `leadger_sc`(`scid`,`date`,`type`, `current_amomount`, `truns_ammount`, `mode`,`remarks`,`refno`,`created_by`) values(?,?,?,?,?,?,?,?,?)";
            $stmt2 = $mysqli->prepare($query2);
            if (!$stmt2) {
                throw new Exception("Failed to prepare leadger_sc query: " . $mysqli->error);
            }
        
            $stmt2->bind_param("sssddssss", $sm->scid,$sm->date,$sm->type,$sm->current_amomount,$sm->truns_ammount,$sm->mode,$sm->remarks,$sm->refno,$sm->created_by);
            if (!$stmt2->execute()) {
                throw new Exception("Error executing leadger_sc query: " . $stmt2->error);
            }
            $stmt2->close();
            
            // 3. Update stock in product_sub table
            $query3 = "UPDATE scentity SET due_ammount = CAST(due_ammount AS UNSIGNED) - ? WHERE id = ?";
            $stmt3 = $mysqli->prepare($query3);
            if (!$stmt3) {
                throw new Exception("Failed to prepare due_ammount query: " . $mysqli->error);
            }

            $stmt3->bind_param("ds", $p->ammount,$p->id);
            if (!$stmt3->execute()) {
                throw new Exception("Error executing due_ammount query: " . $stmt3->error);
                
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
