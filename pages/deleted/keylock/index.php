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
	
	$role = ROLEMODEL::ReadSingleByUser($_SESSION['userid'])->ROLE;
	if($role == 'superadmin'){
	 $allCompany = companymodel::ReadAll();	
	 $allusers = usermodel::ReadAll(); 
        $rack = RackModel::ReadAll();
	}
	if($role == 'admin'){
		$allusers = usermodel::ReadAllByCompany($getuserdetails->CID);
       
        $rack = RackModel::ReadAll();
        echo count($rack);
  // print_r($rack);
	}
	if (isset($_POST['ad']))
	{
        if(count($rack)<=14){
           // echo $_POST['keynum'];
            $checkRack = RackModel::ReadSingleBySK('1',$_POST['keynum']);
            if(empty($checkRack)){
               $rack = new RackModel();
             $rack->SLOT_ID = '1';
             $rack->KEYNUM = $_POST['keynum'];
             $rack->TAGID = $_POST['tagid_1'];
             $rack->STATUS = 'CLOSE';
             $rack->LAST_ACCESS = '';
             $rack->ISACTIVE = '1';
             $rid = RackModel::Create($rack);  
            if($rid != 0){
			$error_p = 'New keyrack Added Successfully!';
			$rack = RackModel::ReadAll();
		
		}else{
			$error_u = 'There is some error please try later';
		}    
            }else{
                 $error_u = 'Already assigned this key by TagId : '.$checkRack->TAGID; 
            }
            
        }else{
           $error_u = 'you have already filled up all the keyracks'; 
        }
       
   
		
	
	}
	
	
}else{
	header('location:../login/index.php');
    $rack = RackModel::ReadAll();
    $savant->racks = $rack;
}

$savant->error_u = $error_u;
$savant->error_p = $error_p;
$savant->user = $getuserdetails;
$savant->users = $allusers;
$savant->racks = $rack;
$savant->header = $savant->fetch("header_dashboard.tpl");
$savant->footer = $savant->fetch("footer_table.tpl");
$savant->logo = $savant->fetch("inner_logo.tpl");
$savant->nav = $savant->fetch("inner_top_nav.tpl");
$savant->sidebar = $savant->fetch("sidebar.tpl");
$savant->display("index.tpl");
?>
