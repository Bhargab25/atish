<?php

class SETUPMODEL extends BaseModel {

    public $ID; // UNIQUE ID
	//primary field integer 11
	public $MULTI_BOOKING; // if 0 then unlimited allowed, 1,
    // unique field integer 11,
    public $MULTI_ASSET; // YES OR NO
   



   
public static function Create(SETUPMODEL $model) {
        $mysqli = Config::OpenDBConnection();
       echo $query = "INSERT INTO `settings`(`ID`, `MULTI_BOOKING`, `MULTI_ASSET`) values(NULL,'$model->MULTI_BOOKING','$model->MULTI_ASSET')";
	
        $stmt = Config::CreateStatement($mysqli, $query);
    
        $stmt->execute();
        $id = $mysqli->insert_id;
        $mysqli->close();
        return $id;
    }
public static function Update(SETUPMODEL $model) {
        $mysqli = Config::OpenDBConnection();
        $query = "UPDATE `settings` set `MULTI_BOOKING`='$model->MULTI_BOOKING',`MULTI_ASSET`='$model->MULTI_ASSET'";//"INSERT INTO `settings`(`ID`, `MULTI_BOOKING`, `MULTI_ASSET`) values('$model->ID','$model->MULTI_BOOKING','$model->ROLE','$model->MULTI_ASSET')";
	
        $stmt = Config::CreateStatement($mysqli, $query);
    
        $stmt->execute();
        $id = $mysqli->insert_id;
        $mysqli->close();
        return $id;
    }	

	
public static function ReadAll() {
        $model = new SETUPMODEL();
        $mysqli = Config::OpenDBConnection();
        $query = "select * from settings order by ID DESC";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->bind_result($model->ID,$model->MULTI_BOOKING,$model->MULTI_ASSET);
        $stmt->execute();
        $list = array();
        while ($stmt->fetch()) {
            $obj = new SETUPMODEL();
            Utils::COPY_ROW_TO_OBJ($obj, $model);
            $list[$obj->ID] = $obj;
        }
        $mysqli->close();
        return $list;
    }	
	
public static function ReadAllByUserid($uid) {
        $model = new SETUPMODEL();
        $mysqli = Config::OpenDBConnection();
        $query = "select * from user_role where UID=? order by JOINDATE DESC";
        $stmt = Config::CreateStatement($mysqli, $query);
		$stmt->bind_param("i", $uid);
        $stmt->bind_result($model->ID,$model->MULTI_BOOKING,$model->MULTI_ASSET);
        $stmt->execute();
        $list = array();
        while ($stmt->fetch()) {
            $obj = new SETUPMODEL();
            Utils::COPY_ROW_TO_OBJ($obj, $model);
            $list[$obj->UID] = $obj;
        }
        $mysqli->close();
        return $list;
    }		
	
 public static function ReadSingle($id) {
        $model = new SETUPMODEL();
		$mysqli = Config::OpenDBConnection();		
        $query = "select * from settings where ID ='1'";
        $stmt = Config::CreateStatement($mysqli, $query);
        //$stmt->bind_param("i", $id);	
        $stmt->bind_result($model->ID,$model->MULTI_BOOKING,$model->MULTI_ASSET);
	 
		$stmt->execute();
        if ($stmt->fetch()) {
            $mysqli->close();
            return $model;
        } else {
            $mysqli->close();
            return null;
        }
		    }	
	
public static function ReadSingleByUser($USERID) {
        $model = new SETUPMODEL();
		$mysqli = Config::OpenDBConnection();		
        $query = "select * from user_role where USERID =?";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->bind_param("i", $USERID);	
        $stmt->bind_result($model->ID,$model->MULTI_BOOKING,$model->MULTI_ASSET);
	 
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
