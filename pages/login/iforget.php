<?php 
include_once('../../include_commons.php'); 
require('../../_errors/libError.php');
$savant = new Savant3();
$savant->addPath("template", "../../includes/");	
$error_u=false;
$error_p=false;
$model = new usermodel();
$company = new companymodel();
if (Utils::IsGet()) {

} else { 
	if (isset($_POST['log_submit']))
	{
      #check this user exist or not
      $check = usermodel::ReadSingleByEmail($_POST['login']); 
      if(empty($check)){
          $error_u = 'This user doesnot exist, enter valid email id';
      }else{
    $getTemplate_subject = 'FADO: Reset your password';
    $getTemplate_body = 'Please reset your password by using the below link <br>';
     $getTemplate_body .= Config::make_bitly_url('http://'.$_SERVER['SERVER_NAME'].':8001/pages/login/reset.php?id='.md5($check->EMAIL));     
$api= new ApiModel();
$method = 'POST';
$url = 'http://dev.letsfado.com/API/sendmail.php';
$data = 'subject='.$getTemplate_subject.'&body='.$getTemplate_body.'&email='.$check->EMAIL; 
   $error_p = ApiModel::callAPI($method, $url, $data);  
      }    
        
    }
}

$savant->error_u = $error_u;
$savant->error_p = $error_p;
$savant->model = $model;
$savant->header = $savant->fetch("header.tpl");
$savant->footer = $savant->fetch("footer.tpl");
$savant->display("iforget.tpl");
?>
