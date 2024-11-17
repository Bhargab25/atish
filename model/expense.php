<?php

class expmodel extends BaseModel {

    public $id; 
	public $name; 
    public $amount;
    public $date;
    public $remarks;

    function __construct() {
        parent::__construct();
        //$this->examcatid=Validator::Key($keys['layout_welcome_index_label');
    }
public static function Create(expmodel $expmodel) {
        $mysqli = Config::OpenDBConnection();
        $query = "INSERT INTO `expense`(`name`,`amount`,`date`,`remarks`) values('$expmodel->name','$expmodel->amount','$expmodel->date','$expmodel->remarks')";	
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->execute();
        $id = $mysqli->insert_id;
        $mysqli->close();
        return $id;
    }
	
public static function Update(expmodel $expmodel) {
        $mysqli = Config::OpenDBConnection();
        $query = "update expense set name='$expmodel->name',amount='$expmodel->amount',date='$expmodel->date',remarks='$expmodel->remarks'";
        $stmt = Config::CreateStatement($mysqli, $query);
     //   $stmt->bind_param("sssi",$expmodel->ENAME,$expmodel->PHONE,$expmodel->PASSWORD,$expmodel->UID);
        $stmt->execute();
        $mysqli->close();
	    return($expmodel->id);
	}

	
public static function ReadAll() {
        $model = new expmodel();
        $mysqli = Config::OpenDBConnection();
        $query = "select * from expense order by uid DESC";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->bind_result($model->id, $model->name,$model->amount, $model->date,$model->remarks);
        $stmt->execute();
        $list = array();
        while ($stmt->fetch()) {
            $obj = new expmodel();
            Utils::COPY_ROW_TO_OBJ($obj, $model);
            $list[$obj->id] = $obj;
        }
        $mysqli->close();
        return $list;
    }


 public static function ReadSingle($id) {
        $model = new expmodel();
		$mysqli = Config::OpenDBConnection();
        $query = "select * from expense where id ='$id'";
        $stmt = Config::CreateStatement($mysqli, $query);
         //  $stmt->bind_param("i", $id);
        $stmt->bind_result($model->id, $model->name,$model->amount, $model->date,$model->remarks);
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
        $query = "delete from expense where id=?";
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
