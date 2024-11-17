 <?php 
include_once('../../include_commons.php'); 
require('../../_errors/libError.php');

$model = new Booth_Model();
if(isset($_SESSION['userid'])){
    
$pl_id = $_POST['booth'];
    
	$getuserdetails = usermodel::ReadSingle($_SESSION['userid']);
	
	if($getuserdetails->UTYPE == 'ADMIN'){
		
       #get placemarkers
        #get all floors
    
$curl = curl_init();
$url = 'https://edit.meridianapps.com/api/locations/'.LOCATION.'/placemarks/'.$pl_id ;
curl_setopt_array($curl, array(
  CURLOPT_URL => $url,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_HTTPHEADER => array(
    "cache-control: no-cache",
    "Token: ".TOKEN
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  //echo $response;
    $re = json_decode($response, true);
   // echo   $placemarks = $re->name;
    $placemarks = $re['name'];
    #upload image
     if ($_FILES['logo']['size'] == 0){
        $model->IMAGE = "";
        }else{
          
            #upload category image 
    $target_dir = "../../booth_img/";
   // $imageName = (basename($_FILES["catImage"]["name"]));   
    $temp = explode(".", $_FILES["logo"]["name"]);
    $imageName = round(microtime(true)) . '.' . end($temp);        
    $target_file = $target_dir . $imageName;
$uploadOk = 1;
 $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image

    $check = getimagesize($_FILES["logo"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
        
// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["logo"]["size"] > 500000) {
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
    
    if (move_uploaded_file($_FILES["logo"]["tmp_name"], $target_file)) {
        echo "The file ". $imageName. " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
    #----------------------File Upload end here -------------------
    $model->IMAGE = $imageName;    
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }

            
          
        }
    
    $model->NAME = $_POST['bname'];
   
    $model->DESCRIPTION = $_POST['desc'];
    $model->BEACON = $re['name'];    
    $model->SERVICES = Utils::ARRAY_TO_CSV($_POST['services']); 
    $model->PLACEMARKER_ID = $re['id'];
    $model->PLACEMARKER_X = $re['x'];
    $model->PLACEMARKER_Y = $re['y'];
    $model->PLACEMARKER_AREA = $re['area'];
    $model->CAMPAIGN_ID = Utils::ARRAY_TO_CSV($_POST['camp']);
    $model->CREATEDATE = date('Y-m-d H:i:s');
    $model->ISACTIVE = '1';
 //   print_r($model);
    $bid = Booth_Model::Create($model);
    if($bid != 0){
        echo "Successfully added your booth";
        #assign booth to service table
        $service = new ServiceModel();
        $allservice = $_POST['services'];
        for($i=0; $i<count($allservice); $i++){
            #update 
            ServiceModel::UpdateBooth($allservice[$i],$bid);
        }
    }
    
    
}
	}
	
	
	
}else{
	header('location:../login/index.php');
}


?>
