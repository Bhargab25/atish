<?php

class productModel extends BaseModel {

    public $id; 
	public $name; 
    public $created_at;
    public $unit; 
	public $current_stock; 
    public $status; 
    

    function __construct() {
        parent::__construct();
        //$this->examcatid=Validator::Key($keys['layout_welcome_index_label');
    }
public static function Create(productModel $pm) {
        $mysqli = Config::OpenDBConnection();
        $query = "INSERT INTO `product_main`(`id`,`name`,`created_at`, `unit`, `current_stock`, `status`) values('$pm->id','$pm->name','$pm->created_at','$pm->unit','$pm->current_stock','$pm->status')";	
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->execute();
        $id = $mysqli->insert_id;
        $mysqli->close();
        return $id;
    }
	
public static function Update(productModel $pm) {
        $mysqli = Config::OpenDBConnection();
        $query = "update product_main set name='$pm->name',unit='$pm->unit' where id='$pm->id'";
        $stmt = Config::CreateStatement($mysqli, $query);
        //   $stmt->bind_param("sssi",$pm->ENAME,$usermodel->PHONE,$usermodel->PASSWORD,$usermodel->UID);
        $stmt->execute();
        $mysqli->close();
	    return($pm->id);
	}
	
	
public static function ReadAll() {
        $model = new productModel();
        $mysqli = Config::OpenDBConnection();
        $query = "select * from product_main order by id DESC";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->bind_result($model->id, $model->name, $model->created_at,$model->unit, $model->current_stock, $model->status);
        $stmt->execute();
        $list = array();
        while ($stmt->fetch()) {
            $obj = new productModel();
            Utils::COPY_ROW_TO_OBJ($obj, $model);
            $list[$obj->id] = $obj;
        }
        $mysqli->close();
        return $list;
    }


 public static function ReadSingle($id) {
        $model = new productModel();
		$mysqli = Config::OpenDBConnection();
        $query = "select * from product_main where id ='$id'";
        $stmt = Config::CreateStatement($mysqli, $query);
         //  $stmt->bind_param("i", $id);
        $stmt->bind_result($model->id, $model->name, $model->created_at,$model->unit, $model->current_stock, $model->status);
		$stmt->execute();
        if ($stmt->fetch()) {
            $mysqli->close();
            return($model);
        } else {
            $mysqli->close();
            return null;
        }
}	
public static function ReadSingleByName($n) {
    $model = new productModel();
    $mysqli = Config::OpenDBConnection();
    $query = "select * from product_main where name ='$n'";
    $stmt = Config::CreateStatement($mysqli, $query);
     //  $stmt->bind_param("i", $id);
    $stmt->bind_result($model->id, $model->name, $model->created_at,$model->unit, $model->current_stock, $model->status);
    $stmt->execute();
    if ($stmt->fetch()) {
        $mysqli->close();
        return($model);
    } else {
        $mysqli->close();
        return null;
    }
}

public static function getNames($str) {
    $model = new productModel();
    $mysqli = Config::OpenDBConnection();
    $query = "SELECT name FROM product_main WHERE name LIKE '%" . $str . "%' AND status = 1";
    $stmt = Config::CreateStatement($mysqli, $query);
    $stmt->execute();
    $stmt->bind_result($name);
    $availableTags = array();
    while ($stmt->fetch()) {
        $availableTags[] = $name;
    }
    $stmt->close();
    $mysqli->close();
    return $availableTags;
    
}
   
public static function Delete($id) {
        $mysqli = Config::OpenDBConnection();
        $query = "delete from product_main where id=?";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->bind_param("s", $id);
        $stmt->execute();
        $mysqli->close();
}

public static function Deactivate($id) {
        $mysqli = Config::OpenDBConnection();
        $query = "update product_main set status=0 where id=?";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->bind_param("s", $id);
        $stmt->execute();
        $mysqli->close();
} 
    
public static function Activate($id) {
        $mysqli = Config::OpenDBConnection();
        $query = "update product_main set status=1 where id=?";
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
