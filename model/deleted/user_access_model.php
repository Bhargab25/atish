<?php

class USR_Access_Model extends BaseModel {
	public $ID;
    public $USERID; // USER ID
	public $U_CID; // COMPANY UNIQUE ID
    // int primary key auto_increment,
    public $USERNAME; // USER FULL NAME
    // varchar(15),
    public $PASSWORD; //USER EMAIL ID
    //varchar(30),
    public $LAST_LOGIN;
    //varchar(30),
    public $LAST_LOGOUT;
	
	public $LOGIN_PLATFORM;
	public $KEY;
	

    //id ,    restaurantname ,    contactname ,    address ,    contactphone ,    loginid ,    password ,    lastlogin ,    isactive



    function __construct() {
        parent::__construct();
        //$this->examcatid=Validator::Key($keys['layout_welcome_index_label');
    }
public static function Create(USR_Access_Model $USR_Access_Model) {
        $mysqli = Config::OpenDBConnection();
        $query = "INSERT INTO `user_access`(`ID`,`USERID`, `U_CID`, `USERNAME`, `PASSWORD`, `LAST_LOGIN`, `LAST_LOGOUT`, `LOGIN_PLATFORM`,`KEY`) values(NULL,'$USR_Access_Model->USERID','$USR_Access_Model->U_CID','$USR_Access_Model->USERNAME','$USR_Access_Model->PASSWORD','$USR_Access_Model->LAST_LOGIN','$USR_Access_Model->LAST_LOGOUT','$USR_Access_Model->LOGIN_PLATFORM','$USR_Access_Model->KEY')";
	
        $stmt = Config::CreateStatement($mysqli, $query);
    
        $stmt->execute();
        $id = $mysqli->insert_id;
        $mysqli->close();
        return $id;
    }
	
public static function update($USERNAME) {
         $mysqli = Config::OpenDBConnection();
		/// echo "update apointment set time='$time',date='$date' and status='pending' where id=$id";
        $query = "update user_access set LAST_LOGIN=?,LAST_LOGOUT=? where USERNAME=?";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->bind_param("sss",$time,$date,$USERNAME);
        $stmt->execute();
        $mysqli->close();
	}
  
	
public static function ReadAll() {
        $model = new USR_Access_Model();
        $mysqli = Config::OpenDBConnection();
        $query = "select * from user_access order by UID DESC";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->bind_result($model->ID,$model->USERID, $model->U_CID, $model->USERNAME, $model->PASSWORD, $model->LAST_LOGIN,$model->LAST_LOGOUT,$model->LAST_LOGIN,$model->KEY);
        $stmt->execute();
        $list = array();
        while ($stmt->fetch()) {
            $obj = new USR_Access_Model();
            Utils::COPY_ROW_TO_OBJ($obj, $model);
            $list[$obj->CID] = $obj;
        }
        $mysqli->close();
        return $list;
    }	
public static function ReadAllByUID($uid) {
        $model = new USR_Access_Model();
        $mysqli = Config::OpenDBConnection();
        $query = "select * from user_access where `USERID`='$uid' order by DATE(LAST_LOGIN) DESC LIMIT 0,10";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->bind_result($model->ID,$model->USERID, $model->U_CID, $model->USERNAME, $model->PASSWORD, $model->LAST_LOGIN,$model->LAST_LOGOUT,$model->LOGIN_PLATFORM,$model->KEY);
        $stmt->execute();
        $list = array();
        while ($stmt->fetch()) {
            $obj = new USR_Access_Model();
            Utils::COPY_ROW_TO_OBJ($obj, $model);
            $list[] = $obj;
        }
        $mysqli->close();
        return $list;
    }	
public static function ReadAllByUID_date($uid,$date) {
        $model = new USR_Access_Model();
        $mysqli = Config::OpenDBConnection();
        $query = "select * from user_access where `USERID`='$uid' and DATE(LAST_LOGIN)=DATE('$date') order by DATE(LAST_LOGIN) DESC";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->bind_result($model->ID,$model->USERID, $model->U_CID, $model->USERNAME, $model->PASSWORD, $model->LAST_LOGIN,$model->LAST_LOGOUT,$model->LOGIN_PLATFORM,$model->KEY);
        $stmt->execute();
        $list = array();
        while ($stmt->fetch()) {
            $obj = new USR_Access_Model();
            Utils::COPY_ROW_TO_OBJ($obj, $model);
            $list[] = $obj;
        }
        $mysqli->close();
        return $list;
    }	
	

public static function ReadAllByUID_list($uid) {
        $model = new USR_Access_Model();
        $mysqli = Config::OpenDBConnection();
        $query = "select * from user_access where `USERID`='$uid' order by DATE(LAST_LOGIN) DESC";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->bind_result($model->ID,$model->USERID, $model->U_CID, $model->USERNAME, $model->PASSWORD, $model->LAST_LOGIN,$model->LAST_LOGOUT,$model->LOGIN_PLATFORM,$model->KEY);
        $stmt->execute();
        $list = array();
        while ($stmt->fetch()) {
            $obj = new USR_Access_Model();
            Utils::COPY_ROW_TO_OBJ($obj, $model);
            $list[] = $obj;
        }
        $mysqli->close();
        return $list;
    }	    
 public static function ReadSingle($id) {
	 //echo $id;
        $model = new USR_Access_Model();
		  $mysqli = Config::OpenDBConnection();
		
         $query = "select * from user_access where ID =".$id;
        $stmt = Config::CreateStatement($mysqli, $query);
        //$stmt->bind_param("i", $id);
		
        $stmt->bind_result($model->ID,$model->USERID, $model->U_CID, $model->USERNAME, $model->PASSWORD, $model->LAST_LOGIN,$model->LAST_LOGOUT,$model->LAST_LOGIN,$model->KEY);
		$stmt->execute();
        if ($stmt->fetch()) {
            $mysqli->close();
            return $model;
        } else {
            $mysqli->close();
            return null;
        }
		    
 }
    
    public static function ReadSingleBykeyNuid($uid,$key) {
	 //echo $id;
        $model = new USR_Access_Model();
		  $mysqli = Config::OpenDBConnection();
		
         $query = "select * from user_access where USERID =".$uid." and `KEY`='$key'";
        $stmt = Config::CreateStatement($mysqli, $query);
        //$stmt->bind_param("i", $id);
		
        $stmt->bind_result($model->ID,$model->USERID, $model->U_CID, $model->USERNAME, $model->PASSWORD, $model->LAST_LOGIN,$model->LAST_LOGOUT,$model->LAST_LOGIN,$model->KEY);
		$stmt->execute();
        if ($stmt->fetch()) {
            $mysqli->close();
            return $model;
        } else {
            $mysqli->close();
            return null;
        }
		    
 }
    
	public static function ReadSingleByUname($username) {
	 //echo $username;
        $model = new USR_Access_Model();
		  $mysqli = Config::OpenDBConnection();
		
         $query = "select * from user_access where USERNAME =?";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->bind_param("s", $username);
		
        $stmt->bind_result($model->ID,$model->USERID, $model->U_CID, $model->USERNAME, $model->PASSWORD, $model->LAST_LOGIN,$model->LAST_LOGOUT,$model->LAST_LOGIN,$model->KEY);
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
        $query = "delete from user_access where USERID=?";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $mysqli->close();
    }

}
?>
