<?php
class ASCAT_MODEL extends BaseModel {

    public $ID; 
	    // int primary key auto_increment,
	public $NAME;
	public $IMAGE;
	 public $CREATEDATE; //USER EMAIL ID
	public $ISACTIVE;

    //id ,    restaurantname ,    contactname ,    address ,    contactphone ,    loginid ,    password ,    lastlogin ,    isactive



    function __construct() {
        parent::__construct();
        //$this->examcatid=Validator::Key($keys['layout_welcome_index_label');
    }
public static function Create(ASCAT_MODEL $ASCAT_MODEL) {
        $mysqli = Config::OpenDBConnection();
        $query = "INSERT INTO `assets_category`(`ID`, `NAME`,`IMAGE`, `CREATEDATE`, `ISACTIVE`) values(NULL,'$ASCAT_MODEL->NAME','$ASCAT_MODEL->IMAGE','$ASCAT_MODEL->CREATEDATE','$ASCAT_MODEL->ISACTIVE')";
        $stmt = Config::CreateStatement($mysqli, $query);       
	    $stmt->execute();
        $id = $mysqli->insert_id;
        $mysqli->close();
        return $id;
    }
	

	
public static function ReadAll() {
        $ASCAT_MODEL = new ASCAT_MODEL();
        $mysqli = Config::OpenDBConnection();
        $query = "select * from assets_category order by ID DESC";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->bind_result($ASCAT_MODEL->ID,$ASCAT_MODEL->NAME,$ASCAT_MODEL->IMAGE,$ASCAT_MODEL->CREATEDATE,$ASCAT_MODEL->ISACTIVE);
        $stmt->execute();
        $list = array();
        while ($stmt->fetch()) {
            $obj = new ASCAT_MODEL();
            Utils::COPY_ROW_TO_OBJ($obj, $ASCAT_MODEL);
            $list[] = $obj;
        }
        $mysqli->close();
        return $list;
    }	
	
	
 public static function ReadSingle($id) {
        $ASCAT_MODEL = new ASCAT_MODEL();
		$mysqli = Config::OpenDBConnection();		
        $query = "select * from assets_category where ID =?";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->bind_param("i", $id);	
        $stmt->bind_result($ASCAT_MODEL->ID,$ASCAT_MODEL->NAME,$ASCAT_MODEL->IMAGE,$ASCAT_MODEL->CREATEDATE,$ASCAT_MODEL->ISACTIVE);
	 
		$stmt->execute();
        if ($stmt->fetch()) {
            $mysqli->close();
            return $ASCAT_MODEL;
        } else {
            $mysqli->close();
            return null;
        }
}	
 public static function ReadSingleByName($name) {
        $ASCAT_MODEL = new ASCAT_MODEL();
		$mysqli = Config::OpenDBConnection();		
        $query = "select * from assets_category where NAME =?";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->bind_param("s", $name);	
        $stmt->bind_result($ASCAT_MODEL->ID,$ASCAT_MODEL->NAME,$ASCAT_MODEL->IMAGE,$ASCAT_MODEL->CREATEDATE,$ASCAT_MODEL->ISACTIVE);
	 
		$stmt->execute();
        if ($stmt->fetch()) {
            $mysqli->close();
            return $ASCAT_MODEL;
        } else {
            $mysqli->close();
            return null;
        }
}    
public static function delete($id){
	 $mysqli = Config::OpenDBConnection();
	 $query = "delete FROM assets_category where ID=".$id;
	$stmt = Config::CreateStatement($mysqli, $query);
	//$stmt->bind_param("i", $id);
	$stmt->execute();
	$mysqli->close();
} 	

}
?>
