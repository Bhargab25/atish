<?php

class LOCATION_TAG extends BaseModel {

    public $ID; // USER ID
	public $CID; // COMPANY UNIQUE ID
    // int primary key auto_increment,
    public $NAME; // LOCATION NAME
    // varchar(15),
    public $ADDRESS; //branch address
	public $LAT;
	public $LONG;
	public $STATUS;

    //id ,    restaurantname ,    contactname ,    address ,    contactphone ,    loginid ,    password ,    lastlogin ,    isactive



    function __construct() {
        parent::__construct();
        //$this->examcatid=Validator::Key($keys['layout_welcome_index_label');
    }
   public static function Create(LOCATION_TAG $model) {
        $mysqli = Config::OpenDBConnection();
        $query = "INSERT INTO `location_tag`(`ID`, `CID`, `NAME`, `ADDRESS`, `LAT`, `LONG`, `STATUS`) VALUES ('$model->ID', '$model->CID', '$model->NAME', '$model->ADDRESS','$model->LAT','$model->LONG','$model->STATUS')";
	
        $stmt = Config::CreateStatement($mysqli, $query);
    
        $stmt->execute();
        $id = $mysqli->insert_id;
        $mysqli->close();
        return $id;
    }
	

  
	
public static function ReadAll() {
        $model = new LOCATION_TAG();
        $mysqli = Config::OpenDBConnection();
        $query = "select * from location_tag order by ID DESC";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->bind_result($model->ID,$model->CID,$model->NAME,$model->ADDRESS,$model->LAT,$model->LONG,$model->STATUS);
        $stmt->execute();
        $list = array();
        while ($stmt->fetch()) {
            $obj = new LOCATION_TAG();
            Utils::COPY_ROW_TO_OBJ($obj, $model);
            $list[$obj->ID] = $obj;
        }
        $mysqli->close();
        return $list;
    }	
 public static function ReadSingle($id) {
        $model = new LOCATION_TAG();
		  $mysqli = Config::OpenDBConnection();
		
         $query = "select * from location_tag where ID =?";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->bind_param("i", $id);
		
        $stmt->bind_result($model->ID,$model->CID,$model->NAME,$model->ADDRESS,$model->LAT,$model->LONG,$model->STATUS);
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
