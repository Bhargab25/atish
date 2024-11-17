 <?php 
include_once('../../include_commons.php'); 
require('../../_errors/libError.php');
$savant = new Savant3();
$savant->addPath("template", "../../includes/");	
$error_u=false;
$error_p=false;
$model = new EVENT_MODEL();

if(isset($_SESSION['userid'])){
	$getuserdetails = usermodel::ReadSingle($_SESSION['userid']);	
	if($getuserdetails->UTYPE == 'ADMIN'){
		$savant->allBooth = Booth_Model::ReadAll();
        $savant->AllInvities = INVITE_MODEL::ReadAll();
        $savant->GetAllEvent = EVENT_MODEL::ReadAll();
       
    if(isset($_GET['event'])){
        if($_GET['event'] != '--Select--'){
            $event_id = explode('-',base64_decode($_GET['event']));
            $euid = $event_id['0'];
            $savant->AllInvities = INVITE_MODEL::ReadAllByEvent($euid);
            
        }else if($_GET['event'] != '--Select--'){
           $savant->AllInvities = INVITE_MODEL::ReadAll(); 
        }
    }else{
         $savant->AllInvities = INVITE_MODEL::ReadAll();
    }                
}
	
	
	
}else{
	header('location:../login/index.php');
}

$savant->error_u = $error_u;
$savant->error_p = $error_p;
$savant->model = $model;
$savant->user = $getuserdetails;

$savant->header = $savant->fetch("header_services.tpl");
$savant->footer = $savant->fetch("footer_event.tpl");
$savant->logo = $savant->fetch("inner_logo.tpl");
$savant->nav = $savant->fetch("inner_top_nav.tpl");
$savant->sidebar = $savant->fetch("sidebar.tpl");
$savant->display("invite.tpl");
?>
