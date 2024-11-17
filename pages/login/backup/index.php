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
		
		$valid = false;
		$redirect = isset($_REQUEST['redirect']) ? $_REQUEST['redirect'] : '../home/index.php';
		// Check fields
		if (!isset($_POST['login']) or strlen($_POST['login']) == 0)
		{
			$error_u = 'Please enter your user name';
			
			
		}
		elseif (!isset($_POST['pass']) or strlen($_POST['pass']) == 0)
		{
			$error_p = 'Please enter your password';
			
		}else{
		
		$domain_name = substr(strrchr($_POST['login'], "@"), 1);
			$check = companymodel::ReadSingleByDomain($domain_name);
			if(empty($check)){
				$error_u = 'your company is not registered.';
			}		
		}
		$model->EMAIL = $_POST['login'];
			$model->PASSWORD = $_POST['pass'];
			//print_r($model);
			$user=usermodel::LoginUser($model);	
		//print_r($user);
        // $_SESSION['userid']='1';	
            header('Location:'.$redirect);
		$valid = ($_POST['login'] == $user->EMAIL and $_POST['pass'] == $user->PASSWORD);
			if (!$valid)
			{			
				$error = 'Wrong user/password, please try again';
			}
			
		else{
           
            #check this user active or not
            if($user->ISACTIVE == 1){
               $error = 'you have been deactivated by admin'; 
            }else{
            #check role
            $role = ROLEMODEL::ReadSingleByUser($user->UID);
             
            if(empty($role)){
              $_SESSION['userid']=$user->UID; 
               header('Location:../user/user_info.php');    
            }else{
              $_SESSION['userid']=$user->UID; 
               header('Location:'.$redirect);      
            }
				
           }
			
		}
		
		
	}
}

$savant->error_u = $error_u;
$savant->error_p = $error_p;
$savant->model = $model;
$savant->header = $savant->fetch("header.tpl");
$savant->footer = $savant->fetch("footer.tpl");
$savant->display("index.tpl");
?>
