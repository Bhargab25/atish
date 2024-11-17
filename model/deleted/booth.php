<?php

class Booth_Model extends BaseModel {

    public $ID; // PRIMARY KEY ID
    // int primary key auto_increment,
	public $NAME; // USER UNIQUE ID
    
    public $IMAGE; // USER FULL NAME
    // varchar(15),
    public $DESCRIPTION; //USER EMAIL ID
    //varchar(30),
    public $BEACON;
    //varchar(30),
    public $SERVICES;
    public $PLACEMARKER_ID;
    public $PLACEMARKER_X;
    public $PLACEMARKER_Y;
    public $PLACEMARKER_AREA;
    public $CAMPAIGN_ID;
    public $CREATEDATE;
    public $MODIFIED;
    public $ISACTIVE;

    function __construct() {
        parent::__construct();
        //$this->examcatid=Validator::Key($keys['layout_welcome_index_label');
    }
public static function Create(Booth_Model $model) {
        $mysqli = Config::OpenDBConnection();
        $query = "insert into booths ({$model->__columns}) values(NULL, '$model->NAME', '$model->IMAGE', '$model->DESCRIPTION', '$model->BEACON','$model->SERVICES','$model->PLACEMARKER_ID','$model->PLACEMARKER_X','$model->PLACEMARKER_Y','$model->PLACEMARKER_AREA','$model->CAMPAIGN_ID','$model->CREATEDATE','$model->MODIFIED','$model->ISACTIVE')";
    $stmt = Config::CreateStatement($mysqli, $query);
       // $stmt->bind_param('issssssssssi',$model->ID, $model->NAME, $model->IMAGE, $model->DESCRIPTION, $model->BEACON,$model->SERVICES,$model->PLACEMARKER_ID,$model->PLACEMARKER_X,$model->PLACEMARKER_Y,$model->CREATEDATE,$model->MODIFIED,$model->ISACTIVE);
        //$stmt->bind_result($model->ID, $model->NAME, $model->IMAGE, $model->DESCRIPTION, $model->BEACON,$model->SERVICES,$model->PLACEMARKER_ID,$model->PLACEMARKER_X,$model->PLACEMARKER_Y,$model->CREATEDATE,$model->MODIFIED,$model->ISACTIVE);
        
        $stmt->execute();
        $id = $mysqli->insert_id;
        $mysqli->close();
        return $id;
    }
public static function Update_Booth(Booth_Model $model) {
         $mysqli = Config::OpenDBConnection();
        $query = "update booths set NAME='$model->NAME',IMAGE='$model->IMAGE','DESCRIPTION'->'$model->DESCRIPTION','BEACON'='$model->BEACON','SERVICES'='$model->SERVICES','PLACEMARKER_ID'=>'$model->PLACEMARKER_ID','PLACEMARKER_X'='$model->PLACEMARKER_X',`PLACEMARKER_X`='$model->PLACEMARKER_Y',`PLACEMARKER_AREA`='$model->PLACEMARKER_AREA',`CAMPAIGN_ID`='$model->CAMPAIGN_ID',`MODIFIED`='$model->MODIFIED' where ID='$model->ID'";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->execute();
        $mysqli->close();
	return($model->ID);
	}	
public static function UpdateService($boothid,$service) {
         $mysqli = Config::OpenDBConnection();
        $query = "update booths set `SERVICES`='$service' where ID='$boothid'";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->execute();
        $mysqli->close();
	return($boothid);
	} 
public static function ClearCamp($camp) {
         $mysqli = Config::OpenDBConnection();
        $query = "update booths set `CAMPAIGN_ID`='' where 1";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->execute();
        $mysqli->close();
	return($boothid);
	}     
public static function activate($boothid) {
         $mysqli = Config::OpenDBConnection();
        $query = "update booths set `ISACTIVE`='0' where ID='$boothid'";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->execute();
        $mysqli->close();
	return($boothid);
	}
public static function deactivate($boothid) {
         $mysqli = Config::OpenDBConnection();
        $query = "update booths set `ISACTIVE`='1' where ID='$boothid'";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->execute();
        $mysqli->close();
	return($boothid);
	}	
public static function Delete($id) {
         $mysqli = Config::OpenDBConnection();
        $query = "DELETE FROM booths where ID='$id'";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->execute();
        $mysqli->close();
	return($id);}    
public static function ReadAll() {
        $model = new Booth_Model();
        $mysqli = Config::OpenDBConnection();
        $query = "select * from booths order by ID DESC";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->bind_result($model->ID, $model->NAME, $model->IMAGE, $model->DESCRIPTION, $model->BEACON,$model->SERVICES,$model->PLACEMARKER_ID,$model->PLACEMARKER_X,$model->PLACEMARKER_Y,$model->PLACEMARKER_AREA,$model->CAMPAIGN_ID,$model->CREATEDATE,$model->MODIFIED,$model->ISACTIVE);
        $stmt->execute();
        $list = array();
        while ($stmt->fetch()) {
            $obj = new Booth_Model();
            Utils::COPY_ROW_TO_OBJ($obj, $model);
            $list[$obj->ID] = $obj;
        }
        $mysqli->close();
        return $list;
    }
public static function ReadAll_active() {
        $model = new Booth_Model();
        $mysqli = Config::OpenDBConnection();
        $query = "select * from booths where `ISACTIVE`='1' order by ID DESC";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->bind_result($model->ID, $model->NAME, $model->IMAGE, $model->DESCRIPTION, $model->BEACON,$model->SERVICES,$model->PLACEMARKER_ID,$model->PLACEMARKER_X,$model->PLACEMARKER_Y,$model->PLACEMARKER_AREA,$model->CAMPAIGN_ID,$model->CREATEDATE,$model->MODIFIED,$model->ISACTIVE);
        $stmt->execute();
        $list = array();
        while ($stmt->fetch()) {
            $obj = new Booth_Model();
            Utils::COPY_ROW_TO_OBJ($obj, $model);
            $list[$obj->ID] = $obj;
        }
        $mysqli->close();
        return $list;
    }    
public static function ReadAllByservice($service) {
        $model = new Booth_Model();
        $mysqli = Config::OpenDBConnection();
        $query = "select * from booths where FIND_IN_SET('$service', `SERVICES`) > 0";
        $stmt = Config::CreateStatement($mysqli, $query);
        //$stmt->bind_param('s',$service);
        $stmt->bind_result($model->ID, $model->NAME, $model->IMAGE, $model->DESCRIPTION, $model->BEACON,$model->SERVICES,$model->PLACEMARKER_ID,$model->PLACEMARKER_X,$model->PLACEMARKER_Y,$model->PLACEMARKER_AREA,$model->CAMPAIGN_ID,$model->CREATEDATE,$model->MODIFIED,$model->ISACTIVE);
        $stmt->execute();
        $list = array();
        while ($stmt->fetch()) {
            $obj = new Booth_Model();
            Utils::COPY_ROW_TO_OBJ($obj, $model);
            $list[$obj->ID] = $obj;
        }
        $mysqli->close();
        return $list;
    }    
 public static function ReadSingle($id) {
        $model = new Booth_Model();
		  $mysqli = Config::OpenDBConnection();
		
         $query = "select * from booths where ID =?";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->bind_param("i", $id);
		
        $stmt->bind_result($model->ID, $model->NAME, $model->IMAGE, $model->DESCRIPTION, $model->BEACON,$model->SERVICES,$model->PLACEMARKER_ID,$model->PLACEMARKER_X,$model->PLACEMARKER_Y,$model->PLACEMARKER_AREA,$model->CAMPAIGN_ID,$model->CREATEDATE,$model->MODIFIED,$model->ISACTIVE);
		$stmt->execute();
        if ($stmt->fetch()) {
            $mysqli->close();
            return $model;
        } else {
            $mysqli->close();
            return null;
        }
		    }	
public static function ReadSingleByCampaign($camp) {
        $model = new Booth_Model();
		  $mysqli = Config::OpenDBConnection();
		
         $query = "select * from booths where FIND_IN_SET('$camp', `CAMPAIGN_ID`) > 0";
        $stmt = Config::CreateStatement($mysqli, $query);
        //$stmt->bind_param("s", $camp);
		
        $stmt->bind_result($model->ID, $model->NAME, $model->IMAGE, $model->DESCRIPTION, $model->BEACON,$model->SERVICES,$model->PLACEMARKER_ID,$model->PLACEMARKER_X,$model->PLACEMARKER_Y,$model->PLACEMARKER_AREA,$model->CAMPAIGN_ID,$model->CREATEDATE,$model->MODIFIED,$model->ISACTIVE);
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
