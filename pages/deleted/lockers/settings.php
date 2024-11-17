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
$allCompany = array();
$getlockers_space = array();
$getlockers_it = array();
if(isset($_SESSION['userid'])){
	$getuserdetails = usermodel::ReadSingle($_SESSION['userid']);
	$getCompany = companymodel::ReadSingle($getuserdetails->CID);
	
	$getEmployement = EMPLOYEMENT_MODEL::ReadSingleByCompany($getCompany->CNAME);
	$role = ROLEMODEL::ReadSingleByUser($_SESSION['userid'])->ROLE;
	if($role == 'superadmin'){
	 $allCompany = companymodel::ReadAll();	
	 $allusers = usermodel::ReadAll();
	}
	if($role == 'admin'){
		$allusers = usermodel::ReadAllByCompany($getuserdetails->CID);
		$getlockers_it = COMP_FADO_DETAILS::ReadAllComp($getuserdetails->CID);

	}
	if(isset($_POST[change_4])){
		$rate = $_POST['lock_4'];
		$mod = 'IT_RESOURCE';
		COMP_FADO_DETAILS::Set_Rate($getuserdetails->CID,4,$mod,$rate);
		
	}
	if(isset($_POST[change_5])){
		$rate = $_POST['lock_5'];
		$mod = 'IT_RESOURCE';
		COMP_FADO_DETAILS::Set_Rate($getuserdetails->CID,5,$mod,$rate);
		
	}
	
	
}else{
	header('location:../login/index.php');
}
$savant->itresource = $getlockers_it;
$savant->error_u = $error_u;
$savant->error_p = $error_p;
$savant->model = $model;
$savant->user = $getuserdetails;
$savant->company = $getCompany;
$savant->companies = $allCompany;
$savant->users = $allusers;
$savant->employement = $getEmployement;
$savant->header = $savant->fetch("header_dashboard.tpl");
$savant->footer = $savant->fetch("footer_table.tpl");
$savant->logo = $savant->fetch("inner_logo.tpl");
$savant->nav = $savant->fetch("inner_top_nav.tpl");
$savant->sidebar = $savant->fetch("sidebar.tpl");
$savant->display("settings.tpl");
?>
