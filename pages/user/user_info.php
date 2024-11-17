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
 $edit_user_ID = Config::decrypt($_GET['uid']);
$picture = new PICTURE_MODEL();


$target_dir = "../../profile/images/";
$allCompany = array();
if(isset($_SESSION['userid'])){
	$getuserdetails = usermodel::ReadSingle($_SESSION['userid']);
	$getCompany = companymodel::ReadSingle($getuserdetails->CID);
	$getEmployement = EMPLOYEMENT_MODEL::ReadSingleByCompany($getCompany->CNAME);
	$edit_user_details = usermodel::ReadSingle($edit_user_ID);
	$profileuser_employement = EMPLOYEMENT_MODEL::ReadAllByUID($edit_user_ID);
	$profile_current_emp = EMPLOYEMENT_MODEL::CurrentEmployement($edit_user_ID);
	$profileuser_about = USR_DSC_MODEL::ReadSingle($edit_user_ID);
	$profileUser_booking = BOOKING_HISTORY::ReadAllByUID_past($edit_user_ID);
	$getUserCurrentBooking = BOOKING_HISTORY::ReadAllByUID_cur($edit_user_ID);
	
	if(!empty($storage)){
	$savant->storage_type_list = FADO_CAPACITY::ReadAllByCID_type($getuserdetails->CID);
	}
	
	 $role = ROLEMODEL::ReadSingleByUser($_SESSION['userid'])->ROLE;
	if($role == 'superadmin'){
	 $allCompany = companymodel::ReadAll();	
	 $allusers = usermodel::ReadAll();
    $savant->companies = $allCompany; 
    $savant->users = $allusers;    
	}
	if($role == 'admin'){
		$allusers = usermodel::ReadAllByCompany($getuserdetails->CID);
        $allCompany = companymodel::ReadAll();	
	 $allusers = usermodel::ReadAll();
    $savant->companies = $allCompany; 
    $savant->users = $allusers;    
	}else{
        $edit_user_ID = $_SESSION['userid'];
       $edit_user_details = usermodel::ReadSingle($edit_user_ID);
	$profileuser_employement = EMPLOYEMENT_MODEL::ReadAllByUID($edit_user_ID);
	$profile_current_emp = EMPLOYEMENT_MODEL::CurrentEmployement($edit_user_ID);
	$profileuser_about = USR_DSC_MODEL::ReadSingle($edit_user_ID);
	$profileUser_booking = BOOKING_HISTORY::ReadAllByUID_past($edit_user_ID);
	$getUserCurrentBooking = BOOKING_HISTORY::ReadAllByUID_cur($edit_user_ID); 
    }
	
	
	
}else{
	header('location:../login/index.php');
}

$savant->error_u = $error_u;
$savant->error_p = $error_p;
$savant->model = $model;
$savant->user = $getuserdetails;
$savant->role = $role;
$savant->company = $getCompany;


$savant->employement = $getEmployement;
$savant->profile_user = $edit_user_details;
$savant->profile_user_employement = $profileuser_employement;
$savant->profile_current_emp = $profile_current_emp;
$savant->profileuser_about = $profileuser_about;
$savant->profileUser_booking = $profileUser_booking;
$savant->CurrentBooking = $getUserCurrentBooking;
$savant->userAccess = USR_Access_Model::ReadAllByUID($edit_user_ID,0,20);

//$savant->fadoSpace= $storage;
//$savant->fadoIt = $it_resources;


$savant->header = $savant->fetch("header_dashboard.tpl");
$savant->footer = $savant->fetch("footer_profile.tpl");
$savant->logo = $savant->fetch("inner_logo.tpl");
$savant->nav = $savant->fetch("inner_top_nav.tpl");
$savant->sidebar = $savant->fetch("sidebar.tpl");
$savant->display("user_info.tpl");
?>
