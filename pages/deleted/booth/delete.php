 <?php 
include_once('../../include_commons.php'); 
require('../../_errors/libError.php');
$error = '';
$model = new Booth_Model();
if(isset($_SESSION['userid'])){
$booth_id = base64_decode($_GET['id']);
$events = EVENT_MODEL::ReadAll();
    //print_r($events);
 foreach($events as $ev){
     //echo $ev->BOOTHS;
     $get_event_booths = Utils::CSV_TO_ARRAY($ev->BOOTHS);
     if(in_array($booth_id,$get_event_booths)){
         $error = '0';
     }
 } 
if($error == ''){
  Booth_Model::Delete($booth_id); 
    #read all by booth
    $getservices = ServiceModel::ReadAll_Bybooth($booth_id);
    foreach($getservices as $sr){
        #update service table
    
    ServiceModel::UpdateBooth($sr->ID,'0');
    }
  
  header('location:index.php');  
}else{
  header('location:index.php?e='.$error);  
}    
   
	
}else{
	header('location:../login/index.php');
}


?>
