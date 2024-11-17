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
$model = new sdentityModel();


if(isset($_SESSION['userid'])){
	// Get Products List
	$sd = sdentityModel::ReadAll();

	$getuserdetails = usermodel::ReadSingle($_SESSION['userid']);
    $seq = secuenceModel::ReadSingle('sd');
	if(isset($_POST['addp'])){

		if(!$_POST['id']){
        $model->id = $seq->head . ((int)$seq->sno + 1);
		$model->merchant_name = $_POST['name'];
		$model->mobile = $_POST['mobile'];
        $model->email = $_POST['email'];
        $model->address = $_POST['address'];
		$model->created_at = date('Y-m-d h:i:s');
		$model->status = 1;
		$model->due_ammount = 0;
        $model->gst = $_POST['gst'];
        $model->uid = $_SESSION['userid'];

		$id = sdentityModel::Create($model);
		// Update Secuence table s number
	    secuenceModel::UpdateSno($seq->type,((int)$seq->sno + 1));
		header('location: index.php');
	}else{
		$model->id = $_POST['id'];
		$model->merchant_name = $_POST['name'];
		$model->mobile = $_POST['mobile'];
        $model->email = $_POST['email'];
        $model->address = $_POST['address'];
        $model->gst = $_POST['gst'];

		$id = sdentityModel::Update($model);
		header('location: index.php');
	}
}
	

}else{
	header('location: ../login/index.php');
}

$savant->error_u = $error_u;
$savant->error_p = $error_p;
$savant->model = $model;
$savant->products = $sd;

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
