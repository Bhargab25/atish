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
	
	$getEmployement = EMPLOYEMENT_MODEL::ReadSingleByCompany($getCompany->CNAME);
	$role = ROLEMODEL::ReadSingleByUser($_SESSION['userid'])->ROLE;
	if($role == 'superadmin'){
	 $allCompany = companymodel::ReadAll();	
	 $allusers = usermodel::ReadAll();
		$savant->category = ASCAT_MODEL::ReadAll();
	}
	if($role == 'admin'){
		$allusers = usermodel::ReadAllByCompany($getuserdetails->CID);
		$savant->category = ASCAT_MODEL::ReadAll();
	}
	if (isset($_POST['ad']))
	{
	$catmodel = new ASCAT_MODEL();// asset category model call
	#upload category image 
    $target_dir = "../../profile/category/";
    $temp = explode(".", $_FILES["catImage"]["name"]);
    $imageName = round(microtime(true)) . '.' . end($temp);        
    $target_file = $target_dir . $imageName;
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image

    $check = getimagesize($_FILES["catImage"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
        
// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["catImage"]["size"] > 500000) {
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
    if (move_uploaded_file($_FILES["catImage"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["catImage"]["name"]). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
    #----------------------File Upload end here -------------------
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
   
        
	$catmodel->NAME = $_POST['cname'];
    $catmodel->IMAGE = $imageName;    
	$catmodel->CREATEDATE = date('Y-m-d H:i:s');
	$catmodel->ISACTIVE = 'Y';	
        
	$catid = ASCAT_MODEL::Create($catmodel);
		if($catid != 0){
			$error_p = 'New asset category Added Successfully!';
			$current_device = ASCAT_MODEL::ReadSingle($catid)->NAME;
			$savant->curD = $current_device;
            header('location: cat.php');
		}else{
			$error_u = 'There is some error please try later';
		}
	
	}
    
    if(isset($_POST['upd'])){
        $catmodel = new ASCAT_MODEL();
        $catmodel->ID = base64_decode($_POST['catid']);
        $catmodel->NAME = $_POST['cname'];
        //echo ASCAT_MODEL::ReadSingle($_POST['catid'])->IMAGE;
       // echo ASCAT_MODEL::ReadSingle(base64_decode($_POST['catid']))->IMAGE;
        if ($_FILES['catImage']['size'] == 0){
        $catmodel->IMAGE = ASCAT_MODEL::ReadSingle(base64_decode($_POST['catid']))->IMAGE;
        }else{
          
            #upload category image 
    $target_dir = "../../profile/category/";
   // $imageName = (basename($_FILES["catImage"]["name"]));   
    $temp = explode(".", $_FILES["catImage"]["name"]);
    $imageName = round(microtime(true)) . '.' . end($temp);        
    $target_file = $target_dir . $imageName;
$uploadOk = 1;
 $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image

    $check = getimagesize($_FILES["catImage"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
        
// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["catImage"]["size"] > 500000) {
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
    
    if (move_uploaded_file($_FILES["catImage"]["tmp_name"], $target_file)) {
        echo "The file ". $imageName. " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
    #----------------------File Upload end here -------------------
    $catmodel->IMAGE = $imageName;    
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }

            
          
        }
          
      //  print_r($catmodel);
        ASCAT_MODEL::UPDATE($catmodel);
         header('location: cat.php');
    }
	
	
}else{
	header('location:../login/index.php');
}

$savant->error_u = $error_u;
$savant->error_p = $error_p;
$savant->user = $getuserdetails;
$savant->company = $getCompany;
$savant->companies = $allCompany;
$savant->users = $allusers;
$savant->employement = $getEmployement;
$savant->header = $savant->fetch("header_dashboard.tpl");
$savant->footer = $savant->fetch("footer_asset.tpl");
$savant->logo = $savant->fetch("inner_logo.tpl");
$savant->nav = $savant->fetch("inner_top_nav.tpl");
$savant->sidebar = $savant->fetch("sidebar.tpl");
$savant->display("cat.tpl");
?>
