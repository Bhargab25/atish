 <?php 
include_once('../../include_commons.php'); 
require('../../_errors/libError.php');
$savant = new Savant3();
$savant->addPath("template", "../../includes/");	
$error_u=false;
$error_p=false;
$model = new EVENT_MODEL();



 

if(isset($_SESSION['userid'])){
	$getuserdetails = usermodel::ReadSingle($_SESSION['userid']);
	
	if($getuserdetails->UTYPE == 'ADMIN'){
		$savant->allBooth = Booth_Model::ReadAll();
        $savant->allusers = usermodel::ReadAll();
        $savant->getEvent = EVENT_MODEL::ReadSingle(base64_decode($_GET['e']));
      if(isset($_POST['av'])){
        #check dates 
        $today = strtotime(date('Y-m-d'));
        $sdate = strtotime(date('Y-m-d',strtotime($_POST['sdate'])));
        $edate = strtotime(date('Y-m-d',strtotime($_POST['edate'])));  
       if($today >= $sdate or $today <= $edate){
            #create event
        $model->ID = base64_decode($_POST['eds']);  
        $model->NAME = $_POST['event_name'];
        $model->DESCRIPTION = $_POST['desc'];
        $model->BOOTHS= Utils::ARRAY_TO_CSV($_POST['getbooth']);
        $model->SERVICES = Utils::ARRAY_TO_CSV($_POST['services']);
        $model->STARTDATE = $_POST['sdate'];
        $model->ENDDATE = $_POST['edate'];
        $model->FLOOR_ID = '0';
        if($sdate == $today){
             $model->STATUS = 'ONGOING';
        }else{
            $model->STATUS = 'COMMING SOON';
        }
       
       // print_r($model);  
        $event_id = EVENT_MODEL::Update($model);
         if($event_id != 0){
            #create topic for sms
  
            
            #----------------------
            #sent invitations
            $inv = new INVITE_MODEL();
          //  print_r($_POST['invite']);
          //  $get_inv = array_diff(Utils::CSV_TO_ARRAY()) 
            foreach($_POST['invite'] as $invit){
          //  echo $invit;    
            #check user already have an invation or not
            $check = INVITE_MODEL::ReadSingleByEventNUser(base64_decode($_GET['e']),$invit); 
            if(empty($check)){
                  $inv->ID = 'NULL';
            $inv->USERID = $invit;
            $inv->EVENTID = $event_id; 
            $inv->ACCESSCODE = '1234';
            $inv->STATUS = 'NO RESPONSE';
            $inv->CREATEDATE = date('Y-m-d H:i:s');
            $inv->ISACTIVE = '0';
            #check already user have or not
                
            $in = INVITE_MODEL::Create($inv); 
            #send Push Notification
            $push = PUSH::ReadSingle($invit);
            $title = 'You have recieve an invitation';
            $action = 'Invitation';
            $regkey = $push->DEVICE_TOKEN;
            $body = array("event_id"=>$event_id,"name"=>$_POST['event_name'],"start_date"=>$_POST['sdate'],"end_date"=>$_POST['edate'],"userid"=>$invit,"description"=>$_POST['desc']);  
            
           
            #send push to android
            $pid[] = PUSH::sendPush($regkey,$title,$body,$action,$push->DEVICE_TYPE);        
            }else{
               #send Push Notification
            $push = PUSH::ReadSingle($invit);
            $title = 'You have recieve an invitation';
            $action = 'Invitation';
            $regkey = $push->DEVICE_TOKEN;
            $body = array("event_id"=>$event_id,"name"=>$_POST['event_name'],"start_date"=>$_POST['sdate'],"end_date"=>$_POST['edate'],"userid"=>$invit,"description"=>$_POST['desc']);  
            
           
            #send push to android
            $pid[] = PUSH::sendPush($regkey,$title,$body,$action,$push->DEVICE_TYPE);     
            }    
          
               
            
            
           
                
                
            } 
            
             
             
             
           // print_r($pid);
            header('location:view.php');
            
        }else{
            $error_u = 'Sorry there is an error';
        }    
        }else{
            
         $error_u = 'Entered a valid start date';
        }
        
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
$savant->footer = $savant->fetch("footer_event.tpl");
$savant->logo = $savant->fetch("inner_logo.tpl");
$savant->nav = $savant->fetch("inner_top_nav.tpl");
$savant->sidebar = $savant->fetch("sidebar.tpl");
$savant->display("edit.tpl");
?>
