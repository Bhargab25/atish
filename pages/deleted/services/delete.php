 <?php 
include_once('../../include_commons.php'); 
require('../../_errors/libError.php');

$model = new ServiceModel();
if(isset($_SESSION['userid'])){
$service_id = base64_decode($_GET['id']);
#get service details 
$service_details = ServiceModel::ReadSingle($service_id);
if($service_details->BOOTHID == '0'){
  #delete service 
 ServiceModel::Delete($service_id);    
}else{
 #getbooth details 
 $boothDetails = Booth_Model::ReadSingle($service_details->BOOTHID);
 $boothService = Utils::CSV_TO_ARRAY($boothDetails->SERVICES);
 $booth_update_service = Utils::ARRAY_TO_CSV(array_diff($boothService,array('0'=>$service_id)));  
 #get all events
 $events = EVENT_MODEL::ReadAll();
 foreach($events as $ev){
    EVENT_MODEL::UpdateService($ev->ID,$booth_update_service); 
    #update booth
  Booth_Model::UpdateService($boothDetails->ID,$booth_update_service); 
 }    
 
  ServiceModel::Delete($service_id);  
}    
 
  header('location:index.php');  
	
}else{
	header('location:../login/index.php');
}


?>
