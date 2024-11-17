<?php

class FADO_CATEGORY extends BaseModel {

    public $ID; // USER ID
	public $TYPE; // COMPANY UNIQUE ID
    // int primary key auto_increment,
    public $AVAILABLE; // LOCATION NAME
    // varchar(15),
    public $OCCUPIED; //branch address
	public $TOTAL;
	public $MODULE_TYPE;// space or it resources
	public $HOURLY_RATE;
	public $STATUS;
	
    //id ,    restaurantname ,    contactname ,    address ,    contactphone ,    loginid ,    password ,    lastlogin ,    isactive



    function __construct() {
        parent::__construct();
        //$this->examcatid=Validator::Key($keys['layout_welcome_index_label');
    }
   public static function Create(FADO_CATEGORY $model) {
        $mysqli = Config::OpenDBConnection();
        $query = "INSERT INTO `fado_storage_category`(`ID`, `TYPE`, `AVAILABLE`, `OCCUPIED`, `TOTAL`,`MODULE_TYPE`,`HOURLY_RATE`, `STATUS`) VALUES (NULL, '$model->TYPE', '$model->AVAILABLE', '$model->OCCUPIED','$model->MODULE_TYPE','$model->HOURLY_RATE','$model->TOTAL')";
	
        $stmt = Config::CreateStatement($mysqli, $query);
    
        $stmt->execute();
        $id = $mysqli->insert_id;
        $mysqli->close();
        return $id;
    }
	

  
	
public static function ReadAll() {
        $model = new FADO_CATEGORY();
        $mysqli = Config::OpenDBConnection();
        $query = "select * from fado_storage_category order by ID DESC";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->bind_result($model->ID,$model->TYPE,$model->AVAILABLE,$model->OCCUPIED,$model->MODULE_TYPE,$model->HOURLY_RATE,$model->TOTAL);
        $stmt->execute();
        $list = array();
        while ($stmt->fetch()) {
            $obj = new FADO_CATEGORY();
            Utils::COPY_ROW_TO_OBJ($obj, $model);
            $list[$obj->ID] = $obj;
        }
        $mysqli->close();
        return $list;
    }	
public static function ReadAllbyModule($module) {
        $model = new FADO_CATEGORY();
        $mysqli = Config::OpenDBConnection();
        $query = "select * from fado_storage_category where MODULE_TYPE='".$module."' order by ID DESC";
        $stmt = Config::CreateStatement($mysqli, $query);
		// $stmt->bind_param("s", $module);
        $stmt->bind_result($model->ID,$model->TYPE,$model->AVAILABLE,$model->OCCUPIED,$model->TOTAL,$model->MODULE_TYPE,$model->HOURLY_RATE,$model->STATUS);
        $stmt->execute();
        $list = array();
        while ($stmt->fetch()) {
            $obj = new FADO_CATEGORY();
            Utils::COPY_ROW_TO_OBJ($obj, $model);
            $list[$obj->ID] = $obj;
        }
        $mysqli->close();
        return $list;
    }	
 public static function ReadSingle($id) {
	 //echo $id;
        $model = new FADO_CATEGORY();
		  $mysqli = Config::OpenDBConnection();
		
         $query = "select * from fado_storage_category where ID =?";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->bind_param("i", $id);
		
        $stmt->bind_result($model->ID,$model->TYPE,$model->AVAILABLE,$model->OCCUPIED,$model->TOTAL,$model->MODULE_TYPE,$model->HOURLY_RATE,$model->STATUS);
		$stmt->execute();
        if ($stmt->fetch()) {
            $mysqli->close();
            return $model;
        } else {
            $mysqli->close();
            return null;
        }
		    }	
	
public static function ReadSingleByModule($id,$MODULE_TYPE) {
	 //echo $id;
        $model = new FADO_CATEGORY();
		  $mysqli = Config::OpenDBConnection();
		
         $query = "select * from fado_storage_category where ID =? and MODULE_TYPE=?";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->bind_param("is", $id,$MODULE_TYPE);
		
        $stmt->bind_result($model->ID,$model->TYPE,$model->AVAILABLE,$model->OCCUPIED,$model->TOTAL,$model->MODULE_TYPE,$model->HOURLY_RATE,$model->STATUS);
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
