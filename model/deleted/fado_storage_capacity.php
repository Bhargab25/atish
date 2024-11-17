<?php

class FADO_CAPACITY extends BaseModel {

    public $ID; // USER ID
	public $STORAGE_ID; // COMPANY UNIQUE ID
    // int primary key auto_increment,
    public $FADO_STORAGE_ID; // LOCATION NAME
    // varchar(15),
 
	public $ASSIGN_TO;
	public $status;
	
    //id ,    restaurantname ,    contactname ,    address ,    contactphone ,    loginid ,    password ,    lastlogin ,    isactive



    function __construct() {
        parent::__construct();
        //$this->examcatid=Validator::Key($keys['layout_welcome_index_label');
    }
   public static function Create(FADO_CAPACITY $model) {
        $mysqli = Config::OpenDBConnection();
        $query = "INSERT INTO `fado_storage_capacity`(`ID`, `STORAGE_ID`, `FADO_STORAGE_ID`, `ASSIGN_TO`, `status`)  VALUES (NULL, '$model->STORAGE_ID', '$model->FADO_STORAGE_ID', '$model->ASSIGN_TO','$model->status')";
	
        $stmt = Config::CreateStatement($mysqli, $query);
    
        $stmt->execute();
        $id = $mysqli->insert_id;
        $mysqli->close();
        return $id;
    }
	

  
	
public static function ReadAll() {
        $model = new FADO_CAPACITY();
        $mysqli = Config::OpenDBConnection();
        $query = "select * from fado_storage_capacity order by ID DESC";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->bind_result($model->ID,$model->STORAGE_ID, $model->FADO_STORAGE_ID, $model->ASSIGN_TO,$model->status);
        $stmt->execute();
        $list = array();
        while ($stmt->fetch()) {
            $obj = new FADO_CAPACITY();
            Utils::COPY_ROW_TO_OBJ($obj, $model);
            $list[$obj->ID] = $obj;
        }
        $mysqli->close();
        return $list;
    }	
	
public static function ReadAllByCOMP($cid,$sid) {
        $model = new FADO_CAPACITY();
        $mysqli = Config::OpenDBConnection();
        $query = "select * from fado_storage_capacity where ASSIGN_TO=? and STORAGE_ID=? order by ID DESC";
        $stmt = Config::CreateStatement($mysqli, $query);
	    $stmt->bind_param("ii", $cid,$sid);
        $stmt->bind_result($model->ID,$model->STORAGE_ID, $model->FADO_STORAGE_ID, $model->ASSIGN_TO,$model->status);
        $stmt->execute();
        $list = array();
        while ($stmt->fetch()) {
            $obj = new FADO_CAPACITY();
            Utils::COPY_ROW_TO_OBJ($obj, $model);
            $list[$obj->ID] = $obj;
        }
        $mysqli->close();
        return $list;
    }	
public static function ReadAllByCOMPID($cid) {
        $model = new FADO_CAPACITY();
        $mysqli = Config::OpenDBConnection();
         $query = "select * from fado_storage_capacity where ASSIGN_TO=? order by ID ASC";
        $stmt = Config::CreateStatement($mysqli, $query);
	    $stmt->bind_param("i", $cid);
        $stmt->bind_result($model->ID,$model->STORAGE_ID, $model->FADO_STORAGE_ID, $model->ASSIGN_TO,$model->status);
        $stmt->execute();
        $list = array();
        while ($stmt->fetch()) {
            $obj = new FADO_CAPACITY();
            Utils::COPY_ROW_TO_OBJ($obj, $model);
            $list[$obj->ID] = $obj;
        }
        $mysqli->close();
        return $list;
    }	
    
public static function ReadAllByCOMPID_bypage($cid,$page_no) {
       // $page_no = $page_no - 16;
        $model = new FADO_CAPACITY();
        $mysqli = Config::OpenDBConnection();
         $query = "select * from fado_storage_capacity where ASSIGN_TO=? order by ID ASC LIMIT ".$page_no.",16";
        $stmt = Config::CreateStatement($mysqli, $query);
	    $stmt->bind_param("i", $cid);
        $stmt->bind_result($model->ID,$model->STORAGE_ID, $model->FADO_STORAGE_ID, $model->ASSIGN_TO,$model->status);
        $stmt->execute();
        $list = array();
        while ($stmt->fetch()) {
            $obj = new FADO_CAPACITY();
            Utils::COPY_ROW_TO_OBJ($obj, $model);
            $list[$obj->ID] = $obj;
        }
        $mysqli->close();
        return $list;
    }	
    
 public static function ReadSingle($id) {
        $model = new FADO_CAPACITY();
		  $mysqli = Config::OpenDBConnection();
		
         $query = "select * from fado_storage_capacity where ID =?";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->bind_param("i", $id);
		
        $stmt->bind_result($model->ID,$model->STORAGE_ID, $model->FADO_STORAGE_ID, $model->ASSIGN_TO,$model->status);
		$stmt->execute();
        if ($stmt->fetch()) {
            $mysqli->close();
            return $model;
        } else {
            $mysqli->close();
            return null;
        }
		    }	
	public static function ReadSingleByLockerid($FADO_STORAGE_ID) {
        $model = new FADO_CAPACITY();
		  $mysqli = Config::OpenDBConnection();
		
         $query = "select * from fado_storage_capacity where FADO_STORAGE_ID =?";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->bind_param("s", $FADO_STORAGE_ID);
		
        $stmt->bind_result($model->ID,$model->STORAGE_ID, $model->FADO_STORAGE_ID, $model->ASSIGN_TO,$model->status);
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
