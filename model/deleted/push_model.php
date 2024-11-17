<?php

class PUSH extends BaseModel {

    public $ID; // USER ID
	public $USERID; // COMPANY UNIQUE ID
	public $DEVICE_UID;
    // int primary key auto_increment,
    public $DEVICE_TOKEN; // USER FULL NAME
    // varchar(15),
    public $DEVICE_TYPE; //USER EMAIL ID
    //varchar(30),
    public $LASTACCESS;
    //varchar(30),
   
	

    //id ,    restaurantname ,    contactname ,    address ,    contactphone ,    loginid ,    password ,    lastlogin ,    isactive



    function __construct() {
        parent::__construct();
        //$this->examcatid=Validator::Key($keys['layout_welcome_index_label');
    }
public static function Create(PUSH $model) {
        $mysqli = Config::OpenDBConnection();
        $query = "INSERT INTO `push`(`ID`, `USERID`,`DEVICE_UID`, `DEVICE_TOKEN`, `DEVICE_TYPE`, `LASTACCESS`) values('$model->ID','$model->USERID','$model->DEVICE_UID','$model->DEVICE_TOKEN','$model->DEVICE_TYPE','$model->LASTACCESS')";
	
        $stmt = Config::CreateStatement($mysqli, $query);
    
        $stmt->execute();
        $id = $mysqli->insert_id;
        $mysqli->close();
        return $id;
    }
	
public static function update($token,$userid,$duid) {
         $mysqli = Config::OpenDBConnection();
		/// echo "update apointment set time='$time',date='$date' and status='pending' where id=$id";
        $query = "update user_access set DEVICE_TOKEN=?,LASTACCESS=? where USERID=? and DEVICE_UID=?";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->bind_param("sis",$token,$userid,$duid);
        $stmt->execute();
        $mysqli->close();
	}
  
	
public static function ReadAll() {
        $model = new PUSH();
        $mysqli = Config::OpenDBConnection();
        $query = "select * from push order by UID DESC";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->bind_result($model->ID,$model->USERID,$model->DEVICE_UID,$model->DEVICE_TOKEN,$model->DEVICE_TYPE,$model->LASTACCESS);
        $stmt->execute();
        $list = array();
        while ($stmt->fetch()) {
            $obj = new PUSH();
            Utils::COPY_ROW_TO_OBJ($obj, $model);
            $list[$obj->CID] = $obj;
        }
        $mysqli->close();
        return $list;
    }	
 public static function ReadSingle($id) {
        $model = new PUSH();
		  $mysqli = Config::OpenDBConnection();
		
         $query = "select * from push where USERID =?";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->bind_param("i", $id);
		
        $stmt->bind_result($model->ID,$model->USERID,$model->DEVICE_UID,$model->DEVICE_TOKEN,$model->DEVICE_TYPE,$model->LASTACCESS);
		$stmt->execute();
        if ($stmt->fetch()) {
            $mysqli->close();
            return $model;
        } else {
            $mysqli->close();
            return null;
        }
		    }	
	
	public static function ReadSingleByDeviceNUsr($uid,$duid) {
        $model = new PUSH();
		  $mysqli = Config::OpenDBConnection();
		
         $query = "select * from push where USERID =? and DEVICE_UID=?";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->bind_param("is", $uid,$duid);
		
        $stmt->bind_result($model->ID,$model->USERID,$model->DEVICE_UID,$model->DEVICE_TOKEN,$model->DEVICE_TYPE,$model->LASTACCESS);
		$stmt->execute();
        if ($stmt->fetch()) {
            $mysqli->close();
            return $model;
        } else {
            $mysqli->close();
            return null;
        }
		    }	
	
	public static function sendPush_tab($regkey,$title,$body,$action){
		
		
		//importing the constant files
        //require_once 'Config.php';
        define('FIREBASE_API_KEY', 'AAAApzWSVI0:APA91bEDzPithqy917xw51IvYK01m-3c3TLJfqISpZelAWMDsGXM5HbJWrcH6YhRnppOd3xa8GPQdoPpvTsEKqs7fMt-myLnKi4lHqCP0Vlw6SHAr_zDyjlrqqVHDRC-Y0ETeRb6DM0p');
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
	
	

}
?>
