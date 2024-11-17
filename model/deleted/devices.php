<?php

class DEVICE_MODEL extends BaseModel {

    public $ID; // PRIMARY KEY ID
    // int primary key auto_increment,
	public $NAME; // USER UNIQUE ID
    
    public $SERIAL_No; // USER FULL NAME
    public $TYPE;//IPAD or TAB
    // varchar(15),
    public $CREATEDATE; //USER EMAIL ID
    //varchar(30),
    public $ISACTIVE;
  

    function __construct() {
        parent::__construct();
        //$this->examcatid=Validator::Key($keys['layout_welcome_index_label');
    }
public static function Create(DEVICE_MODEL $model) {
        $mysqli = Config::OpenDBConnection();
        $query = "insert into devices ({$model->__columns}) values(NULL,'$model->NAME','$model->SERIAL_No','$model->TYPE','$model->CREATEDATE','$model->ISACTIVE')";//{$model->__params}
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->execute();
        $id = $mysqli->insert_id;
        $mysqli->close();
        return $id;
    }
	public static function Delete($did) {
         $mysqli = Config::OpenDBConnection();
        $query = "DELETE FROM devices where ID='$did'";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->execute();
        $mysqli->close();
	return($did);
	} 

	
public static function ReadAll() {
        $model = new DEVICE_MODEL();
        $mysqli = Config::OpenDBConnection();
        $query = "select * from devices WHERE `TYPE`='IPAD' order by ID DESC";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->bind_result($model->ID, $model->NAME, $model->SERIAL_No,$model->TYPE, $model->CREATEDATE, $model->ISACTIVE);
        $stmt->execute();
        $list = array();
        while ($stmt->fetch()) {
            $obj = new DEVICE_MODEL();
            Utils::COPY_ROW_TO_OBJ($obj, $model);
            $list[$obj->ID] = $obj;
        }
        $mysqli->close();
        return $list;
    }
public static function ReadAllByActive() {
        $model = new DEVICE_MODEL();
        $mysqli = Config::OpenDBConnection();
        $query = "select * from devices order where ISACTIVE!='0' order by ID DESC";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->bind_param('i',$userid);
        $stmt->bind_result($model->ID, $model->NAME, $model->SERIAL_No,$model->TYPE, $model->CREATEDATE, $model->ISACTIVE);
        $stmt->execute();
        $list = array();
        while ($stmt->fetch()) {
            $obj = new DEVICE_MODEL();
            Utils::COPY_ROW_TO_OBJ($obj, $model);
            $list[$obj->ID] = $obj;
        }
        $mysqli->close();
        return $list;
    }    
public static function ReadAllByActive_visitor() {
        $model = new DEVICE_MODEL();
        $mysqli = Config::OpenDBConnection();
        $query = "select * from devices where ISACTIVE!='0' and `TYPE`='TAB' order by ID DESC";
        $stmt = Config::CreateStatement($mysqli, $query);
        
        $stmt->bind_result($model->ID, $model->NAME, $model->SERIAL_No,$model->TYPE, $model->CREATEDATE, $model->ISACTIVE);
        $stmt->execute();
        $list = array();
        while ($stmt->fetch()) {
            $obj = new DEVICE_MODEL();
            Utils::COPY_ROW_TO_OBJ($obj, $model);
            $list[$obj->ID] = $obj;
        }
        $mysqli->close();
        return $list;
    }     
 public static function ReadSingle($id) {
        $model = new DEVICE_MODEL();
        $mysqli = Config::OpenDBConnection();	
        $query = "select * from devices where ID =?";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->bind_param("i", $id);		
        $stmt->bind_result($model->ID, $model->NAME, $model->SERIAL_No,$model->TYPE, $model->CREATEDATE, $model->ISACTIVE);
		$stmt->execute();
        if ($stmt->fetch()) {
            $mysqli->close();
            return $model;
        } else {
            $mysqli->close();
            return null;
        }
		    }	
 public static function ReadSingleBySERIAL_No($SERIAL_No) {
        $model = new DEVICE_MODEL();
		  $mysqli = Config::OpenDBConnection();
		
         $query = "select * from devices where SERIAL_No =?";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->bind_param("s", $SERIAL_No);
		
        $stmt->bind_result($model->ID, $model->NAME, $model->SERIAL_No,$model->TYPE, $model->CREATEDATE, $model->ISACTIVE);
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
