<?php 
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
session_start();
include_once('../../include_commons.php'); 
// require('../../_errors/libError.php');
$savant = new Savant3();
$savant->addPath("template", "../../includes/");	
$error_u=false;
$error_p=false;
$model = new usermodel();
// $company = new companymodel();
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
           // print_r($check);
			if(empty($check)){
				$error_u = 'your company is not registered.';
			}		
		}
      
			$model->userid = $_POST['userid'];
			$model->password = $_POST['pass'];
			//print_r($model);
			$user=usermodel::LoginUser($model);	
		    // print_r($user);
		$valid = ($_POST['userid'] == $user->userid and $_POST['pass'] == $user->password);
			if (!$valid)
			{			
				$error_u = 'Wrong user/password, please try again';
			}
			
		else{
            if($user->status=='0'){
                $error_u = 'Your account is being deativated by admin,Please Contact admin';
            }else{
            $_SESSION['userid'] = $user->uid;	
			header('Location:'.$redirect);
            }
			
		}
		
		
	}
}

$savant->error_u = $error_u;
$savant->error_p = $error_p;
$savant->model = $model;
$savant->header = $savant->fetch("headerForLogin.tpl");
$savant->script = $savant->fetch("script.tpl");
$savant->display("index.tpl");
?>
