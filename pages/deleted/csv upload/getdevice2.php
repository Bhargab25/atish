<?php
header('Content-type: application/json');
include_once '../include_commons2.php';

$array = array();
$errors = array();

if (Utils::IsPost()) {
 $code = $_POST['code'];
 $rfid = $_POST['id'];	
$profile = array();	
	  if (!Validator::validate_blank($code)) {
        $errors["code"] = "Required";
    }//username
	 if (!Validator::validate_blank($rfid)) {
        $errors["id"] = "Required";
    }//username
	if (count($errors) != 0) {
        $array["status"] = "failure";
        $array["message"] = "Validation Problem";
        $array["errors"] = $errors;
        echo json_encode($array);
    } else {
		if($code != -1){
		$getDeviceId = DEVICEM::ReadSingleByRFID($code);
		}else{
		 $check = usermodel::ReadSingleByRfid($rfid);
		 if(empty($check)){
			$array['success']='false';
			$array['message']='This card is not valid';
			echo json_encode($array);
			die(); 
		 }else{
			 #check any device assign or not
			// echo $check->ID;
			$getdevicid = ASSIGN_MODEL::ReadSingleByUid($check->ID); 
			// print_r($getdevicid);
			 if(empty($getdevicid)){
				$array['success']='true';
				$array['message']='This user doesnot have any device';
				echo json_encode($array);
				die();  
			 }else{
				  $Uphone = $check->PHONE;
					if(strlen($Uphone)== 10){
						$Uphone = '91'.$Uphone;
					}else{
						$Uphone = $Uphone;
					}	
					$sms = new SmsHandler();
					 $sms->sms_to = $Uphone;
					$sms->content = 'Alert: '.'you have not carried your device or device is not detected please confirm, click on the below link '.Config::make_bitly_url('http://dev.letsfado.com/trackApi/temp/confirm.php?uid='.base64_encode($check->ID).'&deviceid='.base64_encode($getdevicid->DID));
				   
				 //	print_r($sms);
				 	SmsHandler::SendSms($sms);
				 $array['success']='false';
				$array['message']='User have a device, serial no.'.DEVICEM::ReadSingle($getdevicid->DID)->SERIAL_No;
				echo json_encode($array);
				die(); 
			 }
		 }	
		}
		//print_r($getDeviceId);
		
		if(empty($getDeviceId)){
			$msg ='This device is not registered';
		}else{
		#get assign id
		$assign = ASSIGN_MODEL::ReadSingleByDid($getDeviceId->ID);
		//print_r($assign);	
		if(empty($assign)){
			$array['success']='false';
			$array['message']='This device is not assign to any user';
			echo json_encode($array);
			die();
		}else if($assign->STATUS == 'FREE'){
			$array['success']='false';
			$array['message']='This device is not assign to any user';
			echo json_encode($array);
			die();	
		}	
		#check device is with the correct person or not
		$checkUser = usermodel::ReadSingleBycard($assign->UID,$rfid);
		//print_r($checkUser);	
			if(empty($checkUser)){
				#inform to the database update to wrong
				DEVICEM::Update($getDeviceId->ID,'FALSE');
				#get owner details 
				$user = usermodel::ReadSingle($assign->UID);
				#get traspasser details
				$traspasser = usermodel::ReadSingleByRfid($rfid);
				if(empty($traspasser)){
					$array['success']='false';
					$array['message']='This device is not belongs to you';
					echo json_encode($array);
					die();
				}else{
				#inform to the owner
				$status = 'false';
				$Uphone = $user->PHONE;
					if(strlen($Uphone)== 10){
						$Uphone = '91'.$Uphone;
					}	
					$sms = new SmsHandler();
					$sms->sms_to = $Uphone;
					$sms->content = 'Alert: '.'your device is taken out with '.$traspasser->NAME.' his phone number is '.$traspasser->PHONE;

					SmsHandler::SendSms($sms);
					$msg = $user->NAME.' your device is taken out with '.$traspasser->NAME.' his phone number is '.$traspasser->PHONE;
	
				}		
			}else{
				#if all is well :)
				//echo $getDeviceId->STATUS;
			if($getDeviceId->STATUS == 'ASSIGN')
				{
				$status = 'true';
				#just assign to the user
				#update it to out
				DEVICEM::Update($getDeviceId->ID,'OUT');
				#send sms to the user
				$Uphone = $checkUser->PHONE;
				if(strlen($Uphone)== 10){
					$Uphone = '91'.$Uphone;
				}
				$profile[]=array('name'=>$checkUser->NAME,'rfid'=>$checkUser->EMP_CARD,'phone'=>$checkUser->PHONE,'email'=>$checkUser->EMAIL);
				#sent sms to the user
				#----SENT SMS----
				$sms = new SmsHandler();
				$sms->sms_to = $Uphone;
				$sms->content = 'Alert: '.'you have taken OUT the device name'.$getDeviceId->NAME;

				SmsHandler::SendSms($sms);
				$msg = $checkUser->NAME.' have taken OUT the device name '.$getDeviceId->NAME;	

				}
			else if($getDeviceId->STATUS == 'OUT')
				{
				$status = 'true';
				#update to IN
				DEVICEM::Update($getDeviceId->ID,'IN');
				$Uphone = $checkUser->PHONE;
					if(strlen($Uphone)== 10){
						$Uphone = '91'.$Uphone;
					}
					$profile[]=array('name'=>$checkUser->NAME,'rfid'=>$checkUser->EMP_CARD,'phone'=>$checkUser->PHONE,'email'=>$checkUser->EMAIL);
					#sent sms to the user
					#----SENT SMS----
					$sms = new SmsHandler();
					$sms->sms_to = $Uphone;
					$sms->content = 'Alert: '.'you have taken IN the device name'.$getDeviceId->NAME;

					SmsHandler::SendSms($sms);
					$msg = $checkUser->NAME.' have taken IN the device name '.$getDeviceId->NAME;
				}
			else if($getDeviceId->STATUS == 'IN')
				{
				$status = 'true';
				#update to OUT
				DEVICEM::Update($getDeviceId->ID,'OUT');
				$Uphone = $checkUser->PHONE;
					if(strlen($Uphone)== 10){
						$Uphone = '91'.$Uphone;
					}
					$profile[]=array('name'=>$checkUser->NAME,'rfid'=>$checkUser->EMP_CARD,'phone'=>$checkUser->PHONE,'email'=>$checkUser->EMAIL);
					#sent sms to the user
					#----SENT SMS----
					$sms = new SmsHandler();
					$sms->sms_to = $Uphone;
					$sms->content = 'Alert: '.'you have taken OUT the device name'.$getDeviceId->NAME;

					SmsHandler::SendSms($sms);
					$msg = $checkUser->NAME.' have taken OUT the device name '.$getDeviceId->NAME;
				}	
			else if($getDeviceId->STATUS == 'FALSE')
				{
				$status = 'true';
				#update to OUT
				DEVICEM::Update($getDeviceId->ID,'OUT');
				$Uphone = $checkUser->PHONE;
					if(strlen($Uphone)== 10){
						$Uphone = '91'.$Uphone;
					}
					$profile[]=array('name'=>$checkUser->NAME,'rfid'=>$checkUser->EMP_CARD,'phone'=>$checkUser->PHONE,'email'=>$checkUser->EMAIL);
					#sent sms to the user
					#----SENT SMS----
					$sms = new SmsHandler();
					$sms->sms_to = $Uphone;
					$sms->content = 'Alert: '.'you have taken OUT the device name'.$getDeviceId->NAME;

					SmsHandler::SendSms($sms);
					$msg = $checkUser->NAME.' have taken OUT the device name '.$getDeviceId->NAME;
				}	
				
			}
		 	
			
			
		}
		$array['success']=$status;
		$array['message']=$msg;
		$array['profile']=$profile;

		echo json_encode($array);
		
	}
}else {
    $array["success"] = "false";
    $array["message"] = "Get Request is NOT allowed";
    $array["errors"] = array("request" => "Get is NOT allowed");
    echo json_encode($array);
}//POST
		
?>