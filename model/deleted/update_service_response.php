<?php
header('Content-type: application/json');
include_once '../include_commons.php';
$headers = apache_request_headers();
$array = array();
$errors = array();
//check authorisation
	if (!isset($headers['Token'])) {
	header('WWW-Authenticate: Basic realm="My Realm"');
	header('HTTP/1.0 401 Unauthorized');
	$array["status"] = "failure";
    $array["message"] = "You are not authorised";
    $array["errors"] = array("request" => "NOT allowed");
    echo json_encode($array);
		die();
				}
	//---------------------
if (Utils::IsPost()) {
    $userid = $_POST['userid'];
    $eventid = $_POST['eventid'];
    $boothid = $_POST['boothid'];
    $services = $_POST['services'];
   
	
    if (!Validator::validate_blank($userid)) {
        $errors["userid"] = "Required";
    }//username
    if (!Validator::validate_blank($eventid)) {
        $errors["eventid"] = "Required";
    }//username
    if (!Validator::validate_blank($boothid)) {
        $errors["boothid"] = "Required";
    }//username
	if (!Validator::validate_blank($services)) {
        $errors["services"] = "Required";
    }//username
	
	if (count($errors) != 0) {
        $array["status"] = "failure";
        $array["message"] = "Validation Problem";
        $array["errors"] = $errors;
        echo json_encode($array);
    } else {
        $getuserdetail = usermodel::ReadSingle($userid);
        // check secretkey match or not
        
		if ($getuserdetail->SECRETKEY != $headers['Token']) {
				  header('WWW-Authenticate: Basic realm="My Realm"');
				  header('HTTP/1.0 401 Unauthorized');
				  $array["status"] = "failure";
				$array["message"] = "You are not authorised";
					$array["errors"] = array("request" => "Token mismatch");
					echo json_encode($array);
		die();
				}
       	#update services your response against event
    $get_event = EVENT_MODEL::ReadSingle($eventid);
    $get_invite_row = INVITE_MODEL::ReadSingleByEventNUser($eventid,$userid);    
    $get_userlog_row = USR_LOG_HISTORY::ReadSingleByEvnt_booth_user($userid,$eventid,$boothid);
    #update Response
    if(empty($get_invite_row)){
        $array["status"] = "failure";   
     $array["message"]="Event or user not identify";
    }else if(empty($get_userlog_row)){
     $array["status"] = "failure";   
     $array["message"]="you still not visit this stall";
    }else
    {
        #update services
        $log = new USR_LOG_HISTORY();
    $log->SERVICEID = $services;
    $log->USERID = $userid;    
    $log->BOOTHID = $boothid;
    $log->EVENTID = $eventid;    
        
      USR_LOG_HISTORY::update_services($log);  
        
          
        
     $array["status"] = "success";   
     $array["message"]="Succesfully Update";
    
    }   
    
		 		
	echo json_encode($array);
	}
}else {
    $array["status"] = "failure";
    $array["message"] = "POST Request is NOT allowed";
    $array["errors"] = array("request" => "Post is NOT allowed");
    echo json_encode($array);
}//POST
		
?>