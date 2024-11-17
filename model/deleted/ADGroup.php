<?php

class GroupModel extends BaseModel {

    public $ID; // USER ID
    // int primary key auto_increment,
	public $GNAME; // Group Name from AD
    // varchar(33),
    public $email;
    public $KEYRACKS; // CSV Array
    // varchar(33),
    public $ISACTIVE; //USER EMAIL ID
    //Tiny Int - true or false boolean value
    function __construct() {
        parent::__construct();
        //$this->examcatid=Validator::Key($keys['layout_welcome_index_label');
    }
public static function Create(GroupModel $model) {
        $mysqli = Config::OpenDBConnection();
        $query = "INSERT INTO `AD_Group` (`ID`, `GNAME`,`email`, `KEYRACKS`, `ISACTIVE`) values(NULL,'$model->GNAME','$model->email','$model->KEYRACKS','$model->ISACTIVE')";
        $stmt = Config::CreateStatement($mysqli, $query);  
        $stmt->execute();
        $id = $mysqli->insert_id;
        $mysqli->close();
        return $id;
    }

public static function Update(GroupModel $model) {
         $mysqli = Config::OpenDBConnection();
		/// echo "update apointment set time='$time',date='$date' and status='pending' where id=$id";
        $query = "update AD_Group set GNAME=?,ISACTIVE=? where ID=?";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->bind_param("sii",$model->GNAME,$model->ISACTIVE,$model->ID);
        $stmt->execute();
        $mysqli->close();
	return($model->USERID);
	}	
public static function UpdateByGrp(GroupModel $model) {
         $mysqli = Config::OpenDBConnection();
		/// echo "update apointment set time='$time',date='$date' and status='pending' where id=$id";
        $query = "update AD_Group set KEYRACKS=? where GNAME=?";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->bind_param("ss",$model->KEYRACKS,$model->GNAME);
        $stmt->execute();
        $mysqli->close();
	return($model->GNAME);
	}    
public static function UpdateByemail(GroupModel $model) {
         $mysqli = Config::OpenDBConnection();
		/// echo "update apointment set time='$time',date='$date' and status='pending' where id=$id";
        $query = "update AD_Group set KEYRACKS=? where email=?";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->bind_param("ss",$model->KEYRACKS,$model->email);
        $stmt->execute();
        $mysqli->close();
	return($model->email);
	} 	
public static function ReadAll() {
        $model = new GroupModel();
        $mysqli = Config::OpenDBConnection();
        $query = "select * from AD_Group order by ID DESC";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->bind_result($model->ID, $model->GNAME,$model->email,$model->KEYRACKS, $model->ISACTIVE);
        $stmt->execute();
        $list = array();
        while ($stmt->fetch()) {
            $obj = new GroupModel();
            Utils::COPY_ROW_TO_OBJ($obj, $model);
            $list[$obj->ID] = $obj;
        }
        $mysqli->close();
        return $list;
    }	
 public static function ReadSingle($id) {
        $model = new GroupModel();
		$mysqli = Config::OpenDBConnection();
        $query = "select * from AD_Group where ID =?";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->bind_param("i", $id);		
        $stmt->bind_result($model->ID, $model->GNAME,$model->email,$model->KEYRACKS, $model->ISACTIVE);
		$stmt->execute();
        if ($stmt->fetch()) {
            $mysqli->close();
            return $model;
        } else {
            $mysqli->close();
            return null;
        }
		    }	
	
public static function ReadSingleByGNAME($GNAME) {
        $model = new GroupModel();
		$mysqli = Config::OpenDBConnection();
        $query = "select * from AD_Group where GNAME =?";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->bind_param("s", $GNAME);		
        $stmt->bind_result($model->ID, $model->GNAME,$model->email, $model->KEYRACKS, $model->ISACTIVE);
		$stmt->execute();
        if ($stmt->fetch()) {
            $mysqli->close();
            return $model;
        } else {
            $mysqli->close();
            return null;
        }
		    }	
public static function ReadSingleByemail($email) {
        $model = new GroupModel();
		$mysqli = Config::OpenDBConnection();
        $query = "select * from AD_Group where email =?";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->bind_param("s", $email);		
        $stmt->bind_result($model->ID, $model->GNAME,$model->email, $model->KEYRACKS, $model->ISACTIVE);
		$stmt->execute();
        if ($stmt->fetch()) {
            $mysqli->close();
            return $model;
        } else {
            $mysqli->close();
            return null;
        }
		    }    
    
    
public static function Delete($id) {
        $mysqli = Config::OpenDBConnection();
        $query = "delete from AD_Group where ID=?";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $mysqli->close();
    }     
}
?>
