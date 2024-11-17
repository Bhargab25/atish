<?php

class ROLEMODEL extends BaseModel {

    public $ID; // UNIQUE ID
	//primary field integer 11
	public $USERID; // USER UNIQUE ID
    // unique field integer 11,
    public $ROLE; // USER ROLE ON ADMIN PANEL
    public $FEATURE;
    // varchar(33),
    public $ISACTIVE; //USER IS ACTIVE OR NOT ID ACTIVE THEN 0 ELSE 1
    



   
public static function Create(ROLEMODEL $model) {
        $mysqli = Config::OpenDBConnection();
        $query = "INSERT INTO `user_role`(`ID`, `USERID`, `ROLE`,`FEATURE`, `ISACTIVE`) values('$model->ID','$model->USERID','$model->ROLE','$model->FEATURE','$model->ISACTIVE')";
	
        $stmt = Config::CreateStatement($mysqli, $query);
    
        $stmt->execute();
        $id = $mysqli->insert_id;
        $mysqli->close();
        return $id;
    }
	

	
public static function ReadAll() {
        $model = new ROLEMODEL();
        $mysqli = Config::OpenDBConnection();
        $query = "select * from user_role order by ID DESC";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->bind_result($model->ID,$model->USERID,$model->ROLE,$model->FEATURE,$model->ISACTIVE);
        $stmt->execute();
        $list = array();
        while ($stmt->fetch()) {
            $obj = new ROLEMODEL();
            Utils::COPY_ROW_TO_OBJ($obj, $model);
            $list[$obj->ID] = $obj;
        }
        $mysqli->close();
        return $list;
    }	
	
public static function ReadAllByUserid($uid) {
        $model = new ROLEMODEL();
        $mysqli = Config::OpenDBConnection();
        $query = "select * from user_role where UID=? order by JOINDATE DESC";
        $stmt = Config::CreateStatement($mysqli, $query);
		$stmt->bind_param("i", $uid);
        $stmt->bind_result($model->ID,$model->UID,$model->ROLE,$model->FEATURE,$model->ISACTIVE);
        $stmt->execute();
        $list = array();
        while ($stmt->fetch()) {
            $obj = new ROLEMODEL();
            Utils::COPY_ROW_TO_OBJ($obj, $model);
            $list[$obj->UID] = $obj;
        }
        $mysqli->close();
        return $list;
    }		
	
 public static function ReadSingle($id) {
        $model = new ROLEMODEL();
		$mysqli = Config::OpenDBConnection();		
        $query = "select * from user_role where ID =?";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->bind_param("i", $id);	
        $stmt->bind_result($model->ID,$model->USERID,$model->ROLE,$model->FEATURE,$model->ISACTIVE);
	 
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
        $model = new ROLEMODEL();
		$mysqli = Config::OpenDBConnection();		
        $query = "select * from user_role where USERID =$USERID";
        $stmt = Config::CreateStatement($mysqli, $query);
       /// $stmt->bind_param("i", $USERID);	
        $stmt->bind_result($model->ID,$model->USERID,$model->ROLE,$model->FEATURE,$model->ISACTIVE);
	 
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
