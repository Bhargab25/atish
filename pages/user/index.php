<?php 
session_start();
include_once('../../include_commons.php'); 
// require('../../_errors/libError.php');
$savant = new Savant3();
$savant->addPath("template", "../../includes/");	

$model = new usermodel();

$error_u=false;
$error_p=false;

 
if(isset($_SESSION['userid'])){
	$getuserdetails = usermodel::ReadSingle($_SESSION['userid']);
	// $edit_user_details = usermodel::ReadSingle($edit_user_ID);
	// $users = usermodel::ReadAll();
	
	if(isset($_POST['addp'])){

		if(usermodel::ReadSingleById($_POST['userid'])){
			$error_u = true;
		}else{
			// $model->uid = $_POST['userid'];	
			$model->name = $_POST['name'];
			$model->userid = $_POST['userid'];
			$model->role = $_POST['role'];
			$model->mobile = $_POST['mobile'];
			$model->email = $_POST['email'];
			$model->password = $_POST['password'];
			$model->status = 1;

			$uid = usermodel::Create($model);
			if($uid){
				// $users = usermodel::ReadAll();
				$error_p = true;
				header('location: index.php');
			}
	
		}	
		
	}
	
	
}else{
	header('location:../login/index.php');
}

$savant->error_u = $error_u;
$savant->error_p = $error_p;
$savant->users = usermodel::ReadAll();
// $savant->user = $getuserdetails;
// $savant->company = $getCompany;
// $savant->employement = $getEmployement;


$savant->header = $savant->fetch("table_header.tpl");
$savant->script = $savant->fetch("table_script.tpl");
$savant->footer = $savant->fetch("footer.tpl");
$savant->logout = $savant->fetch("logout.tpl");
$savant->topbar = $savant->fetch("topbar.tpl");
$savant->sidebar = $savant->fetch("sidebar.tpl");
$savant->display("index.tpl");
?>
