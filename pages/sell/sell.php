<?php
// Enable error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
include_once('../../include_commons.php'); 

// Ensure Savant3 class is included and initialized correctly
$savant = new Savant3();
$savant->addPath("template", "../../includes/");



if (isset($_SESSION['userid'])) {

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST)) {
        $uid = $_SESSION['userid'];

        // $seq = secuenceModel::ReadSingle('s_entry');
        // $id = $seq->head . ((int)$seq->sno + 1);

        $data = $_POST;
        // get form data
        $sd_id = $_POST['sd_id'];
        $name = $_POST['name'];
        $mobile = $_POST['mobile'];
        $address = $_POST['address'];
        $invoice = $_POST['invoice_no'];
        $d_note = $_POST['d_note'];
        $date = $_POST['date'];
        $despatch = $_POST['despatch'];
        $destination = $_POST['destination'];
        $payMode = $_POST['pay_mode'];
        $products = $_POST['products'];
        $total = $_POST['total_amount'];
        $word = $_POST['amount_word'];

        $mysqli = Config::OpenDBConnection();
        $mysqli->begin_transaction();

        try{
            
            // insert in sale main 
            $query1 = 'INSERT INTO `invoice_gst_main` (`id`,`invoice_no`, `c_id`,`name`, `c_mobile`,`c_address`,`invoice_date`,`delivery_note`,`mode_pay`,`despatched_throug`,`destination`,`total_amount`,`word`,`uid`) 
            VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)';
            $stmt1 = Config::CreateStatement($mysqli, $query1);
            $stmt1->bind_param("sssssssssssdss", $invoice,$invoice,$sd_id,$name,$mobile,$address,$date,$d_note,$payMode,$despatch,$destination,$total,$word,$uid);
            $stmt1->execute();

            if($stmt1->error) {
                throw new Exception('Error in query 1: '. $stmt1->error);
            }

            foreach($products as $p){
                $query2 = "INSERT INTO `invoice_gst_history` (`entry_id`, `product`, `product_name`, `qty`, `unit`, `gross_amount`, `total_ammount`) VALUES (?,?,?,?,?,?,?)";
                $stmt2 = Config::CreateStatement($mysqli, $query2);
                $stmt2->bind_param("sssdsdd", $invoice,$p['product'],$p['id'],$p['qty'],$p['unit'],$p['price'],$p['t_price']);
                $stmt2->execute();

                if($stmt2->error) {
                    throw new Exception('Error in query 2: '. $stmt2->error);
                }

                // New Stock Amount
                $c_stock = $p['stock'] - $p['qty'];

                $query3 = "UPDATE `product_sub` SET `current_stock` = ? WHERE `id` = ?";
                $stmt3 = Config::CreateStatement($mysqli, $query3);
                $stmt3->bind_param('ds', $c_stock,$p['product']);
                $stmt3->execute();

                if($stmt3->error) {
                    throw new Exception('Error in query 3: '. $stmt3->error);
                }

            }

          
            $query4 = "UPDATE `sdentity` SET `due_ammount` = `due_ammount` + ? WHERE `id` = ?";
            $stmt4 = Config::CreateStatement($mysqli, $query4);
            $stmt4->bind_param('ds', $total,$sd_id);
            $stmt4->execute();

            if($stmt4->error) {
                throw new Exception('Error in query 4: '. $stmt4->error);
            }
            
            $sdamount = sdentityModel::ReadSingle($sd_id)->due_ammount;

            // $queryRetrieve = "SELECT `current_amomount` FROM `leadger_sd` WHERE `sdid` = ? ORDER BY `date` DESC LIMIT 1";
            // $stmtRetrieve = Config::CreateStatement($mysqli, $queryRetrieve);
            // $stmtRetrieve->bind_param('s', $sd_id);
            // $stmtRetrieve->execute();
            // $stmtRetrieve->bind_result($previous_current_amomount);
            // $stmtRetrieve->fetch();
            // $stmtRetrieve->close();

            // if (is_null($previous_current_amomount)) {
            //     $previous_current_amomount = 0;
            // }

            // $current_amomount = $previous_current_amomount + $total;
            $current_amomount = $sdamount + $total;
            $type = "Invoice";

            $query5 = "INSERT INTO `leadger_sd`(`sdid`,`date`,`type`,`current_amomount`,`truns_ammount`,`mode`,`remarks`,`refno`,`created_by`) values(?,?,?,?,?,?,?,?,?)";
            $stmt5 = Config::CreateStatement($mysqli, $query5);
            $stmt5->bind_param('sssddssss', $sd_id,$date,$type,$current_amomount,$total,$payMode,$invoice,$invoice,$uid);
            $stmt5->execute();

            if($stmt5->error) {
                throw new Exception('Error in query 5: '. $stmt5->error);
            }

            $query6 = "UPDATE `secuence` SET `sno` = `sno` + 1 WHERE `type` = 'invoice'";
            $stmt6 = Config::CreateStatement($mysqli, $query6);
            // $stmt6->bind_param('ds', $total,$sd_id);
            $stmt6->execute();

            if($stmt6->error) {
                throw new Exception('Error in query 6: '. $stmt6->error);
            }

            $mysqli->commit();
            $mysqli->close();

            $response = [
                'invoice_id' => $invoice,
                'data' => $data,
                'status' => 'success'
            ];

            echo json_encode($response);

        } catch (Exception $e){

            $mysqli->rollback();
            $mysqli->close();
    
            $errorResponse = ['error' => $e->getMessage(), 'status' => 'Failed'];
            echo json_encode($errorResponse);
        }
    }


} else {
    header('Location: ../login/index.php');
    exit();
}
