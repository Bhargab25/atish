<?php

class RFIDMODEL extends BaseModel {

    public $ID; // USER ID
	public $USERID; // COMPANY UNIQUE ID
    // int primary key auto_increment,
    public $RFID; // USER FULL NAME
    // varchar(15),
    public $ISACTIVE; //USER EMAIL ID

    function __construct() {
        parent::__construct();
        //$this->examcatid=Validator::Key($keys['layout_welcome_index_label');
    }
public static function Create(RFIDMODEL $model) {
        $mysqli = Config::OpenDBConnection();
        $query = "INSERT INTO `rfid_details` (`ID`, `USERID`, `RFID`, `ISACTIVE`) values(NULL,'$model->USERID','$model->RFID','$model->ISACTIVE')";
        $stmt = Config::CreateStatement($mysqli, $query);  
        $stmt->execute();
        $id = $mysqli->insert_id;
        $mysqli->close();
        return $id;
    }

public static function Update(RFIDMODEL $model) {
         $mysqli = Config::OpenDBConnection();
		/// echo "update apointment set time='$time',date='$date' and status='pending' where id=$id";
        $query = "update rfid_details set RFID=?,ISACTIVE=? where USERID=?";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->bind_param("sii",$model->RFID,$model->ISACTIVE,$model->USERID);
        $stmt->execute();
        $mysqli->close();
	return($model->USERID);
	}	
	
public static function ReadAll() {
        $model = new RFIDMODEL();
        $mysqli = Config::OpenDBConnection();
        $query = "select * from rfid_details order by UID DESC";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->bind_result($model->ID, $model->USERID, $model->RFID, $model->ISACTIVE);
        $stmt->execute();
        $list = array();
        while ($stmt->fetch()) {
            $obj = new RFIDMODEL();
            Utils::COPY_ROW_TO_OBJ($obj, $model);
            $list[$obj->CID] = $obj;
        }
        $mysqli->close();
        return $list;
    }	
 public static function ReadSingle($id) {
        $model = new RFIDMODEL();
		$mysqli = Config::OpenDBConnection();
        $query = "select * from rfid_details where USERID =?";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->bind_param("i", $id);		
        $stmt->bind_result($model->ID, $model->USERID, $model->RFID, $model->ISACTIVE);
		$stmt->execute();
        if ($stmt->fetch()) {
            $mysqli->close();
            return $model;
        } else {
            $mysqli->close();
            return null;
        }
		    }	
	
public static function ReadSingleByRFID($RFID) {
        $model = new RFIDMODEL();
		$mysqli = Config::OpenDBConnection();
        $query = "select * from rfid_details where RFID =?";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->bind_param("s", $RFID);		
        $stmt->bind_result($model->ID, $model->USERID, $model->RFID, $model->ISACTIVE);
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
