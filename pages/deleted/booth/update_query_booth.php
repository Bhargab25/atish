 <?php 
echo 'jhjk';
include_once('../../include_commons.php'); 
require('../../_errors/libError.php');
$error = '';
$model = new BoothQuery_Model();
echo 'hkk';
if(isset($_SESSION['userid'])){
  
 $boothlist = $_POST['booths'];
 $query_id = $_POST['id'];    
$check = Feedback_Model::ReadSingleByBoothQid($boothlist,$query_id);  
 $getQuery = BoothQuery_Model::ReadSingle($query_id);    
 if(empty($check)){
     #update boothlist in query model
     
     $totalBoothlist = Utils::CSV_TO_ARRAY($getQuery->BOOTHID);
     $getFinallist = array_diff($totalBoothlist,array($boothlist));
     $model->ID = $getQuery->ID;
     $model->BOOTHID = Utils::ARRAY_TO_CSV($getFinallist);
    BoothQuery_Model::Update_Booth($model);
     echo 'Successfully updated';
 }else{
     echo 'We are not able to delete this booth because its have some data log';
 }    
    
 // header('location:query.php');  
 
   
	
}else{
	//header('location:../login/index.php');
}


?>
