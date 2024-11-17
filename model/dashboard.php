<?php

class Dashboard extends BaseModel {

    public $ID; 
	public $CID; 
    public $SUBSCRIPTION_ID; 
    public $BILLING_AMOUNT;
	public $PAYMENT_STATUS;
	public $PAYMENT_METHOD;
	public $BILLING_DATETIME;
	



    function __construct() {
        parent::__construct();
        //$this->examcatid=Validator::Key($keys['layout_welcome_index_label');
    }
   public static function DueCount() {
    $mysqli = Config::OpenDBConnection();
    $query = "SELECT SUM(`due_ammount`) AS total_due_ammount FROM sdentity";
    $stmt = Config::CreateStatement($mysqli, $query);
    $stmt->execute();
    $result = $stmt->get_result();
    $total_due_ammount = 0;
    if ($row = $result->fetch_assoc()) {
        $total_due_ammount = $row['total_due_ammount'];
    }
    $mysqli->close();
    return $total_due_ammount;
    }
	
    public static function ScDueCount() {
        $mysqli = Config::OpenDBConnection();
        $query = "SELECT SUM(`due_ammount`) AS total_due_ammount FROM scentity";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->execute();
        $result = $stmt->get_result();
        $total_due_ammount = 0;
        if ($row = $result->fetch_assoc()) {
            $total_due_ammount = $row['total_due_ammount'];
        }
        $mysqli->close();
        return $total_due_ammount;
    }
    public static function SellCount() {
        $mysqli = Config::OpenDBConnection();
        $query = "SELECT ROUND(SUM(`total_amount`), 2) AS total_amount FROM invoice_gst_main WHERE `invoice_date` BETWEEN DATE_FORMAT(CURDATE(), '%Y-%m-01') AND CURDATE()";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->execute();
        $result = $stmt->get_result();
        $total_amount = 0;
        if ($row = $result->fetch_assoc()) {
            $total_amount = $row['total_amount'];
        }
        $mysqli->close();
        return $total_amount;
    }

    public static function BuyCount() {
        $mysqli = Config::OpenDBConnection();
        $query = "SELECT ROUND(SUM(`total_amount`), 2) AS total_amount FROM product_entry_main WHERE `recived_date` BETWEEN DATE_FORMAT(CURDATE(), '%Y-%m-01') AND CURDATE()";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->execute();
        $result = $stmt->get_result();
        $total_amount = 0;
        if ($row = $result->fetch_assoc()) {
            $total_amount = $row['total_amount'];
        }
        $mysqli->close();
        return $total_amount;
    }

    public static function BuyLast() {
        $mysqli = Config::OpenDBConnection();
        $query = "SELECT s.merchant_name, recived_date, total_amount FROM product_entry_main p INNER JOIN scentity s ON s.id = p.from ORDER BY recived_date DESC LIMIT 5";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = []; 
        while ($row = $result->fetch_assoc()) {
            $data[] = $row; 
        }
        $mysqli->close();
        return $data; 
    }

    public static function ProductLast() {
        $mysqli = Config::OpenDBConnection();
        $query = "SELECT s.merchant_name, recived_date, total_amount FROM product_entry_main p INNER JOIN scentity s ON s.id = p.from ORDER BY recived_date DESC LIMIT 5";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = []; 
        while ($row = $result->fetch_assoc()) {
            $data[] = $row; 
        }
        $mysqli->close();
        return $data; 
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
