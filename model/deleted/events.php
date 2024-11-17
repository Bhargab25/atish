<?php

class EVENT_MODEL extends BaseModel {

    public $ID; // PRIMARY KEY ID
    // int primary key auto_increment,
	public $NAME; // DEVICE UNIQUE ID
    public $DESCRIPTION;
    public $BOOTHS; // USER UNIQUE ID
    // varchar(15),
    public $SERVICES; //USER ASSIGN TIME
    //varchar(30),
    public $STARTDATE;//USER RELEASE TIME
    public $ENDDATE;//'BOOKED', 'RELEASED'
    public $FLOOR_ID;
    public $STATUS;//ONGOING', 'ABORT', 'END'
  

    function __construct() {
        parent::__construct();
        //$this->examcatid=Validator::Key($keys['layout_welcome_index_label');
    }
public static function Create(EVENT_MODEL $model) {
        $mysqli = Config::OpenDBConnection();
        $query = "insert into events ({$model->__columns}) values({$model->__params})";
     $stmt = Config::CreateStatement($mysqli, $query);
    $stmt->bind_param('issssssis',$model->ID, $model->NAME, $model->DESCRIPTION, $model->BOOTHS, $model->SERVICES,$model->STARTDATE,$model->ENDDATE,$model->FLOOR_ID,$model->STATUS);
       
        $stmt->execute();
        $id = $mysqli->insert_id;
        $mysqli->close();
        return $id;
    }
public static function Update(EVENT_MODEL $model) {
         $mysqli = Config::OpenDBConnection();
        $query = "update events set `NAME`='$model->NAME', `DESCRIPTION`='$model->DESCRIPTION', `BOOTHS`='$model->BOOTHS',`SERVICES`='$model->SERVICES',`STARTDATE`='$model->STARTDATE',`ENDDATE`='$model->ENDDATE',`FLOOR_ID`='$model->FLOOR_ID',`STATUS`='$model->STATUS' where `ID`='$model->ID'";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->execute();
        $mysqli->close();
	return($model->ID);
	}    
public static function UpdateService($evid,$service) {
         $mysqli = Config::OpenDBConnection();
        $query = "update events set `SERVICES`='$service' where ID='$evid'";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->execute();
        $mysqli->close();
	return($evid);
	} 
public static function Updatebooths($evid,$booths) {
         $mysqli = Config::OpenDBConnection();
        $query = "update events set `BOOTHS`='$booths' where ID='$evid'";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->execute();
        $mysqli->close();
	return($evid);
	}     
public static function UpdateStatus($id,$status) {
         $mysqli = Config::OpenDBConnection();
        $query = "update events set `STATUS`='$status' where ID = '$id'";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->execute();
        $mysqli->close();
	//return($boothid);
	}	
public static function UpdateAbort($id,$status) {
         $mysqli = Config::OpenDBConnection();
        $today = date('Y-m-d H:i:s');
        $query = "update events set `STATUS`='ABORT',`ENDDATE`='$today' where ID = '$id'";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->execute();
        $mysqli->close();
	//return($boothid);
	}
	
public static function ReadAll() {
        $model = new EVENT_MODEL();
        $mysqli = Config::OpenDBConnection();
        $query = "select * from events order by ID DESC";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->bind_result($model->ID, $model->NAME, $model->DESCRIPTION, $model->BOOTHS, $model->SERVICES,$model->STARTDATE,$model->ENDDATE,$model->FLOOR_ID,$model->STATUS);
        $stmt->execute();
        $list = array();
        while ($stmt->fetch()) {
            $obj = new EVENT_MODEL();
            Utils::COPY_ROW_TO_OBJ($obj, $model);
            $list[$obj->ID] = $obj;
        }
        $mysqli->close();
        return $list;
    }
public static function ReadAllFreeDevices() {
        $model = new EVENT_MODEL();
        $mysqli = Config::OpenDBConnection();
        $query = "select * from events order where STATUS !='BOOKED' order by ID DESC";
        $stmt = Config::CreateStatement($mysqli, $query);
        
        $stmt->bind_result($model->ID, $model->NAME, $model->DESCRIPTION, $model->BOOTHS, $model->SERVICES,$model->STARTDATE,$model->ENDDATE,$model->FLOOR_ID,$model->STATUS);
        $stmt->execute();
        $list = array();
        while ($stmt->fetch()) {
            $obj = new EVENT_MODEL();
            Utils::COPY_ROW_TO_OBJ($obj, $model);
            $list[$obj->ID] = $obj;
        }
        $mysqli->close();
        return $list;
    }   
public static function ReadAllservices($services) {
        $model = new EVENT_MODEL();
        $mysqli = Config::OpenDBConnection();
        $query = "select * from events order where SERVICES LIKE '$services' order by ID DESC";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->bind_result($model->ID, $model->NAME, $model->DESCRIPTION, $model->BOOTHS, $model->SERVICES,$model->STARTDATE,$model->ENDDATE,$model->FLOOR_ID,$model->STATUS);
        $stmt->execute();
        $list = array();
        while ($stmt->fetch()) {
            $obj = new EVENT_MODEL();
            Utils::COPY_ROW_TO_OBJ($obj, $model);
            $list[$obj->ID] = $obj;
        }
        $mysqli->close();
        return $list;
    }  
public static function ReadAllByStatus($status) {
        $model = new EVENT_MODEL();
        $mysqli = Config::OpenDBConnection();
        $query = "select * from events order where STATUS = '$status' order by ID DESC";
        $stmt = Config::CreateStatement($mysqli, $query);
        //$stmt->bind_param('i',$eventId);
        $stmt->bind_result($model->ID, $model->NAME, $model->DESCRIPTION, $model->BOOTHS, $model->SERVICES,$model->STARTDATE,$model->ENDDATE,$model->FLOOR_ID,$model->STATUS);
        $stmt->execute();
        $list = array();
        while ($stmt->fetch()) {
            $obj = new EVENT_MODEL();
            Utils::COPY_ROW_TO_OBJ($obj, $model);
            $list[$obj->ID] = $obj;
        }
        $mysqli->close();
        return $list;
    }    
 public static function ReadSingle($id) {
        $model = new EVENT_MODEL();
        $mysqli = Config::OpenDBConnection();	
        $query = "select * from events where ID =?";
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
 public static function ReadSingleByDate($startdate) {
        $model = new EVENT_MODEL();
        $mysqli = Config::OpenDBConnection();	
        $query = "select * from events where DEVICE_ID =?";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->bind_param("i", $did);		
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
 public static function ReadSingleByboothNuser($bid) {
        $model = new EVENT_MODEL();
		  $mysqli = Config::OpenDBConnection();
		
         $query = "select * from events where (FIND_IN_SET('$bid', `BOOTHS`) > 0) and `STATUS` = 'ONGOING'";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->bind_param("i", $florid);
		
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
  public static function ReadSingleBybooth($bid) {
        $model = new EVENT_MODEL();
		  $mysqli = Config::OpenDBConnection();
		
         $query = "select * from events where (FIND_IN_SET('$bid', `BOOTHS`) > 0) and `STATUS`='ONGOING'";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->bind_param("i", $florid);
		
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
 public static function TodaysEvents() {
        $model = new EVENT_MODEL();
		  $mysqli = Config::OpenDBConnection();
		$date = date('Y-m-d');
          $query = "select * from events where '$date' BETWEEN DATE(`STARTDATE`) and DATE(`ENDDATE`)";
        $stmt = Config::CreateStatement($mysqli, $query);
        
		
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
 public static function TodaysEventsByBooth($boothid) {
        $model = new EVENT_MODEL();
		  $mysqli = Config::OpenDBConnection();
		$date = date('Y-m-d');
        $query = "select * from events where ('$date' BETWEEN DATE(`STARTDATE`) and DATE(`ENDDATE`)) and FIND_IN_SET('$boothid', `BOOTHS`) > 0";
        $stmt = Config::CreateStatement($mysqli, $query);
        
		
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

}
?>
