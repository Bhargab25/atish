<?php

class EMAIL_MODEL extends BaseModel {

    public $ID; // USER ID
	public $NAME; // COMPANY UNIQUE ID
    // int primary key auto_increment,
    public $SUBJECT; // USER FULL NAME
    // varchar(15),
    public $BODY; //USER EMAIL ID
    public $ISACTIVE; // enum app,rfid,finger,face

    //id ,    restaurantname ,    contactname ,    address ,    contactphone ,    loginid ,    password ,    lastlogin ,    isactive



    function __construct() {
        parent::__construct();
        //$this->examcatid=Validator::Key($keys['layout_welcome_index_label');
    }
   public static function Create(EMAIL_MODEL $model) {
        $mysqli = Config::OpenDBConnection();
        $query = "INSERT INTO `email_template`(`ID`, `NAME`, `SUBJECT`, `BODY`, `ISACTIVE`) VALUES (NULL, '$model->NAME', '$model->SUBJECT', '$model->BODY','0')";
	
        $stmt = Config::CreateStatement($mysqli, $query);
    
        $stmt->execute();
        $id = $mysqli->insert_id;
        $mysqli->close();
        return $id;
    }
	

public static function update(EMAIL_MODEL $model) {
         $mysqli = Config::OpenDBConnection();
		/// echo "update apointment set time='$time',date='$date' and status='pending' where id=$id";
        $query = 'update email_template set `SUBJECT`="'.$model->SUBJECT.'",`BODY`="'.$model->BODY.'" where ID= '.$model->ID;
        $stmt = Config::CreateStatement($mysqli, $query);
        //$stmt->bind_param("iis",$C_UID,$sid,$mod);
        $stmt->execute();
        $mysqli->close();
	}
  
	
public static function ReadAll() {
        $model = new EMAIL_MODEL();
        $mysqli = Config::OpenDBConnection();
        $query = "select * from email_template order by ID DESC";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->bind_result($model->ID,$model->NAME,$model->SUBJECT,$model->BODY,$model->ISACTIVE);
        $stmt->execute();
        $list = array();
        while ($stmt->fetch()) {
            $obj = new EMAIL_MODEL();
            Utils::COPY_ROW_TO_OBJ($obj, $model);
            $list[$obj->ID] = $obj;
        }
        $mysqli->close();
        return $list;
    }	
 public static function ReadSingle($id) {
        $model = new EMAIL_MODEL();
		  $mysqli = Config::OpenDBConnection();
		
         $query = "select * from email_template where ID =?";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->bind_param("i", $id);
		
        $stmt->bind_result($model->ID,$model->NAME,$model->SUBJECT,$model->BODY,$model->ISACTIVE);
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
