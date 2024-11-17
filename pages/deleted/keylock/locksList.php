 <?php 
include_once('../../include_commons.php'); 
require('../../_errors/libError.php');
$savant = new Savant3();
$savant->addPath("template", "../../includes/");	
$error_u="";
$error_p="";
$allCompany = array();
$savant->deviceid =  $DEVICEID;
$asset = new ASSET_MODEL();


if(isset($_SESSION['userid'])){
	$getuserdetails = usermodel::ReadSingle($_SESSION['userid']);
	$getCompany = companymodel::ReadSingle($getuserdetails->CID);
	
	$getEmployement = EMPLOYEMENT_MODEL::ReadSingleByCompany($getCompany->CNAME);
	$role = ROLEMODEL::ReadSingleByUser($_SESSION['userid'])->ROLE;
	if($role == 'superadmin'){
	 $allCompany = companymodel::ReadAll();	
	 $allusers = usermodel::ReadAll();
    $savant->category = ASCAT_MODEL::ReadAll();
    #get lockers list
       // echo $getuserdetails->CID;
    $savant->lockers = FADO_CAPACITY::ReadAllByCOMPID($getuserdetails->CID);  
    #get asset all
    $savant->asset = ASSET_MODEL::ReadAll();    
    #get Free Assets list
    $savant->FreeAssets = ASSET_MODEL::FreeAssets();    
	}
	if($role == 'admin'){
		$allusers = usermodel::ReadAllByCompany($getuserdetails->CID);
        #get all asset category
        #get asset all
    $savant->asset = ASSET_MODEL::ReadAll();    
    #get Free Assets list
    $savant->FreeAssets = ASSET_MODEL::FreeAssets();  
        $savant->category = ASCAT_MODEL::ReadAll();
         #get lockers list
        // echo $getuserdetails->CID;
      //  print_r(FADO_CAPACITY::ReadAllByCOMPID($getuserdetails->CID));
    $savant->lockers = FADO_CAPACITY::ReadAllByCOMPID($getuserdetails->CID);
	}
	if (isset($_POST['ad']))
	{
    $asset->NAME = $_POST['name'];    
    if(isset($_POST['locker'])){
     $asset->FDO_UNIQUEID = $_POST['locker'];   
    }    
	
	$asset->CAT_ID = $_POST['type'];
	$asset->MACID = $_POST['snd'];//$string = 'SND '.str_replace(':', '', $_POST['macAddess']);	
	$asset->RFID = $_POST['rfid'];
	$asset->CREATEDATE = date('Y-m-d H:i:s');
	$asset->MODIFIEDDATE = date('Y-m-d H:i:s');
    $asset->ISACTIVE = 'Y';    
		$aid = ASSET_MODEL::Create($asset);
		if($aid != 0){
			$error_p = 'New asset Added Successfully!';
			$current_device = ASSET_MODEL::ReadSingle($aid)->MACID;
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
$savant->TotalLockers = count(FADO_CAPACITY::ReadAllByCOMPID($getuserdetails->CID));
$savant->header = $savant->fetch("header_dashboard.tpl");
$savant->footer = $savant->fetch("footer_locker.tpl");
$savant->logo = $savant->fetch("inner_logo.tpl");
$savant->nav = $savant->fetch("inner_top_nav.tpl");
$savant->sidebar = $savant->fetch("sidebar.tpl");
$savant->display("locksList.tpl");
?>
