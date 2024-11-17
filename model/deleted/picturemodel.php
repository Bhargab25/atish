<?php

class PICTURE_MODEL extends BaseModel {

    public $ID; // USER ID
	public $USERID; // COMPANY UNIQUE ID
    // int primary key auto_increment,
    public $PICTURE; // USER FULL NAME
    // varchar(15),
    public $PATH; //USER EMAIL ID
    //varchar(30),
    public $CREATED_DATE;
    //varchar(30),
    public $MODIFIED_DATE;
	
	

public static function Create(PICTURE_MODEL $model) {
        $mysqli = Config::OpenDBConnection();
       echo $query = "INSERT INTO `user_pic`(`ID`, `USERID`, `PICTURE`, `PATH`, `CREATED-DATE`, `MODIFIED_DATE`) values('$model->ID','$model->USERID','$model->PICTURE','$model->PATH',NOW(),NOW())";
	
        $stmt = Config::CreateStatement($mysqli, $query);
    
        $stmt->execute();
        $id = $mysqli->insert_id;
        $mysqli->close();
        return $id;
    }
	

	
public static function ReadAll() {
        $model = new PICTURE_MODEL();
        $mysqli = Config::OpenDBConnection();
        $query = "select * from user_pic order by ID DESC";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->bind_result($model->ID,$model->USERID,$model->PICTURE,$model->PATH,$model->CREATED_DATE,$model->MODIFIED_DATE);
        $stmt->execute();
        $list = array();
        while ($stmt->fetch()) {
            $obj = new model();
            Utils::COPY_ROW_TO_OBJ($obj, $model);
            $list[$obj->ID] = $obj;
        }
        $mysqli->close();
        return $list;
    }	
	
public static function ReadAllByUID($uid) {
        $model = new PICTURE_MODEL();
        $mysqli = Config::OpenDBConnection();
        $query = "select * from user_pic where USERID=? order by ID DESC";
        $stmt = Config::CreateStatement($mysqli, $query);
		$stmt->bind_param("i", $uid);
        $stmt->bind_result($model->ID,$model->USERID,$model->PICTURE,$model->PATH,$model->CREATED_DATE,$model->MODIFIED_DATE);
        $stmt->execute();
        $list = array();
        while ($stmt->fetch()) {
            $obj = new PICTURE_MODEL();
            Utils::COPY_ROW_TO_OBJ($obj, $model);
            $list[$obj->USERID] = $obj;
        }
        $mysqli->close();
        return $list;
    }		
	
 public static function ReadSingle($id) {
        $model = new PICTURE_MODEL();
		$mysqli = Config::OpenDBConnection();		
        $query = "select * from user_pic where ID =?";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->bind_param("i", $id);	
        $stmt->bind_result($model->ID,$model->USERID,$model->PICTURE,$model->PATH,$model->CREATED_DATE,$model->MODIFIED_DATE);
	 
		$stmt->execute();
        if ($stmt->fetch()) {
            $mysqli->close();
            return $model;
        } else {
            $mysqli->close();
            return null;
        }
		    }	
 public static function ReadSingleByUID($id) {
        $model = new PICTURE_MODEL();
		$mysqli = Config::OpenDBConnection();		
        $query = "select * from user_pic where USERID =?";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->bind_param("i", $id);	
        $stmt->bind_result($model->ID,$model->USERID,$model->PICTURE,$model->PATH,$model->CREATED_DATE,$model->MODIFIED_DATE);
	 
		$stmt->execute();
        if ($stmt->fetch()) {
            $mysqli->close();
            return $model;
        } else {
            $mysqli->close();
            return null;
        }
		    }		
public static function ReadSingleByCompany($name) {
        $model = new PICTURE_MODEL();
		$mysqli = Config::OpenDBConnection();		
        $query = "select * from user_pic where USERID ='".$name."'";
        $stmt = Config::CreateStatement($mysqli, $query);
      //  $stmt->bind_param("s", $name);	
        $stmt->bind_result($model->ID,$model->USERID,$model->PICTURE,$model->PATH,$model->CREATED_DATE,$model->MODIFIED_DATE);
	 
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
