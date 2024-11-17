<?php

class OtpModel extends BaseModel {

	public $ID;
    // int primary key auto_increment,
    public $USERID;
    public $ASSET_ID;
    public $BOOKING_ID;
	public $OTP;
	public $CREATEDATE;
	public $EXPIRE_DATE;

	
	
	
	 public static function Create(OtpModel $model) {
        $mysqli = Config::OpenDBConnection();
		 $query = "insert into otp_access ({$model->__columns}) values(NULL, $model->USERID,$model->ASSET_ID,'$model->BOOKING_ID','$model->OTP','$model->CREATEDATE','$model->EXPIRE_DATE')";
        $stmt = Config::CreateStatement($mysqli, $query);
      //  $stmt->bind_param("iisss", $model->ID, $model->USERID,$model->OTP,$model->CREATEDATE,$model->EXPIRE_DATE);
		$stmt->execute();
        $ID = $mysqli->insert_id;
        $mysqli->close();
        return $ID;
    }
	public static function update_on_generate(OtpModel $model){
		$mysqli = Config::OpenDBConnection();		
        $query = "update otp_access set OTP=?,CREATEDATE=?,EXPIRE_DATE=? where USERID=? and BOOKING_ID=?";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->bind_param("sssii",$model->OTP, $model->CREATEDATE,$model->EXPIRE_DATE,$model->USERID,$model->BOOKING_ID);
        $stmt->execute();
        $mysqli->close();	
		return($model->USERID);
	}


	
    public static function ReadSingleByUidNAid($uid,$bid) {
        $model = new OtpModel();
		$mysqli = Config::OpenDBConnection();
		//echo $USERID.$REGKEY;
        $query = "select * from otp_access where USERID='$uid' and BOOKING_ID='$bid'";
        $stmt = Config::CreateStatement($mysqli, $query);
       // $stmt->bind_param("ii", $uid,$bid);
        $stmt->bind_result($model->ID, $model->USERID,$model->ASSET_ID,$model->BOOKING_ID,$model->OTP,$model->CREATEDATE,$model->EXPIRE_DATE);
		$stmt->execute();
        if ($stmt->fetch()) {
            $mysqli->close();
            return $model;
        } else {
            $mysqli->close();
            return null;
        }
		    }
      public static function ReadSingle($id) {
        $model = new OtpModel();
		$mysqli = Config::OpenDBConnection();
		//echo $USERID.$REGKEY;
        $query = "select * from otp_access where ID=?";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->bind_param("i", $id);
        $stmt->bind_result($model->ID, $model->USERID,$model->ASSET_ID,$model->BOOKING_ID,$model->OTP,$model->CREATEDATE,$model->EXPIRE_DATE);
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
        $model = new OtpModel();
		$mysqli = Config::OpenDBConnection();
		//echo $USERID.$REGKEY;
        $query = "select * from otp_access where ASSET_ID=? and OTP=?";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->bind_param("is", $aid,$otp);
        $stmt->bind_result($model->ID,$model->USERID,$model->ASSET_ID,$model->OTP,$model->CREATEDATE,$model->EXPIRE_DATE);
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
        $model = new OtpModel();
		$mysqli = Config::OpenDBConnection();
		//echo $USERID.$REGKEY;
        $query = "select * from otp_access where '".$time."' between CREATEDATE and EXPIRE_DATE and OTP='".$otp."'";
        $stmt = Config::CreateStatement($mysqli, $query);
      //  $stmt->bind_param("is", $uid,$otp);
        $stmt->bind_result($model->ID, $model->USERID,$model->ASSET_ID,$model->BOOKING_ID,$model->OTP,$model->CREATEDATE,$model->EXPIRE_DATE);
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

	
}
?>
