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

    // Creating payment entry main id
    $seq = secuenceModel::ReadSingle('sd_payment');
    $id = $seq->head . ((int)$seq->sno + 1);

    // Initialize objects
    $pm = new stdClass();
    $p = new stdClass();
    $lg = new scledgerModel();

    // create for new sc payment
    $pm->id = $id;
    $pm->scid = filter_var($_POST['sc_id']);
    $pm->created_at = filter_var($_POST['r_date']);
    $pm->amount = filter_var($_POST['p_amount'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $pm->mode = filter_var($_POST['pay_mode']);
    $pm->hisamount = filter_var($_POST['due_ammount'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $pm->curamount = $_POST['due_ammount'] - $_POST['p_amount'];
    $pm->remarks = filter_var($_POST['remarks']);
    $pm->uid = $uid;

    // create for ledger entry
    $updatedAmount = sdentityModel::ReadSingle($pm->scid); 
    
    $lg->scid = filter_var($_POST['sc_id']);
    $lg->date = filter_var($_POST['r_date']);
    $lg->type = "Pay";
    $lg->current_amomount = $pm->curamount;
    $lg->truns_ammount = filter_var($_POST['p_amount'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $lg->mode = filter_var($_POST['pay_mode']);
    $lg->remarks = filter_var($_POST['remarks']);
    $lg->refno = $id;
    $lg->created_by = $uid;

    // create for update ammount in sc
    $p->id = filter_var($_POST['sc_id']);
    $p->ammount = filter_var($_POST['p_amount'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);

    // Call the method and capture result
    $result = sdPaymentModel::sdPayment($pm,$lg,$p);
    

    if ($result === true) {
        secuenceModel::UpdateSno($seq->type, ((int)$seq->sno + 1));
        $response = array(
            "details" => $pm,
            "message" => "Payment Added Successfully",
            "status" => 1
        );
    } else {
        $response = array(
            "error" => $result,
            "message" => "Failed to Add Payment",
            "status" => 0
        );
    }
    echo json_encode($response);
} else {
    header('Location: ../login/index.php');
    exit();
}