<?php

class scentityModel extends BaseModel {

    public $id; 
	public $merchant_name; 
    public $mobile;
    public $email; 
	public $address; 
    public $created_at;
    public $status;
    public $due_ammount;
    public $gst;
    public $uid;
    

    function __construct() {
        parent::__construct();
        //$this->examcatid=Validator::Key($keys['layout_welcome_index_label');
    }

public static function Create(scentityModel $sm) {
        $mysqli = Config::OpenDBConnection();
        $query = "INSERT INTO `scentity`(`id`,`merchant_name`,`mobile`, `email`, `address`, `created_at`,`status`,`due_ammount`,`gst`,`uid`) values('$sm->id','$sm->merchant_name','$sm->mobile','$sm->email','$sm->address','$sm->created_at','$sm->status','$sm->due_ammount','$sm->gst','$sm->uid')";	
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->execute();
        $id = $mysqli->insert_id;
        $mysqli->close();
        return $id;
    }
	
public static function Update(scentityModel $sm) {
        $mysqli = Config::OpenDBConnection();
        $query = "update scentity set merchant_name='$sm->merchant_name',mobile='$sm->mobile',email='$sm->email',address='$sm->address',gst='$sm->gst' where id='$sm->id'";
        $stmt = Config::CreateStatement($mysqli, $query);
        //   $stmt->bind_param("sssi",$pm->ENAME,$usermodel->PHONE,$usermodel->PASSWORD,$usermodel->UID);
        $stmt->execute();
        $mysqli->close();
	    return($sm->id);
	}
	
	
public static function ReadAll() {
        $model = new scentityModel();
        $mysqli = Config::OpenDBConnection();
        $query = "select `id`,`merchant_name`, s.mobile ,s.email,`address`,`created_at`,s.status,`due_ammount`,`gst`,a.name from scentity s INNER JOIN appuser a ON a.uid = s.uid order by s.merchant_name ASC";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->bind_result($model->id,$model->merchant_name,$model->mobile,$model->email,$model->address,$model->created_at,$model->status,$model->due_ammount,$model->gst,$model->uid);
        $stmt->execute();
        $list = array();
        while ($stmt->fetch()) {
            $obj = new scentityModel();
            Utils::COPY_ROW_TO_OBJ($obj, $model);
            $list[$obj->id] = $obj;
        }
        $mysqli->close();
        return $list;
    }


 public static function ReadSingle($id) {
        $model = new scentityModel();
		$mysqli = Config::OpenDBConnection();
        $query = "SELECT * FROM scentity WHERE id ='$id'";
        $stmt = Config::CreateStatement($mysqli, $query);
         //  $stmt->bind_param("i", $id);
        $stmt->bind_result($model->id,$model->merchant_name,$model->mobile,$model->email,$model->address,$model->created_at,$model->status,$model->due_ammount,$model->gst,$model->uid);
		$stmt->execute();
        if ($stmt->fetch()) {
            $mysqli->close();
            return($model);
        } else {
            $mysqli->close();
            return null;
        }
}

public static function ReadByDue() {
    $model = new scentityModel();
    $mysqli = Config::OpenDBConnection();
    $query = "SELECT * FROM scentity ORDER BY due_ammount DESC LIMIT 5";
    $stmt = Config::CreateStatement($mysqli, $query);
    $stmt->bind_result($model->id,$model->merchant_name,$model->mobile,$model->email,$model->address,$model->created_at,$model->status,$model->due_ammount,$model->gst,$model->uid);
    $stmt->execute();
    $list = array();
    while ($stmt->fetch()) {
        $obj = new scentityModel();
        Utils::COPY_ROW_TO_OBJ($obj, $model);
        $list[$obj->id] = $obj;
    }
    $mysqli->close();
    return $list;
}

public static function ReadByName($name) {
    $model = new scentityModel();
    $mysqli = Config::OpenDBConnection();
    $query = "SELECT * FROM scentity where merchant_name ='$name' AND status = 1";
    $stmt = Config::CreateStatement($mysqli, $query);
     //  $stmt->bind_param("i", $id);
    $stmt->bind_result($model->id,$model->merchant_name,$model->mobile,$model->email,$model->address,$model->created_at,$model->status,$model->due_ammount,$model->gst,$model->uid);
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
    $model = new scentityModel();
    $mysqli = Config::OpenDBConnection();
    $query = "SELECT merchant_name FROM scentity WHERE merchant_name LIKE '%".$str."%' AND status = 1";
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

public static function addDue($data) {
    $model = new sdentityModel();
    $mysqli = Config::OpenDBConnection();
    $query = "UPDATE scentity SET due_ammount = CAST(due_ammount AS UNSIGNED) + ? WHERE id = ?";
    $stmt = Config::CreateStatement($mysqli, $query);
    $stmt->bind_param("is",$data->due_amount,$data->id);
    $stmt->execute();
    $mysqli->close();
	return($data->id);
    
}


public static function Delete($id) {
        $mysqli = Config::OpenDBConnection();
        $query = "delete from scentity where id=?";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->bind_param("s", $id);
        $stmt->execute();
        $mysqli->close();
}

public static function Deactivate($id) {
        $mysqli = Config::OpenDBConnection();
        $query = "update scentity set status=0 where id=?";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->bind_param("s", $id);
        $stmt->execute();
        $mysqli->close();
} 
    
public static function Activate($id) {
        $mysqli = Config::OpenDBConnection();
        $query = "update scentity set status=1 where id=?";
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
