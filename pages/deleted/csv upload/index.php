<?php 
include_once('../../include_commons.php'); 
require('../../_errors/libError.php');
$savant = new Savant3();
$savant->addPath("template", "../../includes/");	
$error=false;
$success=false;
$model = new usermodel();
$company = new companymodel();
$rfidmodel = new RFIDModel();
$savant->DEVICEID = $DEVICEID;
$savant->MACID = $MAC;
//$edit_user_ID = Config::decrypt($_GET['uid']);

$picture = new PICTURE_MODEL();


$target_dir = "../../profile/";
 
if(isset($_SESSION['userid'])){
	
	$getuserdetails = usermodel::ReadSingle($_SESSION['userid']);
	$role = ROLEMODEL::ReadSingleByUser($_SESSION['userid'])->ROLE;
	
	$getCompany = companymodel::ReadSingle($getuserdetails->CID);
	$getEmployement = EMPLOYEMENT_MODEL::ReadSingleByCompany($getCompany->CNAME);
	
	if(Utils::IsPost()){
		
		
		
		$fileName = $_POST['macid'].".csv";
		$target_file = $target_dir .$fileName;
		$mimes = array('application/vnd.ms-excel','text/plain','text/csv','text/tsv','text/comma-separated-values',);
if(in_array($_FILES['picture']['type'],$mimes)){
  // do something
	if (move_uploaded_file($_FILES["picture"]["tmp_name"], $target_file)) {
		$success = "The file card.csv has been uploaded.";
		$savant->pkg = $_POST['macid'];
	}else{
		$error = "Sorry, there was an error uploading your file.";
	}
} else {
  $error = "Sorry, mime type not allowed";
}		
				
	}else{
		if(isset($_GET['msg'])){
		
	$success= '';	
	}
	}
	
	
}else{
	header('location:../login/index.php');
}

$savant->error = $error;
$savant->success = $success;
$savant->user = $getuserdetails;
$savant->company = $getCompany;
$savant->employement = $getEmployement;
$savant->device = 'SND '.$DEVICEID;
$savant->header = $savant->fetch("header_dashboard.tpl");
$savant->footer = $savant->fetch("footer_csv.tpl");
$savant->logo = $savant->fetch("inner_logo.tpl");
$savant->nav = $savant->fetch("inner_top_nav.tpl");
$savant->sidebar = $savant->fetch("sidebar.tpl");
$savant->display("index.tpl");
?>
