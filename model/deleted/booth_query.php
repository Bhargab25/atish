<?php

class BoothQuery_Model extends BaseModel {

    public $ID; // PRIMARY KEY ID
    // int primary key auto_increment,
	public $QUERY; // USER UNIQUE ID
    
    public $BOOTHID; // USER FULL NAME
    // varchar(15),
    public $ISACTIVE; //USER EMAIL ID
    //varchar(30),
   

    function __construct() {
        parent::__construct();
        //$this->examcatid=Validator::Key($keys['layout_welcome_index_label');
    }
public static function Create(BoothQuery_Model $model) {
        $mysqli = Config::OpenDBConnection();
        $query = "insert into booth_query ({$model->__columns}) values(NULL, '$model->QUERY', '$model->BOOTHID', '$model->ISACTIVE')";
    $stmt = Config::CreateStatement($mysqli, $query);
     
        
        $stmt->execute();
        $id = $mysqli->insert_id;
        $mysqli->close();
        return $id;
    }
public static function Update_Booth(BoothQuery_Model $model) {
         $mysqli = Config::OpenDBConnection();
        $query = "update booth_query set BOOTHID='$model->BOOTHID' where ID='$model->ID'";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->execute();
        $mysqli->close();
	return($model->ID);
	}	

    
public static function activate($boothid) {
         $mysqli = Config::OpenDBConnection();
        $query = "update booth_query set `ISACTIVE`='1' where ID='$boothid'";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->execute();
        $mysqli->close();
	return($boothid);
	}
public static function deactivate($boothid) {
         $mysqli = Config::OpenDBConnection();
        $query = "update booths set `ISACTIVE`='1' where ID='$boothid'";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->execute();
        $mysqli->close();
	return($boothid);
	}	
public static function Delete($id) {
         $mysqli = Config::OpenDBConnection();
        $query = "DELETE FROM booths where ID='$id'";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->execute();
        $mysqli->close();
	return($id);}    
public static function ReadAll() {
        $model = new BoothQuery_Model();
        $mysqli = Config::OpenDBConnection();
        $query = "select * from booth_query order by ID DESC";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->bind_result($model->ID, $model->QUERY, $model->BOOTHID,$model->ISACTIVE);
        $stmt->execute();
        $list = array();
        while ($stmt->fetch()) {
            $obj = new BoothQuery_Model();
            Utils::COPY_ROW_TO_OBJ($obj,$model);
            $list[$obj->ID] = $obj;
        }
        $mysqli->close();
        return $list;
    }
  public static function ReadAllByBooth($booth) {
        $model = new BoothQuery_Model();
        $mysqli = Config::OpenDBConnection();
        $query = "select * from booth_query where FIND_IN_SET('$booth', `BOOTHID`) > 0 order by ID DESC";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->bind_result($model->ID, $model->QUERY, $model->BOOTHID,$model->ISACTIVE);
        $stmt->execute();
        $list = array();
        while ($stmt->fetch()) {
            $obj = new BoothQuery_Model();
            Utils::COPY_ROW_TO_OBJ($obj,$model);
            $list[$obj->ID] = $obj;
        }
        $mysqli->close();
        return $list;
    }
 
 public static function ReadSingle($id) {
        $model = new BoothQuery_Model();
		  $mysqli = Config::OpenDBConnection();
		
         $query = "select * from booth_query where ID =?";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->bind_param("i", $id);
		
        $stmt->bind_result($model->ID, $model->QUERY, $model->BOOTHID,$model->ISACTIVE);
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
