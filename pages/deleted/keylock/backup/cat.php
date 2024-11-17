 <?php 
include_once('../../include_commons.php'); 
require('../../_errors/libError.php');
$savant = new Savant3();
$savant->addPath("template", "../../includes/");	
$error_u="";
$error_p="";
$allCompany = array();
if(isset($_SESSION['userid'])){
	$getuserdetails = usermodel::ReadSingle($_SESSION['userid']);
	$getCompany = companymodel::ReadSingle($getuserdetails->CID);
	
	$getEmployement = EMPLOYEMENT_MODEL::ReadSingleByCompany($getCompany->CNAME);
	$role = ROLEMODEL::ReadSingleByUser($_SESSION['userid'])->ROLE;
	if($role == 'superadmin'){
	 $allCompany = companymodel::ReadAll();	
	 $allusers = usermodel::ReadAll();
		$savant->category = ASCAT_MODEL::ReadAll();
	}
	if($role == 'admin'){
		$allusers = usermodel::ReadAllByCompany($getuserdetails->CID);
		$savant->category = ASCAT_MODEL::ReadAll();
	}
	if (isset($_POST['ad']))
	{
	$catmodel = new ASCAT_MODEL();// asset category model call
	
	$catmodel->NAME = $_POST['cname'];
	$catmodel->CREATEDATE = date('Y-m-d H:i:s');
	$catmodel->ISACTIVE = 'Y';	
	$catid = ASCAT_MODEL::Create($catmodel);
		if($catid != 0){
			$error_p = 'New asset category Added Successfully!';
			$current_device = ASCAT_MODEL::ReadSingle($catid)->NAME;
			$savant->curD = $current_device;
		}else{
			$error_u = 'There is some error please try later';
		}
	
	}
	
	
}else{
	header('location:../login/index.php');
}

$savant->error_u = $error_u;
$savant->error_p = $error_p;
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
$savant->display("cat.tpl");
?>
