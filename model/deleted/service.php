<?php

class ServiceModel extends BaseModel {

    public $ID; // PRIMARY KEY ID
    // int primary key auto_increment,
	public $BOOTHID; // DEVICE UNIQUE ID
    public $NAME;
    public $DESCRIPTION; // USER UNIQUE ID
    // varchar(15),
    public $CREATEDDATE; //USER ASSIGN TIME
    public $MODIFIED; //USER ASSIGN TIME
    //varchar(30),
    public $ISACTIVE;//USER RELEASE TIME
    

    function __construct() {
        parent::__construct();
        //$this->examcatid=Validator::Key($keys['layout_welcome_index_label');
    }
public static function Create(ServiceModel $model) {
        $mysqli = Config::OpenDBConnection();
        $query = "insert into services ({$model->__columns}) values(NULL, '$model->BOOTHID', '$model->NAME', '$model->DESCRIPTION', '$model->CREATEDDATE','$model->MODIFIED','$model->ISACTIVE')";
        
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->execute();
        $id = $mysqli->insert_id;
        $mysqli->close();
        return $id;
    }
public static function UpdateStatus($id,$status) {
         $mysqli = Config::OpenDBConnection();
        $query = "update services set `STATUS`='$status' where ID = '$id'";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->execute();
        $mysqli->close();
	return($id);
	}	
public static function UpdateBooth($id,$booth) {
         $mysqli = Config::OpenDBConnection();
        $query = "update services set `BOOTHID`='$booth' where ID = '$id'";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->execute();
        $mysqli->close();
	return($booth);
	}
public static function Delete($id) {
         $mysqli = Config::OpenDBConnection();
        $query = "DELETE FROM services where ID='$id'";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->execute();
        $mysqli->close();
	return($id);}
    
public static function ReadAll() {
        $model = new ServiceModel();
        $mysqli = Config::OpenDBConnection();
        $query = "select * from services order by ID DESC";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->bind_result($model->ID, $model->BOOTHID, $model->NAME, $model->DESCRIPTION, $model->CREATEDDATE,$model->MODIFIED,$model->ISACTIVE);
        $stmt->execute();
        $list = array();
        while ($stmt->fetch()) {
            $obj = new ServiceModel();
            Utils::COPY_ROW_TO_OBJ($obj, $model);
            $list[$obj->ID] = $obj;
        }
        $mysqli->close();
        return $list;
    }

public static function ReadAll_free() {
        $model = new ServiceModel();
        $mysqli = Config::OpenDBConnection();
        $query = "select * from services where `BOOTHID`='0' order by ID DESC";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->bind_result($model->ID, $model->BOOTHID, $model->NAME, $model->DESCRIPTION, $model->CREATEDDATE,$model->MODIFIED,$model->ISACTIVE);
        $stmt->execute();
        $list = array();
        while ($stmt->fetch()) {
            $obj = new ServiceModel();
            Utils::COPY_ROW_TO_OBJ($obj, $model);
            $list[$obj->ID] = $obj;
        }
        $mysqli->close();
        return $list;
    }    
    
 public static function ReadSingle($id) {
        $model = new ServiceModel();
        $mysqli = Config::OpenDBConnection();	
        $query = "select * from services where ID =?";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->bind_param("i", $id);		
        $stmt->bind_result($model->ID, $model->BOOTHID, $model->NAME, $model->DESCRIPTION, $model->CREATEDDATE,$model->MODIFIED,$model->ISACTIVE);
		$stmt->execute();
        if ($stmt->fetch()) {
            $mysqli->close();
            return $model;
        } else {
            $mysqli->close();
            return null;
        }
		    }
  public static function ReadAll_Bybooth($bid) {
        $model = new ServiceModel();
        $mysqli = Config::OpenDBConnection();
        $query = "select * from services where `BOOTHID`='$bid' order by ID DESC";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->bind_result($model->ID, $model->BOOTHID, $model->NAME, $model->DESCRIPTION, $model->CREATEDDATE,$model->MODIFIED,$model->ISACTIVE);
        $stmt->execute();
        $list = array();
        while ($stmt->fetch()) {
            $obj = new ServiceModel();
            Utils::COPY_ROW_TO_OBJ($obj, $model);
            $list[$obj->ID] = $obj;
        }
        $mysqli->close();
        return $list;
    }     
   public static function ReadSingleByBooth($bid) {
        $model = new ServiceModel();
        $mysqli = Config::OpenDBConnection();	
        $query = "select * from services where BOOTHID =?";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->bind_param("i", $bid);		
        $stmt->bind_result($model->ID, $model->BOOTHID, $model->NAME, $model->DESCRIPTION, $model->CREATEDDATE,$model->MODIFIED,$model->ISACTIVE);
		$stmt->execute();
        if ($stmt->fetch()) {
            $mysqli->close();
            return $model;
        } else {
            $mysqli->close();
            return null;
        }
		    }  
    
    	public static function ReadSingleByBoothNSname($bid,$ser) {
        $model = new ServiceModel();
        $mysqli = Config::OpenDBConnection();	
        $query = "select * from services where BOOTHID =? and NAME=?";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->bind_param("is", $bid,$ser);		
        $stmt->bind_result($model->ID, $model->BOOTHID, $model->NAME, $model->DESCRIPTION, $model->CREATEDDATE,$model->MODIFIED,$model->ISACTIVE);
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
