<?php

class ASSET_MODEL extends BaseModel {

    public $ID; 
	    // int primary key auto_increment,
	public $FDO_UNIQUEID;
	public $CAT_ID; // COMPANY UNIQUE ID
    // varchar(15),
    public $NAME; //USER EMAIL ID
	public $PRICE = 0;
	public $MACID; //MAC ID OR SERIAL NO.
	 public $RFID; //USER EMAIL ID
	 public $CREATEDATE; //USER EMAIL ID
	public $MODIFIEDDATE; //USER EMAIL ID
	public $ISACTIVE;

    
    public $NumberLC;
    //id ,    restaurantname ,    contactname ,    address ,    contactphone ,    loginid ,    password ,    lastlogin ,    isactive



    function __construct() {
        parent::__construct();
        //$this->examcatid=Validator::Key($keys['layout_welcome_index_label');
    }
public static function Create(ASSET_MODEL $ASSET_MODEL) {
        $mysqli = Config::OpenDBConnection();
         $query = "INSERT INTO `assets`(`ID`, `FDO_UNIQUEID`, `CAT_ID`, `NAME`, `PRICE`, `MACID`, `RFID`, `CREATEDATE`, `MODIFIEDDATE`, `ISACTIVE`)values(NULL,'$ASSET_MODEL->FDO_UNIQUEID','$ASSET_MODEL->CAT_ID','$ASSET_MODEL->NAME','$ASSET_MODEL->PRICE','$ASSET_MODEL->MACID','$ASSET_MODEL->RFID','$ASSET_MODEL->CREATEDATE','$ASSET_MODEL->MODIFIEDDATE','$ASSET_MODEL->ISACTIVE')";
	
        $stmt = Config::CreateStatement($mysqli, $query);
    
        $stmt->execute();
        $id = $mysqli->insert_id;
        $mysqli->close();
        return $id;
    }
	
public static function assignLocker(ASSET_MODEL $model){
    $mysqli = config::OpenDBConnection();
    $query = "Update `assets` set `FDO_UNIQUEID`='$model->FDO_UNIQUEID' where `ID`='$model->ID'";
    $stmt = Config::CreateStatement($mysqli,$query);
    $stmt->execute();
    $mysqli->close();
    return($model->ID);
}
public static function removeSpace(ASSET_MODEL $model){
    $mysqli = config::OpenDBConnection();
    $query = "Update `assets` set `FDO_UNIQUEID`='' where `MACID`='$model->MACID'";
    $stmt = Config::CreateStatement($mysqli,$query);
    $stmt->execute();
    $mysqli->close();
    return($model->ID);
}    
	
public static function ReadAll() {
        $ASSET_MODEL = new ASSET_MODEL();
        $mysqli = Config::OpenDBConnection();
        $query = "select * from assets order by ID DESC";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->bind_result($ASSET_MODEL->ID,$ASSET_MODEL->FDO_UNIQUEID,$ASSET_MODEL->CAT_ID,$ASSET_MODEL->NAME,$ASSET_MODEL->PRICE,$ASSET_MODEL->MACID,$ASSET_MODEL->RFID,$ASSET_MODEL->CREATEDATE,$ASSET_MODEL->MODIFIEDDATE,$ASSET_MODEL->ISACTIVE);
        $stmt->execute();
        $list = array();
        while ($stmt->fetch()) {
            $obj = new ASSET_MODEL();
            Utils::COPY_ROW_TO_OBJ($obj, $ASSET_MODEL);
            $list[$obj->ID] = $obj;
        }
        $mysqli->close();
        return $list;
    }	
public static function FreeAssets() {
        $ASSET_MODEL = new ASSET_MODEL();
        $mysqli = Config::OpenDBConnection();
        $query = "select * from assets where FDO_UNIQUEID='' OR FDO_UNIQUEID='--select--' order by ID DESC";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->bind_result($ASSET_MODEL->ID,$ASSET_MODEL->FDO_UNIQUEID,$ASSET_MODEL->CAT_ID,$ASSET_MODEL->NAME,$ASSET_MODEL->PRICE,$ASSET_MODEL->MACID,$ASSET_MODEL->RFID,$ASSET_MODEL->CREATEDATE,$ASSET_MODEL->MODIFIEDDATE,$ASSET_MODEL->ISACTIVE);
        $stmt->execute();
        $list = array();
        while ($stmt->fetch()) {
            $obj = new ASSET_MODEL();
            Utils::COPY_ROW_TO_OBJ($obj, $ASSET_MODEL);
            $list[$obj->ID] = $obj;
        }
        $mysqli->close();
        return $list;
    }	
    
	
public static function ReadAllByCID($cid) {
        $ASSET_MODEL = new ASSET_MODEL();
        $mysqli = Config::OpenDBConnection();
        $query = "select * from assets where CAT_ID='$cid' order by ID DESC";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->bind_result($ASSET_MODEL->ID,$ASSET_MODEL->FDO_UNIQUEID,$ASSET_MODEL->CAT_ID,$ASSET_MODEL->NAME,$ASSET_MODEL->PRICE,$ASSET_MODEL->MACID,$ASSET_MODEL->RFID,$ASSET_MODEL->CREATEDATE,$ASSET_MODEL->MODIFIEDDATE,$ASSET_MODEL->ISACTIVE);
        $stmt->execute();
        $list = array();
        while ($stmt->fetch()) {
            $obj = new ASSET_MODEL();
            Utils::COPY_ROW_TO_OBJ($obj, $ASSET_MODEL);
            $list[$obj->ID] = $obj;
        }
        $mysqli->close();
        return $list;
    }
 public static function ReadAllByCID_assigned($cid) {
        $ASSET_MODEL = new ASSET_MODEL();
        $mysqli = Config::OpenDBConnection();
        $query = "select * from assets where CAT_ID='$cid' and `FDO_UNIQUEID`!='' order by ID DESC";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->bind_result($ASSET_MODEL->ID,$ASSET_MODEL->FDO_UNIQUEID,$ASSET_MODEL->CAT_ID,$ASSET_MODEL->NAME,$ASSET_MODEL->PRICE,$ASSET_MODEL->MACID,$ASSET_MODEL->RFID,$ASSET_MODEL->CREATEDATE,$ASSET_MODEL->MODIFIEDDATE,$ASSET_MODEL->ISACTIVE);
        $stmt->execute();
        $list = array();
        while ($stmt->fetch()) {
            $obj = new ASSET_MODEL();
            Utils::COPY_ROW_TO_OBJ($obj, $ASSET_MODEL);
            $list[$obj->ID] = $obj;
        }
        $mysqli->close();
        return $list;
    }   
public static function ReadAll_active() {
        $ASSET_MODEL = new ASSET_MODEL();
        $mysqli = Config::OpenDBConnection();
        $query = "select * from assets where `ISACTIVE`='Y' order by ID DESC";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->bind_result($ASSET_MODEL->ID,$ASSET_MODEL->FDO_UNIQUEID,$ASSET_MODEL->CAT_ID,$ASSET_MODEL->NAME,$ASSET_MODEL->PRICE,$ASSET_MODEL->MACID,$ASSET_MODEL->RFID,$ASSET_MODEL->CREATEDATE,$ASSET_MODEL->MODIFIEDDATE,$ASSET_MODEL->ISACTIVE);
        $stmt->execute();
        $list = array();
        while ($stmt->fetch()) {
            $obj = new ASSET_MODEL();
            Utils::COPY_ROW_TO_OBJ($obj, $ASSET_MODEL);
            $list[$obj->ID] = $obj;
        }
        $mysqli->close();
        return $list;
    }

public static function latest5_assets() {
        $ASSET_MODEL = new ASSET_MODEL();
        $mysqli = Config::OpenDBConnection();
        $query = "select * from assets where `ISACTIVE`='Y' order by ID DESC LIMIT 5";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->bind_result($ASSET_MODEL->ID,$ASSET_MODEL->FDO_UNIQUEID,$ASSET_MODEL->CAT_ID,$ASSET_MODEL->NAME,$ASSET_MODEL->PRICE,$ASSET_MODEL->MACID,$ASSET_MODEL->RFID,$ASSET_MODEL->CREATEDATE,$ASSET_MODEL->MODIFIEDDATE,$ASSET_MODEL->ISACTIVE);
        $stmt->execute();
        $list = array();
        while ($stmt->fetch()) {
            $obj = new ASSET_MODEL();
            Utils::COPY_ROW_TO_OBJ($obj, $ASSET_MODEL);
            $list[$obj->ID] = $obj;
        }
        $mysqli->close();
        return $list;
    }    
	
 public static function ReadSingle($id) {
        $ASSET_MODEL = new ASSET_MODEL();
		$mysqli = Config::OpenDBConnection();		
        $query = "select * from assets where ID =?";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->bind_param("i", $id);	
        $stmt->bind_result($ASSET_MODEL->ID,$ASSET_MODEL->FDO_UNIQUEID,$ASSET_MODEL->CAT_ID,$ASSET_MODEL->NAME,$ASSET_MODEL->PRICE,$ASSET_MODEL->MACID,$ASSET_MODEL->RFID,$ASSET_MODEL->CREATEDATE,$ASSET_MODEL->MODIFIEDDATE,$ASSET_MODEL->ISACTIVE);
	 
		$stmt->execute();
        if ($stmt->fetch()) {
            $mysqli->close();
            return $ASSET_MODEL;
        } else {
            $mysqli->close();
            return null;
        }
		    }	
 public static function ReadSingleByFID($fuid) {
        $ASSET_MODEL = new ASSET_MODEL();
		$mysqli = Config::OpenDBConnection();		
        $query = "select * from assets where FDO_UNIQUEID =?";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->bind_param("s", $fuid);	
        $stmt->bind_result($ASSET_MODEL->ID,$ASSET_MODEL->FDO_UNIQUEID,$ASSET_MODEL->CAT_ID,$ASSET_MODEL->NAME,$ASSET_MODEL->PRICE,$ASSET_MODEL->MACID,$ASSET_MODEL->RFID,$ASSET_MODEL->CREATEDATE,$ASSET_MODEL->MODIFIEDDATE,$ASSET_MODEL->ISACTIVE);
	 
		$stmt->execute();
        if ($stmt->fetch()) {
            $mysqli->close();
            return $ASSET_MODEL;
        } else {
            $mysqli->close();
            return null;
        }
		    }	
public static function checkMultiple(){
   // SELECT `FDO_UNIQUEID`, COUNT(`FDO_UNIQUEID`) FROM assets GROUP BY `FDO_UNIQUEID` HAVING COUNT(`FDO_UNIQUEID`) > 1
    $ASSET_MODEL = new ASSET_MODEL();
    $mysqli = Config::OpenDBConnection();		
    $query = "SELECT `FDO_UNIQUEID`, COUNT(`FDO_UNIQUEID`) as 'NumberLC' FROM assets GROUP BY `FDO_UNIQUEID` HAVING COUNT(`FDO_UNIQUEID`) > 1";
     $stmt = Config::CreateStatement($mysqli, $query);
     $stmt->bind_result($ASSET_MODEL->FDO_UNIQUEID,$ASSET_MODEL->NumberLC);
    
		$stmt->execute();
         $list = array();
        while ($stmt->fetch()) {
            $obj = new ASSET_MODEL();
            Utils::COPY_ROW_TO_OBJ($obj, $ASSET_MODEL);
            $list[$obj->ID] = $obj;
        }
        $mysqli->close();
        return $list;
    
}    
public static function ReadAllByFID($fuid) {
        $ASSET_MODEL = new ASSET_MODEL();
		$mysqli = Config::OpenDBConnection();		
        $query = "select * from assets where FDO_UNIQUEID =?";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->bind_param("s", $fuid);	
        $stmt->bind_result($ASSET_MODEL->ID,$ASSET_MODEL->FDO_UNIQUEID,$ASSET_MODEL->CAT_ID,$ASSET_MODEL->NAME,$ASSET_MODEL->PRICE,$ASSET_MODEL->MACID,$ASSET_MODEL->RFID,$ASSET_MODEL->CREATEDATE,$ASSET_MODEL->MODIFIEDDATE,$ASSET_MODEL->ISACTIVE);
	 
		$stmt->execute();
         $list = array();
        while ($stmt->fetch()) {
            $obj = new ASSET_MODEL();
            Utils::COPY_ROW_TO_OBJ($obj, $ASSET_MODEL);
            $list[$obj->ID] = $obj;
        }
        $mysqli->close();
        return $list;
		    }	
	public static function ReadSingleByRfidNCompany($id,$cid) {
        $ASSET_MODEL = new ASSET_MODEL();
		$mysqli = Config::OpenDBConnection();		
        $query = "select * from assets where RFID =? and ASSIGN_TO=?";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->bind_param("ii", $id,$cid);	
        $stmt->bind_result($ASSET_MODEL->ID,$ASSET_MODEL->FDO_UNIQUEID,$ASSET_MODEL->CAT_ID,$ASSET_MODEL->NAME,$ASSET_MODEL->PRICE,$ASSET_MODEL->MACID,$ASSET_MODEL->RFID,$ASSET_MODEL->CREATEDATE,$ASSET_MODEL->MODIFIEDDATE,$ASSET_MODEL->ISACTIVE);
	 
		$stmt->execute();
        if ($stmt->fetch()) {
            $mysqli->close();
            return $ASSET_MODEL;
        } else {
            $mysqli->close();
            return null;
        }
		    }
    
  	public static function ReadSingleByMAC($mac) {
        $ASSET_MODEL = new ASSET_MODEL();
		$mysqli = Config::OpenDBConnection();		
        $query = "select * from assets where MACID =?";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->bind_param("s", $mac);	
        $stmt->bind_result($ASSET_MODEL->ID,$ASSET_MODEL->FDO_UNIQUEID,$ASSET_MODEL->CAT_ID,$ASSET_MODEL->NAME,$ASSET_MODEL->PRICE,$ASSET_MODEL->MACID,$ASSET_MODEL->RFID,$ASSET_MODEL->CREATEDATE,$ASSET_MODEL->MODIFIEDDATE,$ASSET_MODEL->ISACTIVE);
	 
		$stmt->execute();
        if ($stmt->fetch()) {
            $mysqli->close();
            return $ASSET_MODEL;
        } else {
            $mysqli->close();
            return null;
        }
		    }
    public static function Delete($id) {
        $mysqli = Config::OpenDBConnection();
        $query = "delete from assets where ID=?";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $mysqli->close();
    } 
    public static function DeleteAllByCat($id) {
        $mysqli = Config::OpenDBConnection();
        $query = "delete from assets where CAT_ID=?";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $mysqli->close();
    } 

}
?>
