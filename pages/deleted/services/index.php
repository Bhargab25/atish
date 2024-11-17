 <?php 
include_once('../../include_commons.php'); 
require('../../_errors/libError.php');
$savant = new Savant3();
$savant->addPath("template", "../../includes/");	
$error_u=false;
$error_p=false;
$model = new ServiceModel();

if(isset($_SESSION['userid'])){
	$getuserdetails = usermodel::ReadSingle($_SESSION['userid']);
	
	if($getuserdetails->UTYPE == 'ADMIN'){
		$savant->services = ServiceModel::ReadAll();
       $savant->booths = Booth_Model::ReadAll_active();
	}
	if (isset($_POST['da']))
	{
       #check this service already exist in this booth or not
        $check = ServiceModel::ReadSingleByBoothNSname($_POST['booth'],$_POST['sname']);
        if(empty($check)){
          $model->BOOTHID = $_POST['booth'];
         $model->NAME = $_POST['sname'];
        $model->DESCRIPTION = $_POST['desc'];
        $model->CREATEDDATE = date('Y-m-d H:i:s');
        $model->ISACTIVE = '1';
      // print_r($model);
        $did = ServiceModel::Create($model);
        if($did != 0){
            $error_p = 'Successfully Added';
            if($_POST['booth'] != '' or $_POST['booth']!= '0'){
                #update on booth
                $getBooth = Booth_Model::ReadSingle($_POST['booth']);
                if(!in_array($did,Utils::CSV_TO_ARRAY($getBooth->SERVICES))){
                    $update_service = $getBooth->SERVICES.','.$did;
                    #update on DB
                    Booth_Model::UpdateService($_POST['booth'],$update_service);
                }
            }
            header('Location:index.php');
        }  
        }else{
            $error_p = 'This service already exist in this booth';
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
$savant->footer = $savant->fetch("footer_services.tpl");
$savant->logo = $savant->fetch("inner_logo.tpl");
$savant->nav = $savant->fetch("inner_top_nav.tpl");
$savant->sidebar = $savant->fetch("sidebar.tpl");
$savant->display("index.tpl");
?>
