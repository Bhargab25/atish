<?php

class INVITE_MODEL extends BaseModel {

    public $ID; // PRIMARY KEY ID
    // int primary key auto_increment,
	public $USERID; // USER UNIQUE ID
    public $EVENTID;// EVENT UID
    public $ACCESSCODE; // USER UNIQUE ID
    // varchar(15),
    public $STATUS; //USER ASSIGN TIME
    //varchar(30),
    public $CREATEDATE;//USER RELEASE TIME
    public $ISACTIVE;//'BOOKED', 'RELEASED'
    

    function __construct() {
        parent::__construct();
        //$this->examcatid=Validator::Key($keys['layout_welcome_index_label');
    }
public static function Create(INVITE_MODEL $model) {
        $mysqli = Config::OpenDBConnection();
        $query = "insert into invities ({$model->__columns}) values({$model->__params})";
        $stmt = Config::CreateStatement($mysqli, $query);
    $stmt->bind_param('iiisssi',$model->ID, $model->USERID, $model->EVENTID, $model->ACCESSCODE, $model->STATUS,$model->CREATEDATE,$model->ISACTIVE);
        $stmt->execute();
        $id = $mysqli->insert_id;
        $mysqli->close();
        return $id;
    }

public static function UpdateStatus(INVITE_MODEL $model) {
         $mysqli = Config::OpenDBConnection();
        $query = "update `invities` set `STATUS`='$model->STATUS',`CREATEDATE`='$model->CREATEDATE' where ID ='$model->ID'";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->execute();
        $mysqli->close();
	//return($boothid);
	}

	
public static function ReadAll() {
        $model = new INVITE_MODEL();
        $mysqli = Config::OpenDBConnection();
      
        $query = "select * from invities order by ID DESC";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->bind_result($model->ID, $model->USERID, $model->EVENTID, $model->ACCESSCODE, $model->STATUS,$model->CREATEDATE,$model->ISACTIVE);
        $stmt->execute();
        $list = array();
        while ($stmt->fetch()) {
            $obj = new INVITE_MODEL();
            Utils::COPY_ROW_TO_OBJ($obj, $model);
            $list[$obj->ID] = $obj;
        }
        $mysqli->close();
        return $list;
    }
public static function ReadAllActive() {
        $model = new INVITE_MODEL();
        $mysqli = Config::OpenDBConnection();
        $query = "select * from invities  where ISACTIVE !='1' order by ID DESC";
        $stmt = Config::CreateStatement($mysqli, $query);
        
        $stmt->bind_result($model->ID, $model->USERID, $model->EVENTID, $model->ACCESSCODE, $model->STATUS,$model->CREATEDATE,$model->ISACTIVE);
        $stmt->execute();
        $list = array();
        while ($stmt->fetch()) {
            $obj = new INVITE_MODEL();
            Utils::COPY_ROW_TO_OBJ($obj, $model);
            $list[$obj->ID] = $obj;
        }
        $mysqli->close();
        return $list;
    }   
public static function ReadAlluser($user) {
        $model = new INVITE_MODEL();
        $mysqli = Config::OpenDBConnection();
        $query = "select * from invities  where USERID='$user' order by ID DESC";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->bind_result($model->ID, $model->USERID, $model->EVENTID, $model->ACCESSCODE, $model->STATUS,$model->CREATEDATE,$model->ISACTIVE);
        $stmt->execute();
        $list = array();
        while ($stmt->fetch()) {
            $obj = new INVITE_MODEL();
            Utils::COPY_ROW_TO_OBJ($obj, $model);
            $list[$obj->ID] = $obj;
        }
        $mysqli->close();
        return $list;
    } 
public static function ReadAlluser_attended($user) {
        $model = new INVITE_MODEL();
        $mysqli = Config::OpenDBConnection();
        $query = "select * from invities  where USERID='$user' and `STATUS`='INTERESTED' order by ID DESC";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->bind_result($model->ID, $model->USERID, $model->EVENTID, $model->ACCESSCODE, $model->STATUS,$model->CREATEDATE,$model->ISACTIVE);
        $stmt->execute();
        $list = array();
        while ($stmt->fetch()) {
            $obj = new INVITE_MODEL();
            Utils::COPY_ROW_TO_OBJ($obj, $model);
            $list[$obj->ID] = $obj;
        }
        $mysqli->close();
        return $list;
    }     
public static function ReadAllByEvent($eventId) {
        $model = new INVITE_MODEL();
        $mysqli = Config::OpenDBConnection();
        $query = "select * from invities  where EVENTID='$eventId' and (`STATUS`='INTERESTED' OR `STATUS`='MAYBE') order by ID DESC";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->bind_result($model->ID, $model->USERID, $model->EVENTID, $model->ACCESSCODE, $model->STATUS,$model->CREATEDATE,$model->ISACTIVE);
        $stmt->execute();
        $list = array();
        while ($stmt->fetch()) {
            $obj = new INVITE_MODEL();
            Utils::COPY_ROW_TO_OBJ($obj, $model);
            $list[$obj->ID] = $obj;
        }
        $mysqli->close();
        return $list;
    }  
public static function ReadAllByEvnt($eventId) {
        $model = new INVITE_MODEL();
        $mysqli = Config::OpenDBConnection();
        $query = "select * from invities  where EVENTID='$eventId' order by ID DESC";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->bind_result($model->ID, $model->USERID, $model->EVENTID, $model->ACCESSCODE, $model->STATUS,$model->CREATEDATE,$model->ISACTIVE);
        $stmt->execute();
        $list = array();
        while ($stmt->fetch()) {
            $obj = new INVITE_MODEL();
            Utils::COPY_ROW_TO_OBJ($obj, $model);
            $list[$obj->ID] = $obj;
        }
        $mysqli->close();
        return $list;
    }     
public static function ReadAllByStatus($status) {
        $model = new INVITE_MODEL();
        $mysqli = Config::OpenDBConnection();
        $query = "select * from invities order where STATUS = '$status' order by ID DESC";
        $stmt = Config::CreateStatement($mysqli, $query);
        //$stmt->bind_param('i',$eventId);
        $stmt->bind_result($model->ID, $model->USERID, $model->EVENTID, $model->ACCESSCODE, $model->STATUS,$model->CREATEDATE,$model->ISACTIVE);
        $stmt->execute();
        $list = array();
        while ($stmt->fetch()) {
            $obj = new INVITE_MODEL();
            Utils::COPY_ROW_TO_OBJ($obj, $model);
            $list[$obj->ID] = $obj;
        }
        $mysqli->close();
        return $list;
    }    
 public static function ReadSingle($id) {
        $model = new INVITE_MODEL();
        $mysqli = Config::OpenDBConnection();	
        $query = "select * from invities where ID =?";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->bind_param("i", $id);		
        $stmt->bind_result($model->ID, $model->NAME, $model->DESCRIPTION, $model->BOOTHS, $model->SERVICES,$model->STARTDATE,$model->ENDDATE,$model->FLOOR_ID,$model->STATUS);
		$stmt->execute();
        if ($stmt->fetch()) {
            $mysqli->close();
            return $model;
        } else {
            $mysqli->close();
            return null;
        }
		    }
    
