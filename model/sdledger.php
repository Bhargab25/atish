<?php

class sdledgerModel extends BaseModel {

    public $id;
    public $sdid; 
	public $date; 
    public $type;
    public $current_amomount; 
	public $truns_ammount; 
    public $mode;
    public $remarks;
    public $refno;
    public $created_at;
    public $created_by;
    

    function __construct() {
        parent::__construct();
        //$this->examcatid=Validator::Key($keys['layout_welcome_index_label');
    }

public static function Create(sdledgerModel $sm) {
        $mysqli = Config::OpenDBConnection();
        $query = "INSERT INTO `leadger_sd`(`scid`,`date`,`type`, `current_amomount`, `truns_ammount`, `mode`,`remarks`,`refno`,`created_by`) values('$sm->sdid','$sm->date','$sm->type','$sm->current_amomount','$sm->truns_ammount','$sm->mode','$sm->remarks','$sm->refno','$sm->created_by')";	
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

    public static function ReadToday($from = null, $to = null) {
        $model = new sdledgerModel();
        $mysqli = Config::OpenDBConnection();
    
        // Determine the query based on whether $from and $to are set
        if (!empty($from) && !empty($to)) {
            $query = "SELECT l.id, s.merchant_name sdid, l.date, l.type, l.current_amomount, l.truns_ammount, 
                             l.mode, l.remarks, l.refno, l.created_by 
                      FROM leadger_sd l 
                      INNER JOIN sdentity s ON s.id = l.sdid 
                      WHERE DATE(l.created_at) BETWEEN ? AND ?";
        } else {
            $query = "SELECT l.id, s.merchant_name sdid, l.date, l.type, l.current_amomount, l.truns_ammount, 
                             l.mode, l.remarks, l.refno, l.created_by 
                      FROM leadger_sd l 
                      INNER JOIN sdentity s ON s.id = l.sdid 
                      WHERE DATE(l.created_at) = CURDATE()";
        }
    
        $stmt = Config::CreateStatement($mysqli, $query);
    
        // Bind parameters if $from and $to are set
        if (!empty($from) && !empty($to)) {
            $stmt->bind_param("ss", $from, $to);
        }
    
        $stmt->bind_result(
            $model->id,
            $model->sdid,
            $model->date,
            $model->type,
            $model->current_amomount,
            $model->truns_ammount,
            $model->mode,
            $model->remarks,
            $model->refno,
            $model->created_by
        );
    
        $stmt->execute();
    
        $list = array();
        while ($stmt->fetch()) {
            $obj = new sdledgerModel();
            Utils::COPY_ROW_TO_OBJ($obj, $model);
            $list[$obj->id] = $obj;
        }
    
        $mysqli->close();
        return $list;
    }


 public static function ReadSingle($id) {
        $model = new sdentityModel();
		$mysqli = Config::OpenDBConnection();
        $query = "select * from scentity where id ='$id'";
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
