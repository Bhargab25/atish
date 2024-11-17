<?php

class BILLING extends BaseModel {

    public $ID; // USER ID
	public $CID; // COMPANY UNIQUE ID
    // int primary key auto_increment,
    public $SUBSCRIPTION_ID; // LOCATION NAME
    // varchar(15),
    public $BILLING_AMOUNT; //branch address
	public $PAYMENT_STATUS;
	public $PAYMENT_METHOD;// space or it resources
	public $BILLING_DATETIME;
	
    //id ,    restaurantname ,    contactname ,    address ,    contactphone ,    loginid ,    password ,    lastlogin ,    isactive



    function __construct() {
        parent::__construct();
        //$this->examcatid=Validator::Key($keys['layout_welcome_index_label');
    }
   public static function Create(BILLING $model) {
        $mysqli = Config::OpenDBConnection();
        $query = "INSERT INTO `billing`(`ID`, `CID`, `SUBSCRIPTION_ID`, `BILLING_AMOUNT`, `PAYMENT_STATUS`, `PAYMENT_METHOD`, `BILLING_DATETIME`) VALUES ('$model->ID', '$model->CID', '$model->SUBSCRIPTION_ID', '$model->BILLING_AMOUNT','$model->PAYMENT_STATUS','$model->PAYMENT_METHOD','$model->BILLING_DATETIME')";
	
        $stmt = Config::CreateStatement($mysqli, $query);
    
        $stmt->execute();
        $id = $mysqli->insert_id;
        $mysqli->close();
        return $id;
    }
	

  
	
public static function ReadAll() {
        $model = new BILLING();
        $mysqli = Config::OpenDBConnection();
        $query = "select * from BILLING order by ID DESC";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->bind_result($model->ID, $model->CID, $model->SUBSCRIPTION_ID, $model->BILLING_AMOUNT,$model->PAYMENT_STATUS,$model->PAYMENT_METHOD,$model->BILLING_DATETIME);
        $stmt->execute();
        $list = array();
        while ($stmt->fetch()) {
            $obj = new BILLING();
            Utils::COPY_ROW_TO_OBJ($obj, $model);
            $list[$obj->ID] = $obj;
        }
        $mysqli->close();
        return $list;
    }	
 public static function ReadSingle($id) {
        $model = new BILLING();
		  $mysqli = Config::OpenDBConnection();
		
         $query = "select * from BILLING where ID =?";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->bind_param("i", $id);
		
        $stmt->bind_result($model->ID, $model->CID, $model->SUBSCRIPTION_ID, $model->BILLING_AMOUNT,$model->PAYMENT_STATUS,$model->PAYMENT_METHOD,$model->BILLING_DATETIME);
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
