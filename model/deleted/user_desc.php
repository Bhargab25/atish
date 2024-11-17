<?php

class USR_DSC_MODEL extends BaseModel {

    public $ID; // USER ID
	public $UID; // COMPANY UNIQUE ID
    // int primary key auto_increment,
    public $DESCRIPTION; // USER FULL NAME
    // varchar(15),
    public $ISACTIVE; //USER EMAIL ID
   

    //id ,    restaurantname ,    contactname ,    address ,    contactphone ,    loginid ,    password ,    lastlogin ,    isactive



    function __construct() {
        parent::__construct();
        //$this->examcatid=Validator::Key($keys['layout_welcome_index_label');
    }
public static function Create(USR_DSC_MODEL $USR_DSC_MODEL) {
        $mysqli = Config::OpenDBConnection();
        $query = "INSERT INTO `user_desc`(`ID`, `UID`, `DESCRIPTION`, `ISACTIVE`) values('$USR_DSC_MODEL->ID','$USR_DSC_MODEL->UID','$USR_DSC_MODEL->DESCRIPTION','$USR_DSC_MODEL->ISACTIVE')";
	
        $stmt = Config::CreateStatement($mysqli, $query);
    
        $stmt->execute();
        $id = $mysqli->insert_id;
        $mysqli->close();
        return $id;
    }
	
public static function Update(USR_DSC_MODEL $model) {
         $mysqli = Config::OpenDBConnection();
		/// echo "update apointment set time='$time',date='$date' and status='pending' where id=$id";
        $query = "update user_desc set DESCRIPTION=? where UID=?";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->bind_param("si",$model->DESCRIPTION,$model->UID);
        $stmt->execute();
        $mysqli->close();
	return($model->UID);
	}	
	
public static function ReadAll() {
        $USR_DSC_MODEL = new USR_DSC_MODEL();
        $mysqli = Config::OpenDBConnection();
        $query = "select * from user_desc order by ID DESC";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->bind_result($USR_DSC_MODEL->ID,$USR_DSC_MODEL->UID,$USR_DSC_MODEL->DESCRIPTION,$USR_DSC_MODEL->ISACTIVE);
        $stmt->execute();
        $list = array();
        while ($stmt->fetch()) {
            $obj = new USR_DSC_MODEL();
            Utils::COPY_ROW_TO_OBJ($obj, $USR_DSC_MODEL);
            $list[$obj->ID] = $obj;
        }
        $mysqli->close();
        return $list;
    }	
	
public static function ReadAllByUID($uid) {
        $model = new USR_DSC_MODEL();
        $mysqli = Config::OpenDBConnection();
        $query = "select * from user_desc where UID=? order by JOINDATE DESC";
        $stmt = Config::CreateStatement($mysqli, $query);
		$stmt->bind_param("i", $uid);
        $stmt->bind_result($USR_DSC_MODEL->ID,$USR_DSC_MODEL->UID,$USR_DSC_MODEL->DESCRIPTION,$USR_DSC_MODEL->ISACTIVE);
        $stmt->execute();
        $list = array();
        while ($stmt->fetch()) {
            $obj = new USR_DSC_MODEL();
            Utils::COPY_ROW_TO_OBJ($obj, $model);
            $list[$obj->UID] = $obj;
        }
        $mysqli->close();
        return $list;
    }		
	
 public static function ReadSingle($id) {
        $USR_DSC_MODEL = new USR_DSC_MODEL();
		$mysqli = Config::OpenDBConnection();		
        $query = "select * from user_desc where UID =?";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->bind_param("i", $id);	
        $stmt->bind_result($USR_DSC_MODEL->ID,$USR_DSC_MODEL->UID,$USR_DSC_MODEL->DESCRIPTION,$USR_DSC_MODEL->ISACTIVE);
	 
		$stmt->execute();
        if ($stmt->fetch()) {
            $mysqli->close();
            return $USR_DSC_MODEL;
        } else {
            $mysqli->close();
            return null;
        }
		    }	
	

}
?>
