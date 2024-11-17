<?php

class RackModel extends BaseModel {

	public $ID;
    // int primary key auto_increment,
    public $SLOT_ID;
    public $KEYNUM;
    public $TAGID;
    public $STATUS;
    public $LAST_ACCESS; // OPEN / CLOSE
    public $ISACTIVE;
	
	
	
	
	 public static function Create(RackModel $model) {
        $mysqli = Config::OpenDBConnection();
		 $query = "insert into key_slots ({$model->__columns}) values(NULL, $model->SLOT_ID,$model->KEYNUM,'$model->TAGID','$model->STATUS','$model->LAST_ACCESS','$model->ISACTIVE')";
        $stmt = Config::CreateStatement($mysqli, $query);
		$stmt->execute();
        $ID = $mysqli->insert_id;
        $mysqli->close();
        return $ID;
    }
	public static function update_on_generate(RackModel $model){
		$mysqli = Config::OpenDBConnection();		
        $query = "update key_slots set STATUS=?,ACCESS_TIME=? where SLOT_ID=? and ID=?";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->bind_param("sssii",$model->OTP, $model->CREATEDATE,$model->EXPIRE_DATE,$model->USERID,$model->BOOKING_ID);
        $stmt->execute();
        $mysqli->close();	
		return($model->USERID);
	}


	public static function ReadAll() {
        $model = new RackModel();
        $mysqli = Config::OpenDBConnection();
        $query = "select * from key_slots order by ID DESC";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->bind_result($model->ID, $model->SLOT_ID, $model->KEYNUM, $model->TAGID,$model->STATUS,$model->LAST_ACCESS,$model->ISACTIVE);
        $stmt->execute();
        $list = array();
        while ($stmt->fetch()) {
            $obj = new RackModel();
            Utils::COPY_ROW_TO_OBJ($obj, $model);
            $list[$obj->ID] = $obj;
        }
        $mysqli->close();
        return $list;
    }
    
      public static function ReadSingle($id) {
        $model = new RackModel();
		$mysqli = Config::OpenDBConnection();
		//echo $USERID.$REGKEY;
        $query = "select * from key_slots where ID=?";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->bind_param("i", $id);
        $stmt->bind_result($model->ID, $model->SLOT_ID, $model->KEYNUM, $model->TAGID,$model->STATUS,$model->LAST_ACCESS,$model->ISACTIVE);
		$stmt->execute();
        if ($stmt->fetch()) {
            $mysqli->close();
            return $model;
        } else {
            $mysqli->close();
            return null;
        }
		    }
    
     public static function ReadSingleBySK($id) {
        $model = new RackModel();
		$mysqli = Config::OpenDBConnection();
		//echo $USERID.$REGKEY;
        $query = "select * from key_slots where SLOT_ID=? and KEYNUM=?";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->bind_param("i", $id);
        $stmt->bind_result($model->ID, $model->SLOT_ID, $model->KEYNUM, $model->TAGID,$model->STATUS,$model->LAST_ACCESS,$model->ISACTIVE);
		$stmt->execute();
        if ($stmt->fetch()) {
            $mysqli->close();
            return $model;
        } else {
            $mysqli->close();
            return null;
        }
		    }
	   public static function ReadSingleByTag($tag) {
        $model = new RackModel();
		$mysqli = Config::OpenDBConnection();
		//echo $USERID.$REGKEY;
        $query = "select * from key_slots where TAGID=?";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->bind_param("s", $tag);
        $stmt->bind_result($model->ID, $model->SLOT_ID, $model->KEYNUM, $model->TAGID,$model->STATUS,$model->LAST_ACCESS,$model->ISACTIVE);
		$stmt->execute();
        if ($stmt->fetch()) {
            $mysqli->close();
            return $model;
        } else {
            $mysqli->close();
            return null;
        }
		    }
    
      public static function checkOtp($aid,$otp) {
        $model = new RackModel();
		$mysqli = Config::OpenDBConnection();
		//echo $USERID.$REGKEY;
        $query = "select * from otp_access where ASSET_ID=? and OTP=?";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->bind_param("is", $aid,$otp);
        $stmt->bind_result($model->ID, $model->SLOT_ID, $model->KEYNUM, $model->TAGID,$model->STATUS,$model->LAST_ACCESS,$model->ISACTIVE);
		$stmt->execute();
        if ($stmt->fetch()) {
            $mysqli->close();
            return $model;
        } else {
            $mysqli->close();
            return null;
        }
		    }
	public static function checkOtp_exp($time,$otp) {
        $model = new RackModel();
		$mysqli = Config::OpenDBConnection();
		//echo $USERID.$REGKEY;
        $query = "select * from otp_access where '".$time."' between CREATEDATE and EXPIRE_DATE and OTP='".$otp."'";
        $stmt = Config::CreateStatement($mysqli, $query);
      //  $stmt->bind_param("is", $uid,$otp);
        $stmt->bind_result($model->ID, $model->SLOT_ID, $model->KEYNUM, $model->TAGID,$model->STATUS,$model->LAST_ACCESS,$model->ISACTIVE);
		$stmt->execute();
        if ($stmt->fetch()) {
            $mysqli->close();
            return $model;
        } else {
            $mysqli->close();
            return null;
        }
		    }

	 public static function generateNumericOTP($n) { 
      
    // Take a generator string which consist of 
    // all numeric digits 
    $generator = "1357902468"; 
  
    // Iterate for n-times and pick a single character 
    // from generator and append it to $result 
      
    // Login for generating a random character from generator 
    //     ---generate a random number 
    //     ---take modulus of same with length of generator (say i) 
    //     ---append the character at place (i) from generator to result 
  
    $result = ""; 
  
    for ($i = 1; $i <= $n; $i++) { 
        $result .= substr($generator, (rand()%(strlen($generator))), 1); 
    } 
  
    // Return result 
    return $result; 
} 
public static function delete($id){
	 $mysqli = Config::OpenDBConnection();
	 $query = "delete FROM key_slots where ID=".$id;
	$stmt = Config::CreateStatement($mysqli, $query);
	//$stmt->bind_param("i", $id);
	$stmt->execute();
	$mysqli->close();
} 
	
}
?>
