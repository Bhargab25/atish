<?php
// Enable error reporting
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

session_start();
include_once('../../include_commons.php'); 

// Ensure Savant3 class is included and initialized correctly
$savant = new Savant3();
$savant->addPath("template", "../../includes/");

$error_u = false;
$error_p = false;

if (isset($_SESSION['userid'])) {
    $uid = $_SESSION['userid'];

    // Creating Product entry main id
    $seq = secuenceModel::ReadSingle('s_entry');
    $id = $seq->head . ((int)$seq->sno + 1);
    $dev_mode = "By default";
    $remarks = "By default";

    // Initialize objects
    $pm = new stdClass();
    $ph = new stdClass();
    $sc = new stdClass();
    $p = new stdClass();
    $lg = new scledgerModel();

    // Sanitize and validate input
    $pm->id = $id;
    $pm->chalan_no = filter_var($_POST['number']);
    $pm->from = filter_var($_POST['sc_id']);
    $pm->recived_date = filter_var($_POST['r_date']);
    $pm->delivary_mode = $dev_mode;
    $pm->total_amount = filter_var($_POST['t_amount'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $pm->remarks = $remarks;
    $pm->uid = $uid;

    $ph->entry_id = $id;
    $ph->products = $_POST['products']; // Ensure this is validated and sanitized as well
    $ph->remarks = $remarks;
    
    $sc->id = filter_var($_POST['sc_id']);
    $sc->due_amount = filter_var($_POST['t_amount'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);

    $p->products = $_POST['products']; // Ensure this is validated and sanitized as well

    // Correct object property assignment
    $updatedAmount = scentityModel::ReadSingle($pm->from); 
    
    $lg->scid = filter_var($_POST['sc_id']);
    $lg->date = filter_var($_POST['r_date']);
    $lg->type = "due";
    $lg->current_amomount = $updatedAmount->due_ammount;
    $lg->truns_ammount = filter_var($_POST['t_amount'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $lg->mode = "None";
    $lg->remarks = filter_var($_POST['number']);
    $lg->refno = $id;
    $lg->created_by = $uid;

    // Call the addStock method and capture result
    $result = addStockModel::addStock($pm, $ph, $sc, $p);
    

     // Create Ledger entry
    //  echo json_encode($result);
     if($result === true){
        if($updatedAmount->due_ammount){
            $lgid = scledgerModel::Create($lg);
            if (!$lgid) {
               $result = $lgid;
            }
        }else{
           $result = false;
        }
     }


    if ($result === true) {
        secuenceModel::UpdateSno($seq->type, ((int)$seq->sno + 1));
        $response = array(
            "message" => "Stock Added Successfully",
            "status" => 1
        );
    } else {
        $response = array(
            "error" => $result,
            "message" => "Failed to Add Stock",
            "status" => 0
        );
    }
    echo json_encode($response);
} else {
    header('Location: ../login/index.php');
    exit();
}
