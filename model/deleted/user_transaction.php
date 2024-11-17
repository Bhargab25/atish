<?php

class USR_TRANSACTION extends BaseModel {

    public $ID; // USER ID
	public $CID; // COMPANY UNIQUE ID
    // int primary key auto_increment,
    public $USERID; // USER FULL NAME
    // varchar(15),
    public $LOCKER_ID; //USER EMAIL ID
    //varchar(30),
    public $USED_HOUR;
    //varchar(30),
    public $BILLING_AMOUNT;
	public $PAYMENT_STATUS;
	public $PAYMENT_METHOD;
	public $BILLING_DATETIME;
	
	

    //id ,    restaurantname ,    contactname ,    address ,    contactphone ,    loginid ,    password ,    lastlogin ,    isactive



    function __construct() {
        parent::__construct();
        //$this->examcatid=Validator::Key($keys['layout_welcome_index_label');
    }
public static function Create(USR_TRANSACTION $USR_TRANSACTION) {
        $mysqli = Config::OpenDBConnection();
        $query = "INSERT INTO `user_transaction`(`ID`, `CID`, `USERID`, `LOCKER_ID`, `USED_HOUR`, `BILLING_AMOUNT`, `PAYMENT_STATUS`, `PAYMENT_METHOD`, `BILLING_DATETIME`) values ('$model->ID', '$model->CID', '$model->USERID', '$model->LOCKER_ID', '$model->USED_HOUR','$model->BILLING_AMOUNT','$model->PAYMENT_STATUS','$model->PAYMENT_METHOD','$model->BILLING_DATETIME')";
	
        $stmt = Config::CreateStatement($mysqli, $query);
    
        $stmt->execute();
        $id = $mysqli->insert_id;
        $mysqli->close();
        return $id;
    }
	

  
	
public static function ReadAll() {
        $model = new USR_TRANSACTION();
        $mysqli = Config::OpenDBConnection();
        $query = "select * from user_transaction order by ID DESC";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->bind_result($model->ID, $model->CID, $model->USERID, $model->LOCKER_ID, $model->USED_HOUR,$model->BILLING_AMOUNT,$model->PAYMENT_STATUS,$model->PAYMENT_METHOD,$model->BILLING_DATETIME);
        $stmt->execute();
        $list = array();
        while ($stmt->fetch()) {
            $obj = new USR_TRANSACTION();
            Utils::COPY_ROW_TO_OBJ($obj, $model);
            $list[$obj->ID] = $obj;
        }
        $mysqli->close();
        return $list;
    }	
 public static function ReadSingle($id) {
        $model = new USR_TRANSACTION();
		  $mysqli = Config::OpenDBConnection();
		
         $query = "select * from user_transaction where UID =?";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->bind_param("i", $id);
		
        $stmt->bind_result($model->ID, $model->CID, $model->USERID, $model->LAST_ACCESS_TIME, $model->LAST_RELAESE_TIME,$model->CURRENT_STATUS);
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
