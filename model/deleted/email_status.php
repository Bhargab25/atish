<?php

class EmailBook_MODEL extends BaseModel {

    public $ID; // UNIQUE ID
	//primary field integer 11
	public $BID; // USER UNIQUE ID
    // unique field integer 11,
    public $TYPE;//[BOOKING,REGISTRATION,ALERT]
    public $ALERT_COUNT;
    public $SENT; //TRUE[1] OR FALSE[0]
    public $CREATEDATE;
    
    



   
public static function Create(EmailBook_MODEL $model) {
        $mysqli = Config::OpenDBConnection();
        $query = "INSERT INTO `email_status`(`ID`, `BID`, `TYPE`,`ALERT_COUNT`, `SENT`,`CREATEDATE`) values(NULL,'$model->BID','$model->TYPE','$model->ALERT_COUNT',$model->SENT,'$model->CREATEDATE')";
	
        $stmt = Config::CreateStatement($mysqli, $query);
    
        $stmt->execute();
        $id = $mysqli->insert_id;
        $mysqli->close();
        return $id;
    }
	

	
public static function ReadAll() {
        $model = new EmailBook_MODEL();
        $mysqli = Config::OpenDBConnection();
        $query = "select * from Notification order by ID DESC";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->bind_result($model->ID,$model->USERID,$model->ROLE,$model->FEATURE,$model->ISACTIVE);
        $stmt->execute();
        $list = array();
        while ($stmt->fetch()) {
            $obj = new EmailBook_MODEL();
            Utils::COPY_ROW_TO_OBJ($obj, $model);
            $list[$obj->ID] = $obj;
        }
        $mysqli->close();
        return $list;
    }	
	
public static function ReadAllByBid($bid,$type) {
        $model = new EmailBook_MODEL();
        $mysqli = Config::OpenDBConnection();
        $query = "select * from Notification where BID=? and `TYPE`=? order by ID DESC";
        $stmt = Config::CreateStatement($mysqli, $query);
		$stmt->bind_param("is", $bid,$type);
        $stmt->bind_result($model->ID,$model->BID,$model->TYPE,$model->ALERT_COUNT,$model->SENT,$model->CREATEDATE);
        $stmt->execute();
        $list = array();
        while ($stmt->fetch()) {
            $obj = new EmailBook_MODEL();
            Utils::COPY_ROW_TO_OBJ($obj, $model);
            $list[$obj->ID] = $obj;
        }
        $mysqli->close();
        return $list;
    }		
	
 public static function ReadSingle($id) {
        $model = new EmailBook_MODEL();
		$mysqli = Config::OpenDBConnection();		
        $query = "select * from Notification where ID =?";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->bind_param("i", $id);	
        $stmt->bind_result($model->ID,$model->BID,$model->TYPE,$model->ALERT_COUNT,$model->SENT,$model->CREATEDATE);
	 
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
        $model = new EmailBook_MODEL();
		$mysqli = Config::OpenDBConnection();		
        $query = "select * from Notification where USERID =$USERID";
        $stmt = Config::CreateStatement($mysqli, $query);
       /// $stmt->bind_param("i", $USERID);	
        $stmt->bind_result($model->ID,$model->BID,$model->TYPE,$model->ALERT_COUNT,$model->SENT,$model->CREATEDATE);
	 
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
