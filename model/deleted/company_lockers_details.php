<?php

class COMP_FADO_DETAILS extends BaseModel {

    public $ID; // USER ID
	public $C_UID; // COMPANY UNIQUE ID
    // int primary key auto_increment,
    public $FADO_STORAGE_ID; // LOCATION NAME
    // varchar(15),
    public $MODULE_TYPE; //branch address
	public $OCCUPIED;
	public $HOURLY_RATE;
	public $STATUS;// space or it resources
	
    //id ,    restaurantname ,    contactname ,    address ,    contactphone ,    loginid ,    password ,    lastlogin ,    isactive



    function __construct() {
        parent::__construct();
        //$this->examcatid=Validator::Key($keys['layout_welcome_index_label');
    }
   public static function Create(COMP_FADO_DETAILS $model) {
        $mysqli = Config::OpenDBConnection();
        $query = "INSERT INTO `company_lockers_details`(`ID`, `C_UID`, `FADO_STORAGE_ID`, `MODULE_TYPE`, `OCCUPIED`,`HOURLY_RATE` `STATUS`) VALUES (NULL, '$model->C_UID', '$model->FADO_STORAGE_ID', '$model->MODULE_TYPE','$model->OCCUPIED','$model->HOURLY_RATE','$model->STATUS')";
	
        $stmt = Config::CreateStatement($mysqli, $query);
    
        $stmt->execute();
        $id = $mysqli->insert_id;
        $mysqli->close();
        return $id;
    }
	
public static function update($C_UID,$sid,$mod,$occup) {
         $mysqli = Config::OpenDBConnection();
		/// echo "update apointment set time='$time',date='$date' and status='pending' where id=$id";
        $query = 'update company_lockers_details set OCCUPIED='.$occup.' where C_UID='.$C_UID.' and FADO_STORAGE_ID='.$sid .' and MODULE_TYPE="'.$mod.'"';
        $stmt = Config::CreateStatement($mysqli, $query);
        //$stmt->bind_param("iis",$C_UID,$sid,$mod);
        $stmt->execute();
        $mysqli->close();
	}

public static function Set_Rate($C_UID,$sid,$mod,$rate) {
         $mysqli = Config::OpenDBConnection();
		/// echo "update apointment set time='$time',date='$date' and status='pending' where id=$id";
        $query = 'update company_lockers_details set HOURLY_RATE='.$rate.' where C_UID='.$C_UID.' and FADO_STORAGE_ID='.$sid .' and MODULE_TYPE="'.$mod.'"';
        $stmt = Config::CreateStatement($mysqli, $query);
        //$stmt->bind_param("iis",$C_UID,$sid,$mod);
        $stmt->execute();
        $mysqli->close();
	}	
  
	
public static function ReadAll() {
        $model = new COMP_FADO_DETAILS();
        $mysqli = Config::OpenDBConnection();
        $query = "select * from company_lockers_details order by ID DESC";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->bind_result($model->ID, $model->C_UID, $model->FADO_STORAGE_ID, $model->MODULE_TYPE,$model->OCCUPIED,$model->HOURLY_RATE,$model->STATUS);
        $stmt->execute();
        $list = array();
        while ($stmt->fetch()) {
            $obj = new COMP_FADO_DETAILS();
            Utils::COPY_ROW_TO_OBJ($obj, $model);
            $list[$obj->ID] = $obj;
        }
        $mysqli->close();
        return $list;
    }	
public static function ReadSingleByCompany($C_UID,$sid,$mod) {
        $model = new COMP_FADO_DETAILS();
        $mysqli = Config::OpenDBConnection();
        $query = "select * from company_lockers_details where C_UID=? and FADO_STORAGE_ID=? and MODULE_TYPE=? order by ID DESC";
        $stmt = Config::CreateStatement($mysqli, $query);
	    $stmt->bind_param("iis", $C_UID,$sid,$mod);
        $stmt->bind_result($model->ID, $model->C_UID, $model->FADO_STORAGE_ID, $model->MODULE_TYPE,$model->OCCUPIED,$model->HOURLY_RATE,$model->STATUS);
        $stmt->execute();
        if ($stmt->fetch()) {
            $mysqli->close();
            return $model;
        } else {
            $mysqli->close();
            return null;
        }
		    
    }	
	
public static function ReadAllComp($C_UID) {
        $model = new COMP_FADO_DETAILS();
        $mysqli = Config::OpenDBConnection();
        $query = "select * from company_lockers_details where C_UID=?   order by ID DESC";
        $stmt = Config::CreateStatement($mysqli, $query);
	    $stmt->bind_param("i", $C_UID);
        $stmt->bind_result($model->ID, $model->C_UID, $model->FADO_STORAGE_ID, $model->MODULE_TYPE,$model->OCCUPIED,$model->HOURLY_RATE,$model->STATUS);
        $stmt->execute();
        $list = array();
        while ($stmt->fetch()) {
            $obj = new COMP_FADO_DETAILS();
            Utils::COPY_ROW_TO_OBJ($obj, $model);
            $list[$obj->ID] = $obj;
        }
        $mysqli->close();
        return $list; 
		    
    }	
	
 public static function ReadSingle($id) {
        $model = new COMP_FADO_DETAILS();
		  $mysqli = Config::OpenDBConnection();
		
         $query = "select * from company_lockers_details where ID =?";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->bind_param("i", $id);
		
        $stmt->bind_result($model->ID, $model->C_UID, $model->FADO_STORAGE_ID, $model->MODULE_TYPE,$model->OCCUPIED,$model->HOURLY_RATE,$model->STATUS);
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
