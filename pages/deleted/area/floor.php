 <?php 
header('Content-type: application/json');
include_once('../../include_commons.php'); 
require('../../_errors/libError.php');


$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://edit.meridianapps.com/api/locations/4658918335184896/floors",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_HTTPHEADER => array(
    "cache-control: no-cache",
    "Token: eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ0IjoxNTY5OTI4NDc5LCJ2YWx1ZSI6IjM0YWQ0YzBmZjhlYmFlOWExZjcxYTRmYTViOWFlOGQ0NGU5MDdjN2YifQ.yx44_MV0snpE6I2Ei0kbHlL6nT51mAOoK4jd_F0JeqI"
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
   $result = $re['results'];
    foreach($result as $r){
       print_r($r['name']); 
    }
}
