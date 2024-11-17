<?php

class Push extends BaseModel {

public $id;
    // int primary key auto_increment,
    public $userid;
	public $regkey;//varchar 11
	public $device_type;
	
	
	 public static function Create(Push $model) {
        $mysqli = Config::OpenDBConnection();
       // echo "insert into apointment ({$model->__columns}) values($model->id,$model->contact_id,$model->designation,$model->department,$model->time,$model->duration,$model->purpose,$model->date,$model->status)";
		$query = "insert into push ({$model->__columns}) values({$model->__params})";
		//INSERT INTO `apointment` (`id`, `contact_id`, `designation`, `department`, `time`, `duration`, `purpose`, `date`, `status`) VALUES (NULL, '$model->contact_id', '$model->designation', '$model->department', '$model->time', '$model->duration', '$model->purpose', '$model->date', '$model->status');
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->bind_param("iiss", $model->id, $model->userid,$model->regkey,$model->device_type);
		$stmt->execute();
        $id = $mysqli->insert_id;
        $mysqli->close();
        return $id;
    }
	public static function update(Push $model){
		  $mysqli = Config::OpenDBConnection();
		/// echo "update apointment set time='$time',date='$date' and status='pending' where id=$id";
        $query = "update push set regkey=?,device_type=? where userid=?";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->bind_param("ssi",$model->regkey,$model->device_type,$model->userid);
        $stmt->execute();
        $mysqli->close();
		
	}
    public static function ReadAll() {
        $model = new Push();
        $mysqli = Config::OpenDBConnection();
        $query = "select * from push order by id";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->bind_result($model->id, $model->userid,$model->regkey,$model->device_type);
        $stmt->execute();
        $list = array();
        while ($stmt->fetch()) {
            $obj = new Push();
            Utils::COPY_ROW_TO_OBJ($obj, $model);
            $list[$obj->id] = $obj;
        }
        $mysqli->close();
        return $list;
    }
	public static function ReadSinglebycid($userid) {
        $model = new Push();
		  $mysqli = Config::OpenDBConnection();
		
         $query = "select * from push where userid =?";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->bind_param("i", $userid);
		
        $stmt->bind_result($model->id, $model->userid,$model->regkey,$model->device_type);
		$stmt->execute();
        if ($stmt->fetch()) {
            $mysqli->close();
            return $model;
        } else {
            $mysqli->close();
            return null;
        }
		    }
	 public static function ReadAllbystatus($status) {
        $model = new Push();
        $mysqli = Config::OpenDBConnection();
        $query = "select * from apointment where status=?";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->bind_param("s", $status);
		
		$stmt->bind_result($model->id, $model->contact_id,$model->designation,$model->department, $model->time,$model->duration,$model->purpose,$model->date,$model->status);
        $stmt->execute();
        $list = array();
        while ($stmt->fetch()) {
            $obj = new Push();
            Utils::COPY_ROW_TO_OBJ($obj, $model);
            $list[$obj->id] = $obj;
        }
        $mysqli->close();
        return $list;
    }
	public static function ReadAllbyuser($userid) {
        $model = new Push();
        $mysqli = Config::OpenDBConnection();
        $query = "select * from push where userid=?";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->bind_param("i", $userid);
		
        $stmt->bind_result($model->id, $model->userid,$model->regkey,$model->device_type);
        $stmt->execute();
        $list = array();
        while ($stmt->fetch()) {
            $obj = new Push();
            Utils::COPY_ROW_TO_OBJ($obj, $model);
            $list[$obj->id] = $obj;
        }
        $mysqli->close();
        return $list;
    }
    public static function ReadSingle($userid) {
        $model = new Push();
		$mysqli = Config::OpenDBConnection();
		//echo $userid.$regkey;
        $query = "select * from push where userid=?";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->bind_param("i", $userid);
		
        $stmt->bind_result($model->id, $model->userid,$model->regkey,$model->device_type);
		$stmt->execute();
        if ($stmt->fetch()) {
            $mysqli->close();
            return $model;
        } else {
            $mysqli->close();
            return null;
        }
		    }

	
	

	

	
}
?>
