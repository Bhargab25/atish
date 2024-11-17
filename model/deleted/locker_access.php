<?php

class LOCKER_ACCESS extends BaseModel {

    public $ID; // 
	public $LOCKER_UID; // COMPANY UNIQUE ID
    // int primary key auto_increment,
    public $PIN; // Locker pin to access the locker
    // varchar(15),
    public $QRCODE; //qr image name
	public $LOCKER_RFID; // RFID
	public $CREATEDATE;// space or it resources
	
	
    //id ,    restaurantname ,    contactname ,    address ,    contactphone ,    loginid ,    password ,    lastlogin ,    isactive



    function __construct() {
        parent::__construct();
        //$this->examcatid=Validator::Key($keys['layout_welcome_index_label');
    }
   public static function Create(LOCKER_ACCESS $model) {
        $mysqli = Config::OpenDBConnection();
        $query = "INSERT INTO `locker_access`(`ID`, `LOCKER_UID`, `PIN`, `QRCODE`, `CREATEDATE`) VALUES (NULL, '$model->LOCKER_UID', '$model->PIN','$model->QRCODE','$model->CREATEDATE')";
	
        $stmt = Config::CreateStatement($mysqli, $query);
    
        $stmt->execute();
        $id = $mysqli->insert_id;
        $mysqli->close();
        return $id;
    }
	

 public static function update_QR($qrcode,$LOCKER_ID) {
         $mysqli = Config::OpenDBConnection();
		/// echo "update apointment set time='$time',date='$date' and status='pending' where id=$id";
       echo $query = "update locker_access set QRCODE='$qrcode' where LOCKER_UID='$LOCKER_ID'";
        $stmt = Config::CreateStatement($mysqli, $query);
        //$stmt->bind_param("ss",$qrcode,$LOCKER_ID);
        $stmt->execute();
        $mysqli->close();
	}
   
	
public static function ReadAll() {
        $model = new LOCKER_ACCESS();
        $mysqli = Config::OpenDBConnection();
        $query = "select * from locker_access order by ID DESC";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->bind_result($model->ID, $model->LOCKER_UID, $model->PIN,$model->QRCODE,$model->CREATEDATE);
        $stmt->execute();
        $list = array();
        while ($stmt->fetch()) {
            $obj = new LOCKER_ACCESS();
            Utils::COPY_ROW_TO_OBJ($obj, $model);
            $list[$obj->ID] = $obj;
        }
        $mysqli->close();
        return $list;
    }	
 public static function ReadSingle($id) {
        $model = new LOCKER_ACCESS();
		  $mysqli = Config::OpenDBConnection();
		
         $query = "select * from locker_access where ID =?";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->bind_param("i", $id);
		
        $stmt->bind_result($model->ID, $model->LOCKER_UID, $model->PIN,$model->QRCODE,$model->CREATEDATE);
		$stmt->execute();
        if ($stmt->fetch()) {
            $mysqli->close();
            return $model;
        } else {
            $mysqli->close();
            return null;
        }
		    }	
	public static function ReadSingleBylockerid($id) {
        $model = new LOCKER_ACCESS();
		$mysqli = Config::OpenDBConnection();
		
        $query = "select * from locker_access where LOCKER_UID =?";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->bind_param("s", $id);
		
        $stmt->bind_result($model->ID, $model->LOCKER_UID, $model->PIN,$model->QRCODE,$model->CREATEDATE);
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
