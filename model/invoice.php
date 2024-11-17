<?php

class invoiceModel extends BaseModel {

    public $id; 
	public $invoice_no; 
    public $c_id;
    public $name;
    public $c_mobile;
    public $c_address;
    public $invoice_date;
    public $delivery_note;
    public $mode_pay;
    public $despatched_throug;
    public $destination;
    public $total_amount; 
    public $word;
	public $created_at; 
    public $uid; 
    

    function __construct() {
        parent::__construct();
        //$this->examcatid=Validator::Key($keys['layout_welcome_index_label');
    }
public static function Create(subproductModel $pm) {
        $mysqli = Config::OpenDBConnection();
        $query = "INSERT INTO `product_sub`(`id`,`main_prod`,`name`, `created_at`, `current_stock`, `status`) values('$pm->id','$pm->main_prod','$pm->name','$pm->created_at','$pm->current_stock','$pm->status')";	
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->execute();
        $id = $mysqli->insert_id;
        $mysqli->close();
        return $id;
    }
	
public static function Update(subproductModel $pm) {
        $mysqli = Config::OpenDBConnection();
        $query = "update product_sub set main_prod='$pm->main_prod',name='$pm->name' where id='$pm->id'";
        $stmt = Config::CreateStatement($mysqli, $query);
        //   $stmt->bind_param("sssi",$pm->ENAME,$usermodel->PHONE,$usermodel->PASSWORD,$usermodel->UID);
        $stmt->execute();
        $mysqli->close();
	    return($pm->id);
	}
	
	
public static function ReadAll() {
        $model = new invoiceModel();
        $mysqli = Config::OpenDBConnection();
        $query = "SELECT * FROM invoice_gst_main ORDER BY id DESC";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->bind_result($model->id, $model->invoice_no, $model->c_id,$model->name, $model->c_mobile, $model->c_address, $model->invoice_date, $model->delivery_note,$model->mode_pay,$model->despatched_throug,$model->destination,$model->total_amount,$model->word,$model->created_at,$model->uid);
        $stmt->execute();
        $list = array();
        while ($stmt->fetch()) {
            $obj = new invoiceModel();
            Utils::COPY_ROW_TO_OBJ($obj, $model);
            $list[$obj->id] = $obj;
        }
        $mysqli->close();
        return $list;
    }

    public static function ReadAllByDate($from, $to) {
        $model = new invoiceModel();
        $mysqli = Config::OpenDBConnection();
        $query = "SELECT * FROM invoice_gst_main WHERE invoice_date BETWEEN ? AND ? ORDER BY id DESC";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->bind_param("ss", $from, $to);
        $stmt->bind_result($model->id, $model->invoice_no, $model->c_id,$model->name, $model->c_mobile, $model->c_address, $model->invoice_date, $model->delivery_note,$model->mode_pay,$model->despatched_throug,$model->destination,$model->total_amount,$model->word,$model->created_at,$model->uid);
        $stmt->execute();
        $list = array();
        while ($stmt->fetch()) {
            $obj = new invoiceModel();
            Utils::COPY_ROW_TO_OBJ($obj, $model);
            $list[$obj->id] = $obj;
        }
        $mysqli->close();
        return $list;
    }

    public static function ReadFive() {
        $model = new invoiceModel();
        $mysqli = Config::OpenDBConnection();
        $query = "SELECT * FROM invoice_gst_main ORDER BY id DESC LIMIT 5";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->bind_result($model->id, $model->invoice_no, $model->c_id,$model->name, $model->c_mobile, $model->c_address, $model->invoice_date, $model->delivery_note,$model->mode_pay,$model->despatched_throug,$model->destination,$model->total_amount,$model->word,$model->created_at,$model->uid);
        $stmt->execute();
        $list = array();
        while ($stmt->fetch()) {
            $obj = new invoiceModel();
            Utils::COPY_ROW_TO_OBJ($obj, $model);
            $list[$obj->id] = $obj;
        }
        $mysqli->close();
        return $list;
    }


 public static function ReadSingle($id) {
        $model = new invoiceModel();
		$mysqli = Config::OpenDBConnection();
        $query = "SELECT * FROM  invoice_gst_main WHERE id ='$id'";
        $stmt = Config::CreateStatement($mysqli, $query);
         //  $stmt->bind_param("i", $id);
        $stmt->bind_result($model->id, $model->invoice_no, $model->c_id,$model->name, $model->c_mobile, $model->c_address, $model->invoice_date, $model->delivery_note,$model->mode_pay,$model->despatched_throug,$model->destination,$model->total_amount,$model->word,$model->created_at,$model->uid);
		$stmt->execute();
        if ($stmt->fetch()) {
            $mysqli->close();
            return($model);
        } else {
            $mysqli->close();
            return null;
        }
}	

public static function Delete($id) {
        $mysqli = Config::OpenDBConnection();
        $query = "DELETE FROM invoice_gst_main WHERE id=?";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->bind_param("s", $id);
        $stmt->execute();
        $mysqli->close();
}

public static function Deactivate($id) {
        $mysqli = Config::OpenDBConnection();
        $query = "update product_sub set status=0 where id=?";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->bind_param("s", $id);
        $stmt->execute();
        $mysqli->close();
} 
    
public static function Activate($id) {
        $mysqli = Config::OpenDBConnection();
        $query = "update product_sub set status=1 where id=?";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->bind_param("s", $id);
        $stmt->execute();
        $mysqli->close();
}  

    
public static function callAPI($method, $url, $data){
   $curl = curl_init();
 	curl_setopt($curl, CURLOPT_POST, 1);
	curl_setopt($curl, CURLOPT_POSTFIELDS, $data);	
   

   // OPTIONS:
   curl_setopt($curl, CURLOPT_URL, $url);
   curl_setopt($curl, CURLOPT_HTTPHEADER, array(
      'token: b09a6938faa91b069dee62c377cf1232',
      'Content-Type: application/x-www-form-urlencoded',
   ));
   curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
   curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);

   // EXECUTE:
   $result = curl_exec($curl);
   if(!$result){die("Connection Failure");}
   curl_close($curl);
   return $result;
}    

}
?>
