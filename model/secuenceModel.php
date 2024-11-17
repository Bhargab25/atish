<?php

class secuenceModel extends BaseModel {

    public $id; 
	public $type; 
    public $head;
    public $sno; 
	public $remarks; 
    public $status;
    public $created_at; 
    

    function __construct() {
        parent::__construct();
        //$this->examcatid=Validator::Key($keys['layout_welcome_index_label');
    }
public static function Create(secuenceModel $sm) {
        $mysqli = Config::OpenDBConnection();
        $query = "INSERT INTO `secuence`(`id`,`type`, `head`, `sno`, `remarks`,`status`,`created_at`) values('$sm->id','$sm->type','$sm->head','$sm->sno','$sm->remarks','$sm->status','$sm->created_at')";	
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->execute();
        $id = $mysqli->insert_id;
        $mysqli->close();
        return $id;
    }
	
public static function Update(secuenceModel $sm) {
        $mysqli = Config::OpenDBConnection();
        $query = "update secuence set type='$sm->type',head='$sm->head',sno='$sm->sno',remarks='$sm->remarks',status='$sm->status',created_at->'$sm->created_at' where id='$sm->id'";
        $stmt = Config::CreateStatement($mysqli, $query);
        //   $stmt->bind_param("sssi",$pm->ENAME,$usermodel->PHONE,$usermodel->PASSWORD,$usermodel->UID);
        $stmt->execute();
        $mysqli->close();
	    return($sm->id);
}

public static function UpdateSno($type,$sno) {
    $mysqli = Config::OpenDBConnection();
    $query = "update secuence set sno='$sno' where type='$type'";
    $stmt = Config::CreateStatement($mysqli, $query);
    //   $stmt->bind_param("sssi",$pm->ENAME,$usermodel->PHONE,$usermodel->PASSWORD,$usermodel->UID);
    $stmt->execute();
    $mysqli->close();
    return true;
}
	
public static function ReadAll() {
        $model = new secuenceModel();
        $mysqli = Config::OpenDBConnection();
        $query = "select * from secuence order by type ASC";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->bind_result($model->id, $model->type, $model->head,$model->sno, $model->remarks, $model->status, $model->created_at);
        $stmt->execute();
        $list = array();
        while ($stmt->fetch()) {
            $obj = new secuenceModel();
            Utils::COPY_ROW_TO_OBJ($obj, $model);
            $list[$obj->id] = $obj;
        }
        $mysqli->close();
        return $list;
}


public static function ReadSingle($type) {
        $model = new secuenceModel();
		$mysqli = Config::OpenDBConnection();
        $query = "select * from secuence where type ='$type'";
        $stmt = Config::CreateStatement($mysqli, $query);
         //  $stmt->bind_param("i", $id);
        $stmt->bind_result($model->id, $model->type, $model->head,$model->sno, $model->remarks, $model->status, $model->created_at);
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
    $model = new secuenceModel();
    $mysqli = Config::OpenDBConnection();
    $query = "SELECT merchant_name FROM secuence WHERE merchant_name LIKE '%.$str.%' AND status = 1";
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
        $query = "delete from secuence where id=?";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->bind_param("s", $id);
        $stmt->execute();
        $mysqli->close();
}

public static function Deactivate($id) {
        $mysqli = Config::OpenDBConnection();
        $query = "update secuence set status=0 where id=?";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->bind_param("s", $id);
        $stmt->execute();
        $mysqli->close();
} 
    
public static function Activate($id) {
        $mysqli = Config::OpenDBConnection();
        $query = "update secuence set isactive=1 where id=?";
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
