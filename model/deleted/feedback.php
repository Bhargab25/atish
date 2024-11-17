<?php

class Feedback_Model extends BaseModel {

    public $ID; // PRIMARY KEY ID
    // int primary key auto_increment,
	public $USERID; // USER UNIQUE ID
    
    public $QID; // USER FULL NAME
    // varchar(15),
    public $ANSWER; //USER EMAIL ID
    public $BOOTHID;
    public $CREATEDDATE;
    //varchar(30),
   

    function __construct() {
        parent::__construct();
        //$this->examcatid=Validator::Key($keys['layout_welcome_index_label');
    }
public static function Create(Feedback_Model $model) {
        $mysqli = Config::OpenDBConnection();
        $query = "insert into feedback ({$model->__columns}) values(NULL, '$model->USERID', '$model->QID', '$model->ANSWER','$model->BOOTHID','$model->CREATEDDATE')";
    $stmt = Config::CreateStatement($mysqli, $query);
     
        
        $stmt->execute();
        $id = $mysqli->insert_id;
        $mysqli->close();
        return $id;
    }
public static function Update_Answer(Feedback_Model $model) {
         $mysqli = Config::OpenDBConnection();
        $query = "update feedback set ANSWER='$model->ANSWER' where ID='$model->ID'";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->execute();
        $mysqli->close();
	return($model->ID);
	}	

    
public static function activate($boothid) {
         $mysqli = Config::OpenDBConnection();
        $query = "update feedback set `ISACTIVE`='1' where ID='$boothid'";
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
        $model = new Feedback_Model();
        $mysqli = Config::OpenDBConnection();
        $query = "select * from feedback order by ID DESC";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->bind_result($model->ID, $model->USERID, $model->QID,$model->ANSWER,$model->BOOTHID,$model->CREATEDDATE);
        $stmt->execute();
        $list = array();
        while ($stmt->fetch()) {
            $obj = new Feedback_Model();
            Utils::COPY_ROW_TO_OBJ($obj,$model);
            $list[$obj->ID] = $obj;
        }
        $mysqli->close();
        return $list;
    }
  
 
 public static function ReadSingle($id) {
        $model = new Feedback_Model();
		  $mysqli = Config::OpenDBConnection();
		
         $query = "select * from feedback where ID =?";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->bind_param("i", $id);
		
        $stmt->bind_result($model->ID, $model->USERID, $model->QID,$model->ANSWER,$model->BOOTHID,$model->CREATEDDATE);
		$stmt->execute();
        if ($stmt->fetch()) {
            $mysqli->close();
            return $model;
        } else {
            $mysqli->close();
            return null;
        }
		    }
 public static function ReadSingleByBoothQid($uid,$bid,$qid) {
        $model = new Feedback_Model();
		  $mysqli = Config::OpenDBConnection();
		
         $query = "select * from feedback where `USERID`=? and BOOTHID =? and `QID`=?";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->bind_param("iii", $uid,$bid,$qid);
		
        $stmt->bind_result($model->ID, $model->USERID, $model->QID,$model->ANSWER,$model->BOOTHID,$model->CREATEDDATE);
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
