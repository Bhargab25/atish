<?php

class subproductModel extends BaseModel {

    public $id; 
	public $main_prod; 
    public $name;
    public $created_at; 
	public $current_stock; 
    public $status; 
    

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
        $model = new subproductModel();
        $mysqli = Config::OpenDBConnection();
        $query = "select s.id,p.name,s.name,s.created_at,s.current_stock,s.status from product_sub s INNER JOIN product_main p ON p.id = s.main_prod order by id DESC";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->bind_result($model->id, $model->main_prod, $model->name,$model->created_at, $model->current_stock, $model->status);
        $stmt->execute();
        $list = array();
        while ($stmt->fetch()) {
            $obj = new subproductModel();
            Utils::COPY_ROW_TO_OBJ($obj, $model);
            $list[$obj->id] = $obj;
        }
        $mysqli->close();
        return $list;
    }


 public static function ReadSingle($id) {
        $model = new subproductModel();
		$mysqli = Config::OpenDBConnection();
        $query = "select s.id,p.name,s.name,s.created_at,s.current_stock,s.status from product_sub s INNER JOIN product_main p ON p.id = s.main_prod where s.id ='$id'";
        $stmt = Config::CreateStatement($mysqli, $query);
         //  $stmt->bind_param("i", $id);
        $stmt->bind_result($model->id, $model->main_prod, $model->name,$model->created_at, $model->current_stock, $model->status);
		$stmt->execute();
        if ($stmt->fetch()) {
            $mysqli->close();
            return($model);
        } else {
            $mysqli->close();
            return null;
        }
}	

public static function ReadWithUnit($id) {
    $model = new subproductModel();
    $mysqli = Config::OpenDBConnection();
    $query = "SELECT s.id,p.unit,s.name,s.created_at,s.current_stock,s.status FROM product_sub s INNER JOIN product_main p ON p.id = s.main_prod WHERE s.id ='$id'";
    $stmt = Config::CreateStatement($mysqli, $query);
     //  $stmt->bind_param("i", $id);
    $stmt->bind_result($model->id, $model->main_prod, $model->name,$model->created_at, $model->current_stock, $model->status);
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
        $query = "delete from product_sub where id=?";
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
