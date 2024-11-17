<?php 
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
session_start();
include_once('../../include_commons.php'); 
// require('../../_errors/libError.php');
$savant = new Savant3();
$savant->addPath("template", "../../includes/");	
$error_u=false;
$error_p=false;


if(isset($_SESSION['userid'])){
  // Get Total SD Due 
if(isset($_POST['trans'])){
   $type = $_POST['type'];
   $from = $_POST['from'];
   $to = $_POST['to'];

   if($type == 'sell'){
    $transReport = invoiceModel::ReadAllByDate($from, $to);
   }else{
    $transReport = Stock::ReadAllByDate($from, $to);
    print_r($transReport);
   }

  if(isset($_POST['sd'])){
    $type = $_POST['type'];
    $from = $_POST['from'];
    $to = $_POST['to'];
  
    if($type == 'sell'){
    $transReport = invoiceModel::ReadAllByDate($from, $to);
    }else{
    $transReport = invoiceModel::ReadAllByDate($from, $to);
    }

  }
}
}else{
	header('location: ../login/index.php');
}

$savant->error_u = $error_u;
$savant->error_p = $error_p;



$savant->header = $savant->fetch("header.tpl");
$savant->script = $savant->fetch("script.tpl");
// $savant->footer = $savant->fetch("footer_dashboard.tpl");
// $savant->logo = $savant->fetch("inner_logo.tpl");
$savant->topbar = $savant->fetch("topbar.tpl");
$savant->sidebar = $savant->fetch("sidebar.tpl");
$savant->display("index.tpl");
?>
