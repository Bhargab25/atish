<?php 
include_once('../../include_commons.php'); 
require('../../_errors/libError.php');
$savant = new Savant3();
$savant->addPath("template", "../../includes/");	
$error_u=false;
$error_p=false;
$model = new usermodel();
$company = new companymodel();
$rfidmodel = new RFIDModel();
$edit_user_ID = Config::decrypt($_GET['uid']);
$picture = new PICTURE_MODEL();


$target_dir = "../../profile/images/";
 
if(isset($_SESSION['userid'])){
	$getuserdetails = usermodel::ReadSingle($_SESSION['userid']);
	$getCompany = companymodel::ReadSingle($getuserdetails->CID);
	$getEmployement = EMPLOYEMENT_MODEL::ReadSingleByCompany($getCompany->CNAME);
	$edit_user_details = usermodel::ReadSingle($edit_user_ID);
	
	if(isset($_POST['au'])){
		$model->UID = $_POST['userid'];	
		$model->CID = $getuserdetails->CID;
		$model->NAME = $_POST['fname'].' '.$_POST['lname'];
		$model->EMAIL = $_POST['Email1'];
		$model->PHONE = $_POST['phone'];
		$model->EMPLOYEE_CODE = $edit_user_details->EMPLOYEE_CODE;//$_POST['empcode'];
		//echo $_POST['userid']
		$model->PASSWORD = $_POST['phone'];
	//echo usermodel::ReadSingle($_POST['userid'])->PASSWORD;
		 $uid = usermodel::Update($model);
		if($uid != 0){
			#chcek rfid exist or not
			$checkrfid = RFIDModel::ReadSingle($uid);
			if(empty($checkrfid)){
				$rfidmodel->USERID = $_POST['userid'];	
		  $rfidmodel->RFID = $_POST['rfid'];
		  $rfidmodel->ISACTIVE = '0';
			$rf = RFIDModel::Create($rfidmodel);
			}else{
			$rfidmodel->USERID = $_POST['userid'];	
		  $rfidmodel->RFID = $_POST['rfid'];
		  $rfidmodel->ISACTIVE = '0';
                print_r($rfidmodel);
			$rf = RFIDModel::Update($rfidmodel);
			}
		
			if($rf != 0){
				if(basename($_FILES["picture"]["name"]) != ''){
					$target_file = $target_dir . basename($_FILES["picture"]["name"]);
				$uploadOk = 1;
				$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
				
				 
				// Check if image file is a actual image or fake image

					$check = getimagesize($_FILES["picture"]["tmp_name"]);
					if($check !== false) {
						echo "File is an image - " . $check["mime"] . ".";
						$uploadOk = 1;
					} else {
						echo "File is not an image.";
						$uploadOk = 0;
					}

				// Check if file already exists
				if (file_exists($target_file)) {
					echo "Sorry, file already exists.";
					$uploadOk = 0;
				}
				// Check file size
				if ($_FILES["picture"]["size"] > 500000) {
					echo "Sorry, your file is too large.";
					$uploadOk = 0;
				}
				// Allow certain file formats
				if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
				&& $imageFileType != "gif" ) {
					echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
					$uploadOk = 0;
				}
				// Check if $uploadOk is set to 0 by an error
				if ($uploadOk == 0) {
					echo "Sorry, your file was not uploaded.";
				// if everything is ok, try to upload file
				} else {
					if (move_uploaded_file($_FILES["picture"]["tmp_name"], $target_file)) {
						
						$picture->USERID = $_POST['userid'];
						$picture->PICTURE = basename( $_FILES["picture"]["name"]);
						$picture->PATH = $target_file;
						$pid = PICTURE_MODEL::Create($picture);
						if($pid != 0){
							 echo "The file ". basename( $_FILES["picture"]["name"]). " has been uploaded.";
							//$error_u = "You have successfully added user";
							header('location:view.php');
						}

					} else {
						echo "Sorry, there was an error uploading your file.";
					}
				}	

				
				}
				else{
					header('location:view.php');
				}
				
				
			}
			
		}
		
	
		
	}
	
	
}else{
	header('location:../login/index.php');
}

$savant->error_u = $error_u;
$savant->error_p = $error_p;
$savant->model = $edit_user_details;
$savant->user = $getuserdetails;
$savant->company = $getCompany;
$savant->employement = $getEmployement;
$savant->header = $savant->fetch("header_dashboard.tpl");
$savant->footer = $savant->fetch("footer_dashboard.tpl");
$savant->logo = $savant->fetch("inner_logo.tpl");
$savant->nav = $savant->fetch("inner_top_nav.tpl");
$savant->sidebar = $savant->fetch("sidebar.tpl");
$savant->display("details.tpl");
?>
