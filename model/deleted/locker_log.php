<?php

class LOCKER_LOG extends BaseModel {

    public $ID; // USER ID
	public $LOCKER_UID; // COMPANY UNIQUE ID
    // int primary key auto_increment,
    public $STATUS; // USER FULL NAME
    // varchar(15),
    public $OCCUPENCY; //USER EMAIL ID
    public $atremp_from; // enum app,rfid,finger,face
	public $lastChange;

    //id ,    restaurantname ,    contactname ,    address ,    contactphone ,    loginid ,    password ,    lastlogin ,    isactive



    function __construct() {
        parent::__construct();
        //$this->examcatid=Validator::Key($keys['layout_welcome_index_label');
    }
   public static function Create(LOCKER_LOG $model) {
        $mysqli = Config::OpenDBConnection();
        $query = "INSERT INTO `locker_log`(`ID`, `LOCKER_UID`, `STATUS`, `OCCUPENCY`, `atremp_from`,`lastChange`) VALUES ('$model->ID', '$model->LOCKER_UID', '$model->STATUS', '$model->OCCUPENCY','$model->attemp_from','$model->lastChange')";
	
        $stmt = Config::CreateStatement($mysqli, $query);
    
        $stmt->execute();
        $id = $mysqli->insert_id;
        $mysqli->close();
        return $id;
    }
	


  
	
public static function ReadAll() {
        $model = new LOCKER_LOG();
        $mysqli = Config::OpenDBConnection();
        $query = "select * from locker_log order by ID DESC";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->bind_result($model->ID,$model->LOCKER_UID,$model->STATUS,$model->OCCUPENCY,$model->atremp_from,$model->lastChange);
        $stmt->execute();
        $list = array();
        while ($stmt->fetch()) {
            $obj = new LOCKER_LOG();
            Utils::COPY_ROW_TO_OBJ($obj, $model);
            $list[$obj->ID] = $obj;
        }
        $mysqli->close();
        return $list;
    }	
 public static function ReadSingle($id) {
        $model = new LOCKER_LOG();
		  $mysqli = Config::OpenDBConnection();
		
         $query = "select * from locker_log where LOCKER_UID =?";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->bind_param("i", $id);
		
        $stmt->bind_result($model->ID,$model->LOCKER_UID,$model->STATUS,$model->OCCUPENCY,$model->atremp_from,$model->lastChange);
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
