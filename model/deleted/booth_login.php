<?php

class BoothLogin_Model extends BaseModel {

    public $ID; // PRIMARY KEY ID
    // int primary key auto_increment,
	public $BID; // USER UNIQUE ID
    
    public $DID; // USER FULL NAME
     public $EID; // USER FULL NAME
    // varchar(15),
    public $DEVICE_UUID; //USER EMAIL ID
    //varchar(30),
    public $SECRETKEY;
    //varchar(30),
    public $LAST_LOGIN;
    public $LAST_LOGOUT;
    

    function __construct() {
        parent::__construct();
    }
public static function Create(BoothLogin_Model $model) {
        $mysqli = Config::OpenDBConnection();
        $query = "insert into booth_login ({$model->__columns}) values({$model->__params})";
    $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->bind_param('iiissss',$model->ID, $model->BID, $model->DID, $model->EID,$model->DEVICE_UUID, $model->SECRETKEY,$model->LAST_LOGIN,$model->LAST_LOGOUT);
        $stmt->execute();
        $id = $mysqli->insert_id;
        $mysqli->close();
        return $id;
    }
public static function Update_Booth(BoothLogin_Model $model) {
         $mysqli = Config::OpenDBConnection();
        $query = "update booth_login set NAME='$model->NAME',IMAGE='$model->IMAGE','DESCRIPTION'->'$model->DESCRIPTION','BEACON'='$model->BEACON','SERVICES'='$model->SERVICES','PLACEMARKER_ID'=>'$model->PLACEMARKER_ID','PLACEMARKER_X'='$model->PLACEMARKER_X',`PLACEMARKER_X`='$model->PLACEMARKER_Y',`PLACEMARKER_AREA`='$model->PLACEMARKER_AREA',`CAMPAIGN_ID`='$model->CAMPAIGN_ID',`MODIFIED`='$model->MODIFIED' where ID='$model->ID'";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->execute();
        $mysqli->close();
	return($model->ID);
	}	
public static function UpdateService($boothid,$service) {
         $mysqli = Config::OpenDBConnection();
        $query = "update booth_login set `SERVICES`='$service' where ID='$boothid'";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->execute();
        $mysqli->close();
	return($boothid);
	} 
public static function ClearCamp($camp) {
         $mysqli = Config::OpenDBConnection();
        $query = "update booth_login set `CAMPAIGN_ID`='' where 1";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->execute();
        $mysqli->close();
	return($boothid);
	}     
public static function activate($boothid) {
         $mysqli = Config::OpenDBConnection();
        $query = "update booth_login set `ISACTIVE`='0' where ID='$boothid'";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->execute();
        $mysqli->close();
	return($boothid);
	}
public static function deactivate($boothid) {
         $mysqli = Config::OpenDBConnection();
        $query = "update booth_login set `ISACTIVE`='1' where ID='$boothid'";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->execute();
        $mysqli->close();
	return($boothid);
	}	
public static function Delete($id) {
         $mysqli = Config::OpenDBConnection();
        $query = "DELETE FROM booth_login where ID='$id'";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->execute();
        $mysqli->close();
	return($id);}    
public static function ReadAll() {
        $model = new BoothLogin_Model();
        $mysqli = Config::OpenDBConnection();
        $query = "select * from booth_login order by ID DESC";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->bind_result($model->ID, $model->BID, $model->DID, $model->EID, $model->DEVICE_UUID,$model->SECRETKEY,$model->LAST_LOGIN,$model->LAST_LOGOUT);
        $stmt->execute();
        $list = array();
        while ($stmt->fetch()) {
            $obj = new BoothLogin_Model();
            Utils::COPY_ROW_TO_OBJ($obj, $model);
            $list[$obj->ID] = $obj;
        }
        $mysqli->close();
        return $list;
    }
   
 public static function ReadSingle($id) {
        $model = new BoothLogin_Model();
		  $mysqli = Config::OpenDBConnection();
		
         $query = "select * from booth_login where ID =?";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->bind_param("i", $id);
		
        $stmt->bind_result($model->ID, $model->BID, $model->DID, $model->EID, $model->DEVICE_UUID,$model->SECRETKEY,$model->LAST_LOGIN,$model->LAST_LOGOUT);
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
        $model = new BoothLogin_Model();
		  $mysqli = Config::OpenDBConnection();
		
         $query = "select * from booth_login where `EID`=?";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->bind_param("i", $eid);
		
        $stmt->bind_result($model->ID, $model->BID, $model->DID, $model->EID, $model->DEVICE_UUID,$model->SECRETKEY,$model->LAST_LOGIN,$model->LAST_LOGOUT);
		$stmt->execute();
        if ($stmt->fetch()) {
            $mysqli->close();
            return $model;
        } else {
            $mysqli->close();
            return null;
        }
		    }
public static function ReadSingleByEventBoothdevice($eid,$bid,$did) {
        $model = new BoothLogin_Model();
		  $mysqli = Config::OpenDBConnection();
		
         $query = "select * from booth_login where `EID`=? and `BID`=? and `DID`=?";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->bind_param("iii", $eid,$bid,$did);
        $stmt->bind_result($model->ID, $model->BID, $model->DID, $model->EID, $model->DEVICE_UUID,$model->SECRETKEY,$model->LAST_LOGIN,$model->LAST_LOGOUT);
		$stmt->execute();
        if ($stmt->fetch()) {
            $mysqli->close();
            return $model;
        } else {
            $mysqli->close();
            return null;
        }
		    }  
public static function ReadSingleByEventBooth($eid,$bid) {
        $model = new BoothLogin_Model();
		  $mysqli = Config::OpenDBConnection();
		
         $query = "select * from booth_login where `EID`=? and `BID`=?";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->bind_param("ii", $eid,$bid);
        $stmt->bind_result($model->ID, $model->BID, $model->DID, $model->EID, $model->DEVICE_UUID,$model->SECRETKEY,$model->LAST_LOGIN,$model->LAST_LOGOUT);
		$stmt->execute();
        if ($stmt->fetch()) {
            $mysqli->close();
            return $model;
        } else {
            $mysqli->close();
            return null;
        }
		    }     
 public static function ReadSingleBydeviceid($DID) {
        $model = new BoothLogin_Model();
		  $mysqli = Config::OpenDBConnection();
		
         $query = "select * from booth_login where `DID`=?";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->bind_param("i", $eid);
		
        $stmt->bind_result($model->ID, $model->BID, $model->DID, $model->EID, $model->DEVICE_UUID,$model->SECRETKEY,$model->LAST_LOGIN,$model->LAST_LOGOUT);
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
