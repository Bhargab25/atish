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
  $rcv_email = $_GET['id'];
      
} else { 
	if (isset($_POST['log_submit']))
	{
        echo $_GET['id'].' = '.md5($_POST['login']);
       if(md5($_POST['login'])!= $_GET['id']){
           $error_u = 'Please enter a valid email id';
       }else{
           if($_POST['npass']==$_POST['cpass']){
               #update with new password
               $user = new usermodel();
               $user->EMAIL = $_POST['login'];
               $user->PASSWORD = $_POST['npass'];
               $user->MODIFIEDDATE = date('Y-m-d H:i:s');
               usermodel::UpdatePassword($user);
               header('location:index.php');
           }else{
             $error_u = 'New password and confirm password are not same';  
           }
       } 
 
        
    }
}

$savant->error_u = $error_u;
$savant->error_p = $error_p;
$savant->model = $model;
$savant->header = $savant->fetch("header.tpl");
$savant->footer = $savant->fetch("footer.tpl");
$savant->display("reset.tpl");
?>
