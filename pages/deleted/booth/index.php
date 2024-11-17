 <?php 
include_once('../../include_commons.php'); 
require('../../_errors/libError.php');
$savant = new Savant3();
$savant->addPath("template", "../../includes/");	
$error_u=false;
$error_p=false;
$model = new Booth_Model();

if(isset($_SESSION['userid'])){
	$getuserdetails = usermodel::ReadSingle($_SESSION['userid']);
	
	if($getuserdetails->UTYPE == 'ADMIN'){
		$savant->allBooth = Booth_Model::ReadAll();
        $savant->services = ServiceModel::ReadAll_free();
        
       #get placemarkers
        #get all floors
    
$curl = curl_init();
 $url = "https://edit.meridianapps.com/api/locations/".LOCATION."/placemarks";
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
   $savant->placemarks = $re['results'];
    
}
//Get campaign list
$curl2 = curl_init();
 $url2 = "https://edit.meridianapps.com/api/locations/".LOCATION."/campaigns";
curl_setopt_array($curl2, array(
  CURLOPT_URL => $url2,
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

$response2 = curl_exec($curl2);
$err2 = curl_error($curl2);

curl_close($curl2);

if ($err2) {
  echo "cURL Error #:" . $err2;
} else {
  //echo $response;
    $re2 = json_decode($response2, true);
   $savant->campaigns = $re2['results'];
    
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
$savant->footer = $savant->fetch("footer_booth.tpl");
$savant->logo = $savant->fetch("inner_logo.tpl");
$savant->nav = $savant->fetch("inner_top_nav.tpl");
$savant->sidebar = $savant->fetch("sidebar.tpl");
$savant->display("index.tpl");
?>
