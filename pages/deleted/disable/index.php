<?php 
include_once('../../include_commons.php'); 
require('../../_errors/libError.php');
$savant = new Savant3();
$savant->addPath("template", "../../includes/");	
$error_u=false;
$error_p=false;
$model = new usermodel();
$company = new companymodel();
$rfidmodel = new RFIDModel();

if(isset($_SESSION['userid'])){
	$getuserdetails = usermodel::ReadSingle($_SESSION['userid']);
	$getCompany = companymodel::ReadSingle($getuserdetails->CID);
	$getEmployement = EMPLOYEMENT_MODEL::ReadSingleByCompany($getCompany->CNAME);
	
	
}else{
	header('location:../login/index.php');
}

$savant->error_u = $error_u;
$savant->error_p = $error_p;
$savant->model = $model;
$savant->user = $getuserdetails;
$savant->company = $getCompany;
$savant->employement = $getEmployement;
$savant->header = $savant->fetch("header_dashboard.tpl");
$savant->footer = $savant->fetch("footer_dashboard.tpl");
$savant->logo = $savant->fetch("inner_logo.tpl");
$savant->nav = $savant->fetch("inner_top_nav.tpl");
$savant->sidebar = $savant->fetch("sidebar.tpl");
$savant->display("index.tpl");
?>
