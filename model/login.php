<?php
header('Content-type: application/json');
include_once '../include_commons.php';

$array = array();
$errors = array();

if (Utils::IsPost()) {
    $email = $_POST['email'];
	$password = $_POST['password'];
	$device_id = $_POST['deviceId'];
	$token = $_POST['device_token'];
	$device_type = $_POST['type'];
	
    if (!Validator::validate_blank($email)) {
        $errors["email"] = "Required";
    }//username
	if (!Validator::validate_blank($password)) {
        $errors["password"] = "Required";
    }//password
	if (!Validator::validate_blank($device_id)) {
        $errors["deviceId"] = "Required";
    }//password
	if (!Validator::validate_blank($token)) {
        $errors["device_token"] = "Required";
    }//password
	if (!Validator::validate_blank($device_type)) {
        $errors["type"] = "Required";
    }//password
	
	if (count($errors) != 0) {
        $array["status"] = "failure";
        $array["message"] = "Validation Problem";
        $array["errors"] = $errors;
        echo json_encode($array);
    } else {
		$user = new usermodel();
		$user->EMAIL = $email;
		$user->PASSWORD = $password;
		$checkuser = usermodel::LoginUser($user);
		//print_r($checkuser);
		if(!empty($checkuser)){
            $user1 = new usermodel();
			#update login 
			$user1->ID = $checkuser->ID;
			$user1->LASTLOGIN = date('Y-m-d H:i:s');
			usermodel::Update_Login($user1);
            $userdetails = array('id'=>$checkuser->ID,'usertype'=>$checkuser->UTYPE,'name'=>$checkuser->FNAME.' '.$checkuser->LNAME,'email'=>$checkuser->EMAIL,'phone'=>$checkuser->PHONE,'company'=>$checkuser->COMPANY,'designation'=>$checkuser->DESIGNATION);
            
            #check user have any event or not
            $checkIn = INVITE_MODEL::ReadAlluser($checkuser->ID);
            if(empty($checkIn)){
                $invites = array();
            }else{
                foreach($checkIn as $inv){
                    $event = EVENT_MODEL::ReadSingle($inv->EVENTID);
                    $event_details = array('id'=>$event->ID,'name'=>$event->NAME,'description'=>DESCRIPTION,'floor'=>$event->FLOOR_ID,'booths'=>Utils::CSV_TO_ARRAY($event->BOOTHS),'services'=>Utils::CSV_TO_ARRAY($event->SERVICES),'start_date'=>$event->STARTDATE,'end_date'=>$event->ENDDATE);
                    $invites[] = array('id'=>$inv->ID,'event'=>$event_details,'response'=>$inv->STATUS);
                }
            }
            
			$array["status"] = "success";
        	$array["message"] = "Thanks for login";
            $array["profile"]= $userdetails;
            $array["events"] = $invites;
		}else{
			$array["status"] = "failur";
        	$array["message"] = "enter a valid username/password";
				
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