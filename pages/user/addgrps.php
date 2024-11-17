 <?php 
include_once('../../include_commons.php'); 
require('../../_errors/libError.php');
$savant = new Savant3();
$savant->addPath("template", "../../includes/");	
$error_u="";
$error_p="";
$allCompany = array();
$grp = new GroupModel();
if(isset($_SESSION['userid'])){
	$getuserdetails = usermodel::ReadSingle($_SESSION['userid']);
	$getCompany = companymodel::ReadSingle($getuserdetails->CID);
	
	$role = ROLEMODEL::ReadSingleByUser($_SESSION['userid'])->ROLE;
	if($role == 'superadmin'){
	 $allCompany = companymodel::ReadAll();	
	 $allusers = usermodel::ReadAll(); 
	}
	if($role == 'admin'){
		$allusers = usermodel::ReadAllByCompany($getuserdetails->CID);
        $allgrp = GroupModel::ReadAll();
	}
	if (isset($_POST['ad']))
	{
       $grp->GNAME = $_POST['groupid'];
       $grp->KEYRACKS = '';
       $grp->ISACTIVE = '1';
       $gid = GroupModel::Create($grp); 
        
        
		if($gid != 0){
			$error_p = 'New Group Added Successfully!';
			$allgrp = GroupModel::ReadAll();
		
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
$savant->users = $allusers;
$savant->grps = $allgrp;
$savant->header = $savant->fetch("header_dashboard.tpl");
$savant->footer = $savant->fetch("footer_table.tpl");
$savant->logo = $savant->fetch("inner_logo.tpl");
$savant->nav = $savant->fetch("inner_top_nav.tpl");
$savant->sidebar = $savant->fetch("sidebar.tpl");
$savant->display("addgrps.tpl");
?>
