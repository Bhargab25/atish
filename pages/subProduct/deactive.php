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
$model = new productModel();
$id = $_GET['id'];


if(isset($_SESSION['userid'])){
	$getuserdetails = usermodel::ReadSingle($_SESSION['userid']);

	if($id){
		subproductModel::Deactivate($id);
        header('location: index.php');
	}
	

}else{
	header('location: ../login/index.php');
}

// $savant->error_u = $error_u;
// $savant->error_p = $error_p;
// $savant->model = $model;
// $savant->products = $products;

?>
