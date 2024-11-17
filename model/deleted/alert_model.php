<?php

class ALERT extends BaseModel {

    public $ID; // USER ID
	public $USERID; // COMPANY UNIQUE ID
	public $SMS;
    // int primary key auto_increment,
    public $EMAIL; // USER FULL NAME
    // varchar(15),
    public $PUSH; //USER EMAIL ID
    //varchar(30),
    public $CREATEDATE;
    public $MODIFIEDDATE;
    //varchar(30),
   

    function __construct() {
        parent::__construct();
        //$this->examcatid=Validator::Key($keys['layout_welcome_index_label');
    }
public static function Create(ALERT $model) {
        $mysqli = Config::OpenDBConnection();
        $query = "INSERT INTO `alert`({$model->__columns}) values(NULL,'$model->USERID','$model->SMS','$model->EMAIL','$model->PUSH','$model->CREATEDATE','$model->MODIFIEDDATE')";
	
        $stmt = Config::CreateStatement($mysqli, $query);
    
        $stmt->execute();
        $id = $mysqli->insert_id;
        $mysqli->close();
        return $id;
    }
	
public static function update(ALERT $model) {
         $mysqli = Config::OpenDBConnection();
		/// echo "update apointment set time='$time',date='$date' and status='pending' where id=$id";
        $query = "update alert set `SMS`='$model->SMS',`EMAIL`='$model->EMAIL',`PUSH`='$model->PUSH',MODIFIEDDATE='$model->MODIFIEDDATE' where ID='$model->ID'";
        $stmt = Config::CreateStatement($mysqli, $query);
       // $stmt->bind_param("ssssi",$model->DEVICE_UID,$model->DEVICE_TOKEN,$model->DEVICE_TYPE,$model->LASTACCESS,$model->ID);
        $stmt->execute();
        $mysqli->close();
	}
  
	
public static function ReadAll() {
        $model = new ALERT();
        $mysqli = Config::OpenDBConnection();
        $query = "select * from alert order by UID DESC";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->bind_result($model->ID,$model->USERID,$model->SMS,$model->EMAIL,$model->PUSH,$model->CREATEDATE,$model->MODIFIEDDATE);
        $stmt->execute();
        $list = array();
        while ($stmt->fetch()) {
            $obj = new ALERT();
            Utils::COPY_ROW_TO_OBJ($obj, $model);
            $list[$obj->CID] = $obj;
        }
        $mysqli->close();
        return $list;
    }	
 public static function ReadSingle($id) {
        $model = new ALERT();
		  $mysqli = Config::OpenDBConnection();
		
          $query = "select * from alert where USERID = ".$id;
        $stmt = Config::CreateStatement($mysqli, $query);
        //$stmt->bind_param("i", $id);
		
        $stmt->bind_result($model->ID,$model->USERID,$model->SMS,$model->EMAIL,$model->PUSH,$model->CREATEDATE,$model->MODIFIEDDATE);
		$stmt->execute();
        if ($stmt->fetch()) {
            $mysqli->close();
            return $model;
        } else {
            $mysqli->close();
            return null;
        }
		    }	
	
	public static function sendPush($regkey,$title,$body,$action,$device){
		
		if($device == 'ANDROID' || $device=='android'){
		//importing the constant files
        //require_once 'Config.php';
        define('FIREBASE_API_KEY', 'AAAA7t9HqZ8:APA91bFtGtVfHnKHOuUbCaCJV35VvGiBGrpa5AHC6oh8yutnw9Xct4bDHl86OeOtdEfuV6TsAaNTq2Dg3aHWq15yjViL_3mYsgPvZ9AIU8QeRRgM47beVP6R8eo-A3t6OgyUQI_mJmBn');
        //firebase server url to send the curl request
        $url = 'https://fcm.googleapis.com/fcm/send';
 
        //building headers for the request
        $headers = array(
            'Authorization: key=' . FIREBASE_API_KEY,
            'Content-Type: application/json'
        );
		$fields = array(
            'registration_ids' => array('0' => $regkey),
            'notification' => array('title'=>$title,'body'=>$body,'icon'=>'icon','color'=>'#00aeef','sound'=>'alarm','click_action'=>$action),
			'data' => array('title'=>$title,'body'=>$body,'icon'=>'icon','color'=>'#00aeef','sound'=>'alarm','click_action'=>$action)
			
        );
        //Initializing curl to open a connection
        $ch = curl_init();
 
        //Setting the curl url
        curl_setopt($ch, CURLOPT_URL, $url);
        
        //setting the method as post
        curl_setopt($ch, CURLOPT_POST, true);

        //adding headers 
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
 
        //disabling ssl support
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        
        //adding the fields in json format 
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
 
        //finally executing the curl request 
        $result = curl_exec($ch);
        if ($result === FALSE) {
            die('Curl failed: ' . curl_error($ch));
        }
 
        //Now close the connection
        curl_close($ch);
 
        //and return the result 
        return  $result;
	
				
		
	}
        if($device == 'Ios' || $device=='IOS'){
            $token = $regkey;
// Create a stream to the server
$apnsHost = 'gateway.sandbox.push.apple.com';
$apnsPort = 2195;
$apnsCert = 'ihub.pem';

$streamContext = stream_context_create();
stream_context_set_option($streamContext, 'ssl', 'local_cert', $apnsCert);


$apns = stream_socket_client(
    'ssl://gateway.sandbox.push.apple.com:2195',
    $error,
    $errorString,
    60,
    STREAM_CLIENT_CONNECT,
    $streamContext
);



// You can access the errors using the variables $error and $errorString
$message = $body;
// Now we need to create JSON which can be sent to APNS
$load = array(
'aps' => array(
'alert' => $message,
'appid' => 0,
'badge' => 1,
'sound' => 'default'
)
);
$payload = json_encode($load);
// The payload needs to be packed before it can be sent

$apnsMessage = chr(0) . chr(0) . chr(32);
$apnsMessage .= pack('H*', str_replace(' ', '', $token));
$apnsMessage .= chr(0) . chr(strlen($payload)) . $payload;
 
// Write the payload to the APNS
fwrite($apns, $apnsMessage);
return $payload;
 
// Close the connection
fclose($apns);
		
			

        
    }
    }
    
public static function subscribe_sms($protocol,$endpoint,$topic){
                    $protocol = $protocol;//SMS or EMAIL
                    $endpoint = $endpoint; // phone number with country code or email id
                    $topicArn = $topic;

                    try {
                    $result1 = $sns->subscribe([
                    'Protocol' => $protocol,
                    'Endpoint' => $endpoint,
                    'ReturnSubscriptionArn' => true,
                    'TopicArn' => $topicArn,
                    ]);
                    print_r($result1);
                    } catch (AwsException $e) {
                    // output error message if fails
                    error_log($e->getMessage());
                    } 
    
}    
    
	
	

}
?>
