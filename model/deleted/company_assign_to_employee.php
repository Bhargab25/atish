<?php

class COMP_FADO_ASSIGN extends BaseModel {

    public $ID; // USER ID
	public $CID; // COMPANY UNIQUE ID
    // int primary key auto_increment,
    public $LOCKER_ID; // LOCATION NAME
    // varchar(15),
    public $MODULE_TYPE; //branch address
    public $ASSET_ID;
	public $UID;// space or it resources
	public $LOCKER_STATUS;
	public $ISFREE;
	public $lastChange;
	
    //id ,    restaurantname ,    contactname ,    address ,    contactphone ,    loginid ,    password ,    lastlogin ,    isactive



    function __construct() {
        parent::__construct();
        //$this->examcatid=Validator::Key($keys['layout_welcome_index_label');
    }
   public static function Create(COMP_FADO_ASSIGN $model) {
        $mysqli = Config::OpenDBConnection();
        $query = "INSERT INTO `company_assign_to_employee`(`ID`, `CID`, `LOCKER_ID`, `MODULE_TYPE`,`ASSET_ID`, `UID`, `LOCKER_STATUS`, `ISFREE`, `lastChange`) VALUES (NULL, '$model->CID', '$model->LOCKER_ID', '$model->MODULE_TYPE','$model->ASSET_ID','$model->UID','$model->LOCKER_STATUS','$model->ISFREE','$model->lastChange')";
	
        $stmt = Config::CreateStatement($mysqli, $query);
    
        $stmt->execute();
        $id = $mysqli->insert_id;
        $mysqli->close();
        return $id;
    }
	

 public static function update($LOCKER_ID,$UID,$STATUS) {
         $mysqli = Config::OpenDBConnection();
		/// echo "update apointment set time='$time',date='$date' and status='pending' where id=$id";
        $query = "update user_access set LOCKER_STATUS=?,lastChange=? where LOCKER_ID=? and UID=?";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->bind_param("ssi",$LOCKER_ID,$UID,$STATUS);
        $stmt->execute();
        $mysqli->close();
	}

public static function freeDevice($LOCKER_ID,$assetid,$UID) {
         $mysqli = Config::OpenDBConnection();
		/// echo "update apointment set time='$time',date='$date' and status='pending' where id=$id";
        $query = "UPDATE `company_assign_to_employee` SET `ISFREE`='1',`lastChange`=NOW() WHERE `LOCKER_ID` = '$LOCKER_ID' AND `ASSET_ID`=$assetid AND `UID` = '$UID'";
        $stmt = Config::CreateStatement($mysqli, $query);
       // $stmt->bind_param("si",$LOCKER_ID,$UID);
        $stmt->execute();
        $mysqli->close();
	}
   	
	
public static function ReadAll() {
        $model = new COMP_FADO_ASSIGN();
        $mysqli = Config::OpenDBConnection();
        $query = "select * from company_assign_to_employee order by ID DESC";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->bind_result($model->ID, $model->CID, $model->LOCKER_ID, $model->MODULE_TYPE,$model->ASSET_ID,$model->LOCKER_RFID,$model->UID,$model->LOCKER_STATUS,$model->ISFREE,$model->lastChang);
        $stmt->execute();
        $list = array();
        while ($stmt->fetch()) {
            $obj = new COMP_FADO_ASSIGN();
            Utils::COPY_ROW_TO_OBJ($obj, $model);
            $list[$obj->ID] = $obj;
        }
        $mysqli->close();
        return $list;
    }	

public static function ReadAllBYCid($cid,$type) {
        $model = new COMP_FADO_ASSIGN();
        $mysqli = Config::OpenDBConnection();
        $query = "select * from company_assign_to_employee where CID='$cid' and MODULE_TYPE='$type' and ISFREE='0' order by ID DESC";
        $stmt = Config::CreateStatement($mysqli, $query);
	//	$stmt->bind_param("is", $cid,$type);
        $stmt->bind_result($model->ID, $model->CID, $model->LOCKER_ID, $model->MODULE_TYPE,$model->ASSET_ID,$model->UID,$model->LOCKER_STATUS,$model->ISFREE,$model->lastChang);
        $stmt->execute();
        $list = array();
        while ($stmt->fetch()) {
            $obj = new COMP_FADO_ASSIGN();
            Utils::COPY_ROW_TO_OBJ($obj, $model);
            $list[$obj->ID] = $obj;
        }
        $mysqli->close();
        return $list;
    }	
	
