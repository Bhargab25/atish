<?php

class Stock extends BaseModel {

    public $id;
    public $chalan_no;
    public $merchant_name;
    public $main; 
    public $recived_date;
    public $delivary_mode;
    public $created_at;
    public $total_amount;
    public $remarks;
	public $name; 
    public $qty; 
    public $unit;
	



    function __construct() {
        parent::__construct();
        //$this->examcatid=Validator::Key($keys['layout_welcome_index_label');
    }
	
public static function ReadAll() {
        $model = new Stock();
        $mysqli = Config::OpenDBConnection();
        $query = "SELECT pm.name , ps.name, ps.current_stock, pm.unit FROM product_sub ps INNER JOIN product_main pm ON pm.id = ps.main_prod ORDER BY ps.name";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->bind_result($model->main, $model->name, $model->qty, $model->unit);
        $stmt->execute();
        $list = array();
        while ($stmt->fetch()) {
            $obj = new Stock();
            Utils::COPY_ROW_TO_OBJ($obj, $model);
            $list[$obj->main] = $obj;
        }
        $mysqli->close();
        return $list;
    }	

    public static function ReadAllByDate($from, $to) {
        $model = new Stock();
        $mysqli = Config::OpenDBConnection();
        $query = "SELECT pem.id, pem.chalan_no, s.merchant_name, pem.recived_date, pem.delivary_mode, pem.created_at, pem.total_amount, pem.remarks FROM product_entry_main pem INNER JOIN scentity s ON s.id = pem.`from` WHERE recived_date BETWEEN ? AND ? ORDER BY id DESC";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->bind_param("ss", $from, $to);
        $stmt->bind_result($model->id, $model->chalan_no, $model->merchant_name,$model->recived_date, $model->delivary_mode, $model->created_at, $model->total_amount, $model->remarks);
        $stmt->execute();
        $list = array();
        while ($stmt->fetch()) {
            $obj = new Stock();
            Utils::COPY_ROW_TO_OBJ($obj, $model);
            $list[$obj->id] = $obj;
        }
        $mysqli->close();
        return $list;
    }

    public static function RecentSell($from = null, $to = null) {
        $model = new Stock();
        $mysqli = Config::OpenDBConnection();
    
        if (!empty($from) && !empty($to)) {
            $query = "SELECT product_name, SUM(qty) AS total_qty, MAX(unit) AS unit 
                      FROM invoice_gst_history 
                      WHERE DATE(created_at) BETWEEN ? AND ? 
                      GROUP BY product_name;";
        } else {
            $query = "SELECT product_name, SUM(qty) AS total_qty, MAX(unit) AS unit 
                      FROM invoice_gst_history 
                      WHERE DATE(created_at) = CURDATE() 
                      GROUP BY product_name;";
        }
    
        $stmt = Config::CreateStatement($mysqli, $query);
    
        // Bind parameters if $from and $to are set
        if (!empty($from) && !empty($to)) {
            $stmt->bind_param("ss", $from, $to);
        }
    
        $stmt->bind_result($model->name, $model->qty, $model->unit);
        $stmt->execute();
    
        $list = array();
        while ($stmt->fetch()) {
            $obj = new Stock();
            Utils::COPY_ROW_TO_OBJ($obj, $model);
            $list[$obj->name] = $obj;
        }
    
        $mysqli->close();
        return $list;
    }

}
?>
