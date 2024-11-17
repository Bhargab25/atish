<?php 
include_once('../../include_commons.php'); 
require('../../_errors/libError.php');
$savant = new Savant3();
$savant->addPath("template", "../../includes/");	
$error=false;
$model = new companymodel();
$user = new usermodel();
if (Utils::IsGet()) {

} else {
	if (isset($_POST['c']))
	{
		
	$model->CUID = companymodel::generate_company_uniqueId($length = 6,$_POST["cname"],$_POST["phone"]);
		$model->CNAME = $_POST["cname"];
		$model->DOMAIN = $_POST['domain'];
		$model->CONTACTEMAIL = $_POST['email'];
		$model->CONTACTPHONE = $_POST['phone'];
		$model->ADDRESS = $_POST['address'];
		
		$model->LAT = '0';
		$model->LONG = '0';
		$model->CSTRENGTH = $_POST['strength'];
		$model->LOCKERS = $_POST['lockers'];
		$model->SUBSCRIPTION = '1';
		//print_r($model);
		
		$id = companymodel::Create($model);
		if($id != 0){
			$user->CID = $id;
			$user->ENAME = '';
			$user->EMAIL = $_POST['email'];
			$user->PHONE =  $_POST['phone'];
			$user->EMPLOYEE_CODE = 'emp0001';
			$user->PASSWORD = $_POST['phone'];
			$user->PICTUREID = '';
			$user->FINGERPRINT_ID = '';
			//print_r($user);
			$uid = usermodel::Create($user);			
		}
		if($uid != 0){
			$success = "success";
		}
	}
}

$savant->error = $error;
$savant->model = $model;
$savant->header = $savant->fetch("header.tpl");
$savant->footer = $savant->fetch("footer.tpl");
$savant->display("register.tpl");
?>