 public static function ReadSingle($id) {
        $model = new COMP_FADO_ASSIGN();
		  $mysqli = Config::OpenDBConnection();
		
         $query = "select * from company_assign_to_employee where ID =?";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->bind_param("i", $id);
		
        $stmt->bind_result($model->ID, $model->CID, $model->LOCKER_ID, $model->MODULE_TYPE,$model->ASSET_ID,$model->UID,$model->LOCKER_STATUS,$model->ISFREE,$model->lastChang);
		$stmt->execute();
        if ($stmt->fetch()) {
            $mysqli->close();
            return $model;
        } else {
            $mysqli->close();
            return null;
        }
		    }
 public static function ReadSinglebyCom($cid,$lockerid) {
        $model = new COMP_FADO_ASSIGN();
		  $mysqli = Config::OpenDBConnection();
		
         $query = "select * from company_assign_to_employee where CID=? and LOCKER_ID =?";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->bind_param("is", $cid,$lockerid);
		
        $stmt->bind_result($model->ID, $model->CID, $model->LOCKER_ID, $model->MODULE_TYPE,$model->LOCKER_RFID,$model->UID,$model->LOCKER_STATUS,$model->ISFREE,$model->lastChang);
		$stmt->execute();
        if ($stmt->fetch()) {
            $mysqli->close();
            return $model;
        } else {
            $mysqli->close();
            return null;
        }
		    }	
public static function ReadSingleBY($LOCKER_ID,$userid) {
        $model = new COMP_FADO_ASSIGN();
		  $mysqli = Config::OpenDBConnection();
		
         $query = "select * from company_assign_to_employee where LOCKER_ID =? and UID=?";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->bind_param("si", $LOCKER_ID,$userid);
		
        $stmt->bind_result($model->ID, $model->CID, $model->LOCKER_ID, $model->MODULE_TYPE,$model->ASSET_ID,$model->UID,$model->LOCKER_STATUS,$model->ISFREE,$model->lastChang);
		$stmt->execute();
        if ($stmt->fetch()) {
            $mysqli->close();
            return $model;
        } else {
            $mysqli->close();
            return null;
        }
		    }	
public static function ReadSingleBYUID($userid) {
        $model = new COMP_FADO_ASSIGN();
		  $mysqli = Config::OpenDBConnection();
		
         $query = "select * from company_assign_to_employee where ISFREE ='0' and UID=?";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->bind_param("i", $userid);
		
        $stmt->bind_result($model->ID, $model->CID, $model->LOCKER_ID, $model->MODULE_TYPE,$model->ASSET_ID,$model->UID,$model->LOCKER_STATUS,$model->ISFREE,$model->lastChang);
		$stmt->execute();
        if ($stmt->fetch()) {
            $mysqli->close();
            return $model;
        } else {
            $mysqli->close();
            return null;
        }
		    }
public static function ReadSingleBYUIDNCid($userid,$cid) {
        $model = new COMP_FADO_ASSIGN();
		  $mysqli = Config::OpenDBConnection();
		
         $query = "select * from company_assign_to_employee where ISFREE ='0' and UID=? and CID=?";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->bind_param("ii", $userid,$cid);
		
        $stmt->bind_result($model->ID, $model->CID, $model->LOCKER_ID, $model->MODULE_TYPE,$model->ASSET_ID,$model->UID,$model->LOCKER_STATUS,$model->ISFREE,$model->lastChang);
		$stmt->execute();
        if ($stmt->fetch()) {
            $mysqli->close();
            return $model;
        } else {
            $mysqli->close();
            return null;
        }
		    }	
    
public static function ReadAllBYCidNlock($cid,$loc) {
        $model = new COMP_FADO_ASSIGN();
        $mysqli = Config::OpenDBConnection();
        $query = "select * from company_assign_to_employee where CID='$cid' and LOCKER_ID='$loc' and ISFREE='0' order by ID DESC";
        $stmt = Config::CreateStatement($mysqli, $query);
	//	$stmt->bind_param("is", $cid,$type);
        $stmt->bind_result($model->ID, $model->CID, $model->LOCKER_ID, $model->MODULE_TYPE,$model->ASSET_ID,$model->UID,$model->LOCKER_STATUS,$model->ISFREE,$model->lastChang);
        $stmt->execute();
        $list = array();
        while ($stmt->fetch()) {
            $obj = new COMP_FADO_ASSIGN();
            Utils::COPY_ROW_TO_OBJ($obj, $model);
            $list[$obj->ID] = $obj;
        }
        $mysqli->close();
        return $list;
    }     

}
?>
