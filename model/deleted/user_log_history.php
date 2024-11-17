<?php

class USR_LOG_HISTORY extends BaseModel {

    public $ID; // USER ID
	public $UID; // COMPANY UNIQUE ID
    // int primary key auto_increment,
    public $BOOKING_ID; // USER FULL NAME
    // varchar(15),
    public $LAST_ACCESS_TIME; //USER EMAIL ID
    //varchar(30),
    public $LAST_RELAESE_TIME;
    //varchar(30),
    public $CURRENT_STATUS;
	
	

    //id ,    restaurantname ,    contactname ,    address ,    contactphone ,    loginid ,    password ,    lastlogin ,    isactive



    function __construct() {
        parent::__construct();
        //$this->examcatid=Validator::Key($keys['layout_welcome_index_label');
    }
public static function Create(USR_LOG_HISTORY $USR_LOG_HISTORY) {
        $mysqli = Config::OpenDBConnection();
        $query = "INSERT INTO `user_log_history`(`ID`, `UID`, `BOOKING_ID`, `LAST_ACCESS_TIME`, `LAST_RELAESE_TIME`, `CURRENT_STATUS`) values ('$USR_LOG_HISTORY->ID','$USR_LOG_HISTORY->UID','$USR_LOG_HISTORY->BOOKING_ID','$USR_LOG_HISTORY->LAST_ACCESS_TIME','$USR_LOG_HISTORY->LAST_RELAESE_TIME','$USR_LOG_HISTORY->CURRENT_STATUS')";
	
        $stmt = Config::CreateStatement($mysqli, $query);
    
        $stmt->execute();
        $id = $mysqli->insert_id;
        $mysqli->close();
        return $id;
    }
	

  
	
public static function ReadAll() {
        $model = new USR_LOG_HISTORY();
        $mysqli = Config::OpenDBConnection();
        $query = "select * from user_log_history order by ID DESC";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->bind_result($model->ID, $model->UID, $model->BOOKING_ID, $model->LAST_ACCESS_TIME, $model->LAST_RELAESE_TIME,$model->CURRENT_STATUS);
        $stmt->execute();
        $list = array();
        while ($stmt->fetch()) {
            $obj = new USR_LOG_HISTORY();
            Utils::COPY_ROW_TO_OBJ($obj, $model);
            $list[$obj->ID] = $obj;
        }
        $mysqli->close();
        return $list;
    }	
 public static function ReadSingle($id) {
        $model = new companymodel();
		  $mysqli = Config::OpenDBConnection();
		
         $query = "select * from user_log_history where UID =?";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->bind_param("i", $id);
		
        $stmt->bind_result($model->ID, $model->UID, $model->BOOKING_ID, $model->LAST_ACCESS_TIME, $model->LAST_RELAESE_TIME,$model->CURRENT_STATUS);
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
