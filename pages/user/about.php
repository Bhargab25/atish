<?php 
include_once('../../include_commons.php'); 
require('../../_errors/libError.php');
#read only about this user 
if(isset($_GET['uid'])){
	$check = USR_DSC_MODEL::ReadSingle($_GET['uid']);
	echo $check->DESCRIPTION;
}
#--------End here----------------------
#Add or Edit and read about this user
if(isset($_POST['abt'])){
	$usr_abt = new USR_DSC_MODEL();
	$check = USR_DSC_MODEL::ReadSingle($_POST['uid']);
	if(empty($check)){
		$usr_abt->UID = $_POST['uid'];
		$usr_abt->DESCRIPTION = $_POST['abt'];
		$abtid = USR_DSC_MODEL::Create($usr_abt);
		
		if($abtid != 0){
		if($_POST['abt'] == ''){
		echo "<a class='btn btn-primary btn-xs'>+ Add</a>";	
		}else{
			echo $_POST['abt'];
		}
		
	}else{
		echo "<a class='btn btn-primary btn-xs'>+ Add</a>";
	}
		
	}else{
		$usr_abt->UID = $_POST['uid'];
		$usr_abt->DESCRIPTION = $_POST['abt'];
		$abtid = USR_DSC_MODEL::Update($usr_abt);
	}

}
#--------End here----------------------
#add employement
$emp = new EMPLOYEMENT_MODEL();


if(isset($_POST['cname'])){
	$joindate = $_POST['joiningDate'];
	$joindate_newDate = date("Y-m-d", strtotime($joindate));
	$releaseDate = $_POST['ReleaseDate'];
	$releaseDate_newDate = date("Y-m-d", strtotime($releaseDate));
	
	
	$emp->UID = $_POST['uid'];
	$emp->COMPANY_NAME = $_POST['cname'];
	$emp->DESIGNATION = $_POST['designation'];
	$emp->JOINDATE = $_POST['joiningDate'];
	if($_POST['ReleaseDate'] == ''){
	$emp->RELEASEDATE = '0000-00-00';	
	}else{
	$emp->RELEASEDATE = $releaseDate_newDate;	
	}
	$emp->LOCATION = $_POST['cloc'];
	//print_r($emp);
	$empid = EMPLOYEMENT_MODEL::Create($emp);
	if($empid != 0){
		echo 'successfully added';
	}else{
		echo 'not added';
	}
}
?>