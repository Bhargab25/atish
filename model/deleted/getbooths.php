<?php
header('Content-type: application/json');
include_once '../include_commons.php';
$headers = apache_request_headers();
$array = array();
$errors = array();
$upcoming = array();
$current = array();
$finish = array();
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
	
	
    if (!Validator::validate_blank($userid)) {
        $errors["userid"] = "Required";
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
       	#get all event by user
        #to get all event need to know how many invites he recived
        $getInvites = INVITE_MODEL::ReadAlluser($userid);
        if(empty($getInvites)){
           $allEvents=array(); 
        }
       
        foreach($getInvites as $gi){    
            $get_event_details = EVENT_MODEL::ReadSingle($gi->EVENTID);
            $today = date('Y-m-d');
            $startdate = date('Y-m-d',strtotime($get_event_details->STARTDATE));
            $enddate = date('Y-m-d',strtotime($get_event_details->ENDDATE));
            #check the if event are started today then only it will show
           // echo "eventid:".$get_event_details->ID."==".($today)."==".($startdate)."<br>";
            
                //echo $get_event_details->SERVICES;
//                die();
            #get service list for the event
            $service_array = Utils::CSV_TO_ARRAY($get_event_details->SERVICES);
            foreach($service_array as $serv){
                #services details
                $ser_details = ServiceModel::ReadSingle($serv);
                $services[]=array("id"=>$serv,"name"=>$ser_details->NAME,"description"=>$ser_details->DESCRIPTION,"status"=>$ser_details->ISACTIVE);
                
            }
            #get booth details
            $booth_array .= $get_event_details->BOOTHS.',';
            //$booth_array .= ',';
            //foreach($booth_array as $bootharray){
//                #Booth details
//                $booth_details = Booth_Model::ReadSingle($bootharray);
//                $booths[]=array("id"=>$bootharray,"placemarker_name"=>$booth_details->BEACON,"placemarker_id"=>$booth_details->PLACEMARKER_ID,"placemarker_x"=>$booth_details->PLACEMARKER_X,"placemarker_y"=>$booth_details->PLACEMARKER_Y,"name"=>$booth_details->NAME,"description"=>$booth_details->DESCRIPTION,"status"=>$booth_details->ISACTIVE);
//            }
           //$booths=array_unique($booths); 
        }
     $booth_array = array_unique(Utils::CSV_TO_ARRAY(substr($booth_array, 0, -1)));
    foreach($booth_array as $bootharray){
                #Booth details
                $booth_details = Booth_Model::ReadSingle($bootharray);
                #check user visited or not
                $check_visited = USR_LOG_HISTORY::ReadSingleByuserNbooth($userid,$booth_array);
                if(empty($check_visited)){
                    $visited = false;
                }else{
                    $visited = true;
                }
                #------------------------
                $booths[]=array("id"=>$bootharray,"placemarker_name"=>$booth_details->BEACON,"placemarker_id"=>$booth_details->PLACEMARKER_ID,"placemarker_x"=>$booth_details->PLACEMARKER_X,"placemarker_y"=>$booth_details->PLACEMARKER_Y,"name"=>$booth_details->NAME,"description"=>$booth_details->DESCRIPTION,"status"=>$booth_details->ISACTIVE,"visited"=>$visited);
            }    
     $array["status"]= 'success';
     $array["message"]="here is your event list";
     $array["booths"]= $booths;  
		 		
	echo json_encode($array);
	}
}else {
    $array["status"] = "failure";
    $array["message"] = "POST Request is NOT allowed";
    $array["errors"] = array("request" => "Post is NOT allowed");
    echo json_encode($array);
}//POST
		
?>