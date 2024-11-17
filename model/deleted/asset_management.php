<?php

class ASSET_MODEL extends BaseModel {

    public $ID; // USER ID
	public $CAT_ID; // COMPANY UNIQUE ID
    // int primary key auto_increment,
    public $ITS_ID; // USER FULL NAME
    // varchar(15),
    public $DEVICE_NAME; //USER EMAIL ID
	 public $RFID; //USER EMAIL ID
	 public $ASSIGN_TO; //USER EMAIL ID
	public $STATUS; //USER EMAIL ID

    //id ,    restaurantname ,    contactname ,    address ,    contactphone ,    loginid ,    password ,    lastlogin ,    isactive



    function __construct() {
        parent::__construct();
        //$this->examcatid=Validator::Key($keys['layout_welcome_index_label');
    }
public static function Create(ASSET_MODEL $ASSET_MODEL) {
        $mysqli = Config::OpenDBConnection();
        $query = "INSERT INTO `asset_management`(`ID`, `CAT_ID`, `ITS_ID`, `DEVICE_NAME`, `RFID`, `ASSIGN_TO`, `STATUS`) values('$ASSET_MODEL->ID','$ASSET_MODEL->CAT_ID','$ASSET_MODEL->DEVICE_NAME','$ASSET_MODEL->RFID','$ASSET_MODEL->ASSIGN_TO','$ASSET_MODEL->STATUS')";
	
        $stmt = Config::CreateStatement($mysqli, $query);
    
        $stmt->execute();
        $id = $mysqli->insert_id;
        $mysqli->close();
        return $id;
    }
	

	
public static function ReadAll() {
        $ASSET_MODEL = new ASSET_MODEL();
        $mysqli = Config::OpenDBConnection();
        $query = "select * from asset_management order by ID DESC";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->bind_result($ASSET_MODEL->ID,$ASSET_MODEL->UID,$ASSET_MODEL->DESCRIPTION,$ASSET_MODEL->ISACTIVE);
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
	
public static function ReadAllByUID($uid) {
        $model = new ASSET_MODEL();
        $mysqli = Config::OpenDBConnection();
        $query = "select * from asset_management where UID=? order by JOINDATE DESC";
        $stmt = Config::CreateStatement($mysqli, $query);
		$stmt->bind_param("i", $uid);
        $stmt->bind_result($ASSET_MODEL->ID,$ASSET_MODEL->UID,$ASSET_MODEL->DESCRIPTION,$ASSET_MODEL->ISACTIVE);
        $stmt->execute();
        $list = array();
        while ($stmt->fetch()) {
            $obj = new ASSET_MODEL();
            Utils::COPY_ROW_TO_OBJ($obj, $model);
            $list[$obj->UID] = $obj;
        }
        $mysqli->close();
        return $list;
    }		
	
 public static function ReadSingle($id,$catid) {
        $ASSET_MODEL = new ASSET_MODEL();
		$mysqli = Config::OpenDBConnection();		
        $query = "select * from asset_management where RFID =? and DEVICE_NAME=?";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->bind_param("ss", $id,$catid);	
        $stmt->bind_result($ASSET_MODEL->ID,$ASSET_MODEL->CAT_ID,$ASSET_MODEL->ITS_ID,$ASSET_MODEL->DEVICE_NAME,$ASSET_MODEL->RFID,$ASSET_MODEL->ASSIGN_TO,$ASSET_MODEL->STATUS);
	 
		$stmt->execute();
        if ($stmt->fetch()) {
            $mysqli->close();
            return $ASSET_MODEL;
        } else {
            $mysqli->close();
            return null;
        }
		    }	
	public static function ReadSingleByRfidNCompany($id,$cid) {
        $ASSET_MODEL = new ASSET_MODEL();
		$mysqli = Config::OpenDBConnection();		
        $query = "select * from asset_management where RFID =? and ASSIGN_TO=?";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->bind_param("ii", $id,$cid);	
        $stmt->bind_result($ASSET_MODEL->ID,$ASSET_MODEL->CAT_ID,$ASSET_MODEL->ITS_ID,$ASSET_MODEL->DEVICE_NAME,$ASSET_MODEL->RFID,$ASSET_MODEL->ASSIGN_TO,$ASSET_MODEL->STATUS);
	 
		$stmt->execute();
        if ($stmt->fetch()) {
            $mysqli->close();
            return $ASSET_MODEL;
        } else {
            $mysqli->close();
            return null;
        }
		    }

}
?>
