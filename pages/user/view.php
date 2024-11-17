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
echo $_SESSION['userid'];
if(isset($_SESSION['userid'])){
	$getuserdetails = usermodel::ReadSingle($_SESSION['userid']);
    print_r($getuserdetails);
	$getCompany = companymodel::ReadSingle($getuserdetails->CID);
	
	$getEmployement = EMPLOYEMENT_MODEL::ReadSingleByCompany($getCompany->CNAME);
	$role = ROLEMODEL::ReadSingleByUser($_SESSION['userid'])->ROLE;
	if($role == 'superadmin'){
	 $allCompany = companymodel::ReadAll();	
	 $allusers = usermodel::ReadAll();
	}
	if($role == 'admin'){
		$allusers = usermodel::ReadAllByCompany(1);
	}
	if (isset($_POST['au']))
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
	
	
}else{
	header('location:../login/index.php');
    exit();
}

$savant->error_u = $error_u;
$savant->error_p = $error_p;
$savant->model = $model;
$savant->user = $getuserdetails;
$savant->company = $getCompany;
$savant->companies = $allCompany;
$savant->users = $allusers;
$savant->employement = $getEmployement;
$savant->header = $savant->fetch("header_dashboard.tpl");
$savant->footer = $savant->fetch("footer_dashboard.tpl");
$savant->logo = $savant->fetch("inner_logo.tpl");
$savant->nav = $savant->fetch("inner_top_nav.tpl");
$savant->sidebar = $savant->fetch("sidebar.tpl");
$savant->display("view.tpl");
?>
