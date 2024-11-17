 <?php 
include_once('../../include_commons.php'); 
require('../../_errors/libError.php');
$savant = new Savant3();
$savant->addPath("template", "../../includes/");	
$error_u=false;
$error_p=false;
$model = new DEVICE_MODEL();
$error_p = '';
if(isset($_SESSION['userid'])){
	$getuserdetails = usermodel::ReadSingle($_SESSION['userid']);
	
	if($getuserdetails->UTYPE == 'ADMIN'){
		$savant->allDevice = DEVICE_MODEL::ReadAll2();
       
	}
	if (isset($_POST['da']))
	{
        #check device exist or not
           $checkDevice = DEVICE_MODEL::ReadSingleBySERIAL_No($_POST['snd']);
            if(empty($checkDevice)){
                $model->NAME = $_POST['dname'];
                $model->SERIAL_No = $_POST['snd'];
                $model->TYPE = $_POST['dtype'];
                $model->CREATEDATE = date('Y-m-d H:i:s');
                $model->ISACTIVE = '1';

                $did = DEVICE_MODEL::Create($model);
                if($did != 0){
                    $error_p = 'Successfully Added';
                    header('Location:index.php');
                }
            }else{
                #check device is active or not
                $error_p = 'This device already exist';
            }
        #---------------------------
        
		
	}
	
	
}else{
	//header('location:../login/index.php');
}

$savant->error_u = $error_u;
$savant->error_p = $error_p;
$savant->model = $model;
$savant->user = $getuserdetails;

$savant->header = $savant->fetch("header_table.tpl");
$savant->footer = $savant->fetch("footer_table.tpl");
$savant->logo = $savant->fetch("inner_logo.tpl");
$savant->nav = $savant->fetch("inner_top_nav.tpl");
$savant->sidebar = $savant->fetch("sidebar.tpl");
$savant->display("index.tpl");
?>
