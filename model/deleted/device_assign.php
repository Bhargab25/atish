<?php

class DEVICE_ASSIGN_MODEL extends BaseModel {

    public $ID; // PRIMARY KEY ID
    // int primary key auto_increment,
	public $DEVICE_ID; // DEVICE UNIQUE ID
    public $EVENT_ID;
    public $ASSIGN_TO; // USER UNIQUE ID
    // varchar(15),
    public $ASSIGN_DATETIME; //USER ASSIGN TIME
    //varchar(30),
    public $RELEASE_DATETIME;//USER RELEASE TIME
    public $STATUS;//'BOOKED', 'RELEASED'

    function __construct() {
        parent::__construct();
        //$this->examcatid=Validator::Key($keys['layout_welcome_index_label');
    }
public static function Create(DEVICE_ASSIGN_MODEL $model) {
        $mysqli = Config::OpenDBConnection();
        $query = "insert into device_assign ({$model->__columns}) values('NULL', '$model->DEVICE_ID', '$model->EVENT_ID', '$model->ASSIGN_TO', '$model->ASSIGN_DATETIME','$model->RELEASE_DATETIME','$model->STATUS')";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->execute();
        $id = $mysqli->insert_id;
        $mysqli->close();
        return $id;
    }
public static function Release($did,$userid,$eventId) {
         $mysqli = Config::OpenDBConnection();
        $query = "update device_assign set `STATUS`='RELEASED' where DEVICE_ID = '$did' and ASSIGN_TO='$userid' and EVENT_ID = '$eventId'";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->execute();
        $mysqli->close();
	return($boothid);
	}	

	
public static function ReadAll() {
        $model = new DEVICE_ASSIGN_MODEL();
        $mysqli = Config::OpenDBConnection();
        $query = "select * from device_assign order by ID DESC";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->bind_result($model->ID, $model->DEVICE_ID, $model->EVENT_ID, $model->ASSIGN_TO, $model->ASSIGN_DATETIME,$model->RELEASE_DATETIME,$model->STATUS);
        $stmt->execute();
        $list = array();
        while ($stmt->fetch()) {
            $obj = new DEVICE_ASSIGN_MODEL();
            Utils::COPY_ROW_TO_OBJ($obj, $model);
            $list[$obj->ID] = $obj;
        }
        $mysqli->close();
        return $list;
    }
public static function ReadAllFreeDevices() {
        $model = new DEVICE_ASSIGN_MODEL();
        $mysqli = Config::OpenDBConnection();
        $query = "select * from device_assign  where STATUS !='BOOKED' order by ID DESC";
        $stmt = Config::CreateStatement($mysqli, $query);
        
        $stmt->bind_result($model->ID, $model->DEVICE_ID, $model->EVENT_ID, $model->ASSIGN_TO, $model->ASSIGN_DATETIME,$model->RELEASE_DATETIME,$model->STATUS);
        $stmt->execute();
        $list = array();
        while ($stmt->fetch()) {
            $obj = new DEVICE_ASSIGN_MODEL();
            Utils::COPY_ROW_TO_OBJ($obj, $model);
            $list[$obj->ID] = $obj;
        }
        $mysqli->close();
        return $list;
    }   
public static function ReadAllEvent($eventId) {
        $model = new DEVICE_ASSIGN_MODEL();
        $mysqli = Config::OpenDBConnection();
        $query = "select * from device_assign order where EVENT_ID =? order by ID DESC";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->bind_param('i',$eventId);
        $stmt->bind_result($model->ID, $model->DEVICE_ID, $model->EVENT_ID, $model->ASSIGN_TO, $model->ASSIGN_DATETIME,$model->RELEASE_DATETIME,$model->STATUS);
        $stmt->execute();
        $list = array();
        while ($stmt->fetch()) {
            $obj = new DEVICE_ASSIGN_MODEL();
            Utils::COPY_ROW_TO_OBJ($obj, $model);
            $list[$obj->ID] = $obj;
        }
        $mysqli->close();
        return $list;
    }  
    
public static function ReadAllBookDeviceByUser($userid) {
        $model = new DEVICE_ASSIGN_MODEL();
        $mysqli = Config::OpenDBConnection();
        $query = "select * from device_assign  where ASSIGN_TO =? and STATUS='RELEASED' order by ID DESC";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->bind_param('i',$userid);
        $stmt->bind_result($model->ID, $model->DEVICE_ID, $model->EVENT_ID, $model->ASSIGN_TO, $model->ASSIGN_DATETIME,$model->RELEASE_DATETIME,$model->STATUS);
        $stmt->execute();
        $list = array();
        while ($stmt->fetch()) {
            $obj = new DEVICE_ASSIGN_MODEL();
            Utils::COPY_ROW_TO_OBJ($obj, $model);
            $list[$obj->ID] = $obj;
        }
        $mysqli->close();
        return $list;
    }      
    
 public static function ReadSingle($id) {
        $model = new DEVICE_ASSIGN_MODEL();
        $mysqli = Config::OpenDBConnection();	
        $query = "select * from device_assign where ID =$id";
        $stmt = Config::CreateStatement($mysqli, $query);
       // $stmt->bind_param("i", $id);		
        $stmt->bind_result($model->ID, $model->DEVICE_ID, $model->EVENT_ID, $model->ASSIGN_TO, $model->ASSIGN_DATETIME,$model->RELEASE_DATETIME,$model->STATUS);
		$stmt->execute();
        if ($stmt->fetch()) {
            $mysqli->close();
            return $model;
        } else {
            $mysqli->close();
            return null;
        }
		    }
 public static function ReadSingleByDevice($did) {
        $model = new DEVICE_ASSIGN_MODEL();
        $mysqli = Config::OpenDBConnection();	
        $query = "select * from device_assign where DEVICE_ID =?";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->bind_param("i", $did);		
        $stmt->bind_result($model->ID, $model->DEVICE_ID, $model->EVENT_ID, $model->ASSIGN_TO, $model->ASSIGN_DATETIME,$model->RELEASE_DATETIME,$model->STATUS);
		$stmt->execute();
        if ($stmt->fetch()) {
            $mysqli->close();
            return $model;
        } else {
            $mysqli->close();
            return null;
        }
		    }    
 public static function ReadSingleByUser($userid) {
        $model = new DEVICE_ASSIGN_MODEL();
		  $mysqli = Config::OpenDBConnection();
		
         $query = "select * from device_assign where ASSIGN_TO =?";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->bind_param("i", $userid);
		
        $stmt->bind_result($model->ID, $model->DEVICE_ID, $model->EVENT_ID, $model->ASSIGN_TO, $model->ASSIGN_DATETIME,$model->RELEASE_DATETIME,$model->STATUS);
		$stmt->execute();
        if ($stmt->fetch()) {
            $mysqli->close();
            return $model;
        } else {
            $mysqli->close();
            return null;
        }
		    }    
public static function ReadSingleByUserDevice($userid,$did) {
        $model = new DEVICE_ASSIGN_MODEL();
		  $mysqli = Config::OpenDBConnection();
		
         $query = "select * from device_assign where ASSIGN_TO =?";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->bind_param("i", $userid);
		
        $stmt->bind_result($model->ID, $model->DEVICE_ID, $model->EVENT_ID, $model->ASSIGN_TO, $model->ASSIGN_DATETIME,$model->RELEASE_DATETIME,$model->STATUS);
		$stmt->execute();
        if ($stmt->fetch()) {
            $mysqli->close();
            return $model;
        } else {
            $mysqli->close();
            return null;
        }
		    }	

}
?>
