<?php 
include_once('../../include_commons.php'); 
require('../../_errors/libError.php');
$savant = new Savant3();
$savant->addPath("template", "../../includes/");	
$error_u=false;
$error_p=false;
$model = new usermodel();
$company = new companymodel();
$KeySlotModel = new RackModel();
$setup = new SETUPMODEL();

if(isset($_SESSION['userid'])){
	$getuserdetails = usermodel::ReadSingle($_SESSION['userid']);
	$getCompany = companymodel::ReadSingle($getuserdetails->CID);
	
	$getEmployement = EMPLOYEMENT_MODEL::ReadSingleByCompany($getCompany->CNAME);
	$role = ROLEMODEL::ReadSingleByUser($_SESSION['userid'])->ROLE;
	if($role == 'superadmin'){
	 $allCompany = companymodel::ReadAll();	
		//print_r($allCompany);
	}
	if($role == 'admin'){
		$savant->getSettings = SETUPMODEL::ReadSingle($getuserdetails->CID);
	}

	if(isset($_POST['submit'])){
        $setup->MULTI_ASSET = $_POST['locAss'];
        if($_POST['BookAss']=='1'){
            $setup->MULTI_BOOKING = $_POST['BookAss'];
        }else{
            $setup->MULTI_BOOKING = $_POST['AssetBook'];
        }
        print_r($setup);
        
    }
	
}else{
	header('location:../login/index.php');
}

$savant->error_u = $error_u;
$savant->error_p = $error_p;
$savant->model = $model;
$savant->user = $getuserdetails;
$savant->company = $getCompany;

$savant->header = $savant->fetch("header_dashboard.tpl");
$savant->footer = $savant->fetch("footer_table.tpl");
$savant->logo = $savant->fetch("inner_logo.tpl");
$savant->nav = $savant->fetch("inner_top_nav.tpl");
$savant->sidebar = $savant->fetch("sidebar.tpl");
$savant->display("keysetup.tpl");
?>
