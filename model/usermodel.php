<?php

class usermodel extends BaseModel {

    public $uid; 
	public $name; 
    public $userid;
    public $role; 
	public $mobile; 
    public $email; 
    public $password;
    public $sign;
	public $lastlogin_time;
	public $lastlogin_from;
	public $is_logedin;
    public $status;
	

 

    function __construct() {
        parent::__construct();
        //$this->examcatid=Validator::Key($keys['layout_welcome_index_label');
    }
public static function Create(usermodel $usermodel) {
        $mysqli = Config::OpenDBConnection();
        $query = "INSERT INTO `appuser`(`name`,`userid`, `mobile`, `email`, `password`, `role`, `sign`, `status`, `is_logedin`) values('$usermodel->name','$usermodel->userid','$usermodel->mobile','$usermodel->email','$usermodel->password','$usermodel->role','$usermodel->sign','$usermodel->status','$usermodel->is_logedin')";	
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->execute();
        $id = $mysqli->insert_id;
        $mysqli->close();
        return $id;
    }
	
public static function Update(usermodel $usermodel) {
        $mysqli = Config::OpenDBConnection();
        $query = "update appuser set name='$usermodel->name',userid='$usermodel->userid',mobile='$usermodel->mobile',email='$usermodel->email',role='$usermodel->role',sign='$usermodel->sign' where uid='$usermodel->uid'";
        $stmt = Config::CreateStatement($mysqli, $query);
     //   $stmt->bind_param("sssi",$usermodel->ENAME,$usermodel->PHONE,$usermodel->PASSWORD,$usermodel->UID);
        $stmt->execute();
        $mysqli->close();
	return($usermodel->uid);
	}
	
	
	
public static function LoginUser(usermodel $m) {
        $model = new usermodel();
        $mysqli = Config::OpenDBConnection();
        $query = "select * from `appuser` where  userid='$m->userid' and password='$m->password' and status=1";
        $stmt = Config::CreateStatement($mysqli, $query);
       // $stmt->bind_param("ss", $m->EMAIL, $m->PASSWORD);
        $stmt->bind_result($model->uid, $model->name, $model->mobile,$model->email, $model->password, $model->role,$model->sign,$model->status,$model->is_logedin,$model->lastlogin_time,$model->lastlogin_from,$model->userid);
        $stmt->execute();
        if ($stmt->fetch()) {
            $mysqli->close();
            return($model);
        } else {
            $mysqli->close();
            return null;
        }
    }

  public static function ChangePassword($password, $id) {
        $mysqli = Config::OpenDBConnection();
        $query = "update appuser set password =? where uid=?";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->bind_param("si", $password, $id);
        $stmt->execute();
        $mysqli->close();
    }
	
public static function ReadAll() {
        $model = new usermodel();
        $mysqli = Config::OpenDBConnection();
        $query = "select * from appuser order by uid DESC";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->bind_result($model->uid, $model->name, $model->mobile,$model->email, $model->password, $model->role,$model->sign,$model->status,$model->is_logedin,$model->lastlogin_time,$model->lastlogin_from,$model->userid);
        $stmt->execute();
        $list = array();
        while ($stmt->fetch()) {
            $obj = new usermodel();
            Utils::COPY_ROW_TO_OBJ($obj, $model);
            $list[$obj->uid] = $obj;
        }
        $mysqli->close();
        return $list;
    }


 public static function ReadSingle($id) {
        $model = new usermodel();
		  $mysqli = Config::OpenDBConnection();
        $query = "select * from appuser where uid ='$id'";
        $stmt = Config::CreateStatement($mysqli, $query);
         //  $stmt->bind_param("i", $id);
        $stmt->bind_result($model->uid, $model->name, $model->mobile,$model->email, $model->password, $model->role,$model->sign,$model->status,$model->is_logedin,$model->lastlogin_time,$model->lastlogin_from,$model->userid);
		$stmt->execute();
        if ($stmt->fetch()) {
            $mysqli->close();
            return($model);
        } else {
            $mysqli->close();
            return null;
        }
		    }	
public static function ReadSingleById($id) {
        $model = new usermodel();
		$mysqli = Config::OpenDBConnection();
        $query = "SELECT * FROM appuser WHERE userid =?";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->bind_param("s", $id);
        $stmt->bind_result($model->uid, $model->name, $model->mobile,$model->email, $model->password, $model->role,$model->sign,$model->status,$model->is_logedin,$model->lastlogin_time,$model->lastlogin_from,$model->userid);
		$stmt->execute();
        if ($stmt->fetch()) {
            $mysqli->close();
            return $model;
        } else {
            $mysqli->close();
            return null;
        }
}
   
public static function Delete($id) {
        $mysqli = Config::OpenDBConnection();
        $query = "delete from appuser where uid=?";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->bind_param("s", $id);
        $stmt->execute();
        $mysqli->close();
}

public static function Deactivate($id) {
        $mysqli = Config::OpenDBConnection();
        $query = "UPDATE appuser SET status=0 WHERE uid=?";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->bind_param("s", $id);
        $stmt->execute();
        $mysqli->close();
} 
    
public static function Activate($id) {
        $mysqli = Config::OpenDBConnection();
        $query = "UPDATE appuser SET status=1 WHERE uid=?";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->bind_param("s", $id);
        $stmt->execute();
        $mysqli->close();
}  
    
public static function CheckInternet()
{
    $connected = @fsockopen("www.google.com", 80); 
    //website, port  (try 80 or 443)
    if ($connected){
        $is_conn = true; //action when connected
        fclose($connected);
    }else{
        $is_conn = false; //action in connection failure
    }
    return $is_conn;
} 
    
public static function callAPI($method, $url, $data){
   $curl = curl_init();
 	curl_setopt($curl, CURLOPT_POST, 1);
	curl_setopt($curl, CURLOPT_POSTFIELDS, $data);	
   

   // OPTIONS:
   curl_setopt($curl, CURLOPT_URL, $url);
   curl_setopt($curl, CURLOPT_HTTPHEADER, array(
      'token: b09a6938faa91b069dee62c377cf1232',
      'Content-Type: application/x-www-form-urlencoded',
   ));
   curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
   curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);

   // EXECUTE:
   $result = curl_exec($curl);
   if(!$result){die("Connection Failure");}
   curl_close($curl);
   return $result;
}    

}
?>
