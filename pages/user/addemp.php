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
	if(isset($_POST['au'])){
		$model->CID = $getuserdetails->CID; 
		$model->NAME = $_POST['fname'].' '.$_POST['lname'];
		$model->EMAIL = $_POST['Email1'];
		$model->PHONE = $_POST['phone'];
		$model->EMPLOYEE_CODE = $_POST['empcode'];
		$model->PASSWORD = $_POST['password'];
        $model->CREATEDDATE = date('Y-m-d H:i:s');
        $model->MODIFIEDDATE = date('Y-m-d H:i:s');

		 $uid = usermodel::Create($model);
		if($uid != 0){
		  $rfidmodel->USERID = $uid;	
		  $rfidmodel->RFID = $_POST['rfid'];
		  $rfidmodel->ISACTIVE = '0';
			$rf = RFIDModel::Create($rfidmodel);
			if($rf != 0){
				//$error_u = "You have successfully added user";
				header('location:view.php');
			}
			
		}
		
	}
	if(isset($_POST['upload'])){
        
    }
	
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
$savant->display("addemp.tpl");
?>