 public static function ReadSingleByEvent($eid) {
        $model = new INVITE_MODEL();
        $mysqli = Config::OpenDBConnection();	
        $query = "select * from invities where EVENTID =?";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->bind_param("i", $eid);		
        $stmt->bind_result($model->ID, $model->USERID, $model->EVENTID, $model->ACCESSCODE, $model->STATUS,$model->CREATEDATE,$model->ISACTIVE);
		$stmt->execute();
        if ($stmt->fetch()) {
            $mysqli->close();
            return $model;
        } else {
            $mysqli->close();
            return null;
        }
		    }  
 public static function ReadSingleByEventNUser($eid,$uid) {
        $model = new INVITE_MODEL();
        $mysqli = Config::OpenDBConnection();	
        $query = "select * from invities where EVENTID =? and USERID=?";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->bind_param("ii", $eid,$uid);		
        $stmt->bind_result($model->ID, $model->USERID, $model->EVENTID, $model->ACCESSCODE, $model->STATUS,$model->CREATEDATE,$model->ISACTIVE);
		$stmt->execute();
        if ($stmt->fetch()) {
            $mysqli->close();
            return $model;
        } else {
            $mysqli->close();
            return null;
        }
		    }     
    
 public static function ReadSingleByDate($startdate) {
        $model = new INVITE_MODEL();
        $mysqli = Config::OpenDBConnection();	
        $query = "select * from invities where DEVICE_ID =?";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->bind_param("i", $did);		
        $stmt->bind_result($model->ID, $model->USERID, $model->EVENTID, $model->ACCESSCODE, $model->STATUS,$model->CREATEDATE,$model->ISACTIVE);
		$stmt->execute();
        if ($stmt->fetch()) {
            $mysqli->close();
            return $model;
        } else {
            $mysqli->close();
            return null;
        }
		    }    
 public static function ReadSingleByfloor($florid) {
        $model = new INVITE_MODEL();
		  $mysqli = Config::OpenDBConnection();
		
         $query = "select * from invities where FLOOR_ID =?";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->bind_param("i", $florid);
		
        $stmt->bind_result($model->ID, $model->USERID, $model->EVENTID, $model->ACCESSCODE, $model->STATUS,$model->CREATEDATE,$model->ISACTIVE);
		$stmt->execute();
        if ($stmt->fetch()) {
            $mysqli->close();
            return $model;
        } else {
            $mysqli->close();
            return null;
        }
		    }   
    
 public static function Todaysinvities() {
        $model = new INVITE_MODEL();
		  $mysqli = Config::OpenDBConnection();
		$date = date('Y-m-d');
         $query = "select * from invities where DATE(STARTDATE) ='$date'";
        $stmt = Config::CreateStatement($mysqli, $query);
        
		
        $stmt->bind_result($model->ID, $model->USERID, $model->EVENTID, $model->ACCESSCODE, $model->STATUS,$model->CREATEDATE,$model->ISACTIVE);
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
