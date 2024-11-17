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
$model = new expmodel();


if(isset($_SESSION['userid'])){
	// Get Products List
	if(isset($_POST['addExp'])){ 
		$model->name = $_POST['name'];
		$model->amount = $_POST['amount'];
		$model->date = $_POST['date'];
		$model->remarks = $_POST['remarks'];

		$id = expmodel::Create($model);
		if($id != 0){
			//$error_u = "You have successfully added user";
			header('location:index.php');
		}
		
	}
}else{
	header('location: ../login/index.php');
}

$savant->error_u = $error_u;
$savant->error_p = $error_p;
// $savant->model = $model;
// $savant->products = $sd;

$savant->header = $savant->fetch("table_header.tpl");
$savant->script = $savant->fetch("table_script.tpl");
$savant->footer = $savant->fetch("footer.tpl");
$savant->logout = $savant->fetch("logout.tpl");
// $savant->footer = $savant->fetch("footer_dashboard.tpl");
// $savant->logo = $savant->fetch("inner_logo.tpl");
$savant->topbar = $savant->fetch("topbar.tpl");
$savant->sidebar = $savant->fetch("sidebar.tpl");
$savant->display("index.tpl");
?>
