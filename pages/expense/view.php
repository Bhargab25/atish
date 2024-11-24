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
$model = new subproductModel();


if(isset($_SESSION['userid'])){

	$sd = expmodel::ReadAll();
	// $view = $_GET['view'];
	$getuserdetails = usermodel::ReadSingle($_SESSION['userid']);

}else{
	header('location: ../login/index.php');
}

$savant->error_u = $error_u;
$savant->error_p = $error_p;
$savant->model = $model;
$savant->exp = $sd;
// $savant->view = $view;

$savant->header = $savant->fetch("sellHeader.tpl");
$savant->script = $savant->fetch("table_script.tpl");
$savant->footer = $savant->fetch("footer.tpl");
$savant->logout = $savant->fetch("logout.tpl");
// $savant->footer = $savant->fetch("footer_dashboard.tpl");
// $savant->logo = $savant->fetch("inner_logo.tpl");
$savant->topbar = $savant->fetch("topbar.tpl");
$savant->sidebar = $savant->fetch("sidebar.tpl");
$savant->display("view.tpl");
?>