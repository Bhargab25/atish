<?php

class EMPLOYEMENT_MODEL extends BaseModel {

    public $ID; // USER ID
	public $UID; // COMPANY UNIQUE ID
    // int primary key auto_increment,
    public $COMPANY_NAME; // USER FULL NAME
    // varchar(15),
    public $DESIGNATION; //USER EMAIL ID
    //varchar(30),
    public $JOINDATE;
    //varchar(30),
    public $RELEASEDATE;
	
	public $LOCATION;
	

    //id ,    restaurantname ,    contactname ,    address ,    contactphone ,    loginid ,    password ,    lastlogin ,    isactive



    function __construct() {
        parent::__construct();
        //$this->examcatid=Validator::Key($keys['layout_welcome_index_label');
    }
public static function Create(EMPLOYEMENT_MODEL $EMPLOYEMENT_MODEL) {
        $mysqli = Config::OpenDBConnection();
        $query = "INSERT INTO `user_employement`(`ID`, `UID`, `COMPANY_NAME`, `DESIGNATION`, `JOINDATE`, `RELEASEDATE`, `LOCATION`) values('$EMPLOYEMENT_MODEL->ID','$EMPLOYEMENT_MODEL->UID','$EMPLOYEMENT_MODEL->COMPANY_NAME','$EMPLOYEMENT_MODEL->DESIGNATION','$EMPLOYEMENT_MODEL->JOINDATE','$EMPLOYEMENT_MODEL->RELEASEDATE','$EMPLOYEMENT_MODEL->LOCATION')";
	
        $stmt = Config::CreateStatement($mysqli, $query);
    
        $stmt->execute();
        $id = $mysqli->insert_id;
        $mysqli->close();
        return $id;
    }
	

	
public static function ReadAll() {
        $EMPLOYEMENT_MODEL = new EMPLOYEMENT_MODEL();
        $mysqli = Config::OpenDBConnection();
        $query = "select * from user_employement order by ID DESC";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->bind_result($EMPLOYEMENT_MODEL->ID,$EMPLOYEMENT_MODEL->UID,$EMPLOYEMENT_MODEL->COMPANY_NAME,$EMPLOYEMENT_MODEL->DESIGNATION,$EMPLOYEMENT_MODEL->JOINDATE,$EMPLOYEMENT_MODEL->RELEASEDATE,$EMPLOYEMENT_MODEL->LOCATION);
        $stmt->execute();
        $list = array();
        while ($stmt->fetch()) {
            $obj = new EMPLOYEMENT_MODEL();
            Utils::COPY_ROW_TO_OBJ($obj, $model);
            $list[$obj->ID] = $obj;
        }
        $mysqli->close();
        return $list;
    }	
	
public static function ReadAllByUID($uid) {
        $model = new EMPLOYEMENT_MODEL();
        $mysqli = Config::OpenDBConnection();
        $query = "select * from user_employement where UID='$uid' order by JOINDATE DESC";
        $stmt = Config::CreateStatement($mysqli, $query);
		//$stmt->bind_param("i", $uid);
        $stmt->bind_result($model->ID,$model->UID,$model->COMPANY_NAME,$model->DESIGNATION,$model->JOINDATE,$model->RELEASEDATE,$model->LOCATION);
        $stmt->execute();
        $list = array();
        while ($stmt->fetch()) {
            $obj = new EMPLOYEMENT_MODEL();
            Utils::COPY_ROW_TO_OBJ($obj, $model);
            $list[] = $obj;
        }
        $mysqli->close();
	//print_r($list);
        return $list;
    }		
	
 public static function ReadSingle($id) {
        $EMPLOYEMENT_MODEL = new EMPLOYEMENT_MODEL();
		$mysqli = Config::OpenDBConnection();		
        $query = "select * from user_employement where ID =?";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->bind_param("i", $id);	
        $stmt->bind_result($EMPLOYEMENT_MODEL->ID,$EMPLOYEMENT_MODEL->UID,$EMPLOYEMENT_MODEL->COMPANY_NAME,$EMPLOYEMENT_MODEL->DESIGNATION,$EMPLOYEMENT_MODEL->JOINDATE,$EMPLOYEMENT_MODEL->RELEASEDATE,$EMPLOYEMENT_MODEL->LOCATION);
	 
		$stmt->execute();
        if ($stmt->fetch()) {
            $mysqli->close();
            return $EMPLOYEMENT_MODEL;
        } else {
            $mysqli->close();
            return null;
        }
		    }	
	
public static function ReadSingleByCompany($name) {
        $EMPLOYEMENT_MODEL = new EMPLOYEMENT_MODEL();
		$mysqli = Config::OpenDBConnection();		
        $query = "select * from user_employement where COMPANY_NAME ='".$name."'";
        $stmt = Config::CreateStatement($mysqli, $query);
      //  $stmt->bind_param("s", $name);	
        $stmt->bind_result($EMPLOYEMENT_MODEL->ID,$EMPLOYEMENT_MODEL->UID,$EMPLOYEMENT_MODEL->COMPANY_NAME,$EMPLOYEMENT_MODEL->DESIGNATION,$EMPLOYEMENT_MODEL->JOINDATE,$EMPLOYEMENT_MODEL->RELEASEDATE,$EMPLOYEMENT_MODEL->LOCATION);
	 
		$stmt->execute();
        if ($stmt->fetch()) {
            $mysqli->close();
            return $EMPLOYEMENT_MODEL;
        } else {
            $mysqli->close();
            return null;
        }
		    }	
public static function CurrentEmployement($uid) {
        $EMPLOYEMENT_MODEL = new EMPLOYEMENT_MODEL();
		$mysqli = Config::OpenDBConnection();	
	
        $query = "select * from user_employement where UID ='".$uid."' and RELEASEDATE='0000-00-00'";
        $stmt = Config::CreateStatement($mysqli, $query);
      //  $stmt->bind_param("s", $name);	
        $stmt->bind_result($EMPLOYEMENT_MODEL->ID,$EMPLOYEMENT_MODEL->UID,$EMPLOYEMENT_MODEL->COMPANY_NAME,$EMPLOYEMENT_MODEL->DESIGNATION,$EMPLOYEMENT_MODEL->JOINDATE,$EMPLOYEMENT_MODEL->RELEASEDATE,$EMPLOYEMENT_MODEL->LOCATION);
	 
		$stmt->execute();
        if ($stmt->fetch()) {
            $mysqli->close();
            return $EMPLOYEMENT_MODEL;
        } else {
            $mysqli->close();
            return null;
        }
		    }	
		

}
?>
