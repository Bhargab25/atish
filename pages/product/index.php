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


if(isset($_SESSION['userid'])){
	// Get Products List
	$products = productModel::ReadAll();

	$getuserdetails = usermodel::ReadSingle($_SESSION['userid']);
    $seq = secuenceModel::ReadSingle('product');
	if(isset($_POST['addp'])){

		if(!$_POST['id']){
        $model->id = $seq->head . ((int)$seq->sno + 1);
		$model->name = $_POST['name'];
		$model->created_at = date('Y-m-d h:i:s');
		$model->unit = $_POST['unit'];
		$model->current_stock = 0;
		$model->status = 1;

		$id = productModel::Create($model);
		// Update Secuence table s number
	    secuenceModel::UpdateSno($seq->type,((int)$seq->sno + 1));
		header('location: index.php');
	}else{
		$model->id = $_POST['id'];
		$model->name = $_POST['name'];
		$model->unit = $_POST['unit'];

		$id = productModel::Update($model);
		header('location: index.php');
	}
}
	

}else{
	header('location: ../login/index.php');
}

$savant->error_u = $error_u;
$savant->error_p = $error_p;
$savant->model = $model;
$savant->products = $products;

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
