<?php

class companymodel extends BaseModel {

    public $CID;
	
    public $CNAME;
    // varchar(15),
    public $DOMAIN;
    //varchar(30),
    public $CONTACTEMAIL;
    //varchar(30),
    public $CONTACTPHONE;
	
	public $ADDRESS;
	public $LAT;
	public $LONG;
	public $CSTRENGTH;
	public $SLOTS;
    public $KEYS;
	public $CREATEDDATE;
	public $MODIFIEDDATE;
    

    //id ,    restaurantname ,    contactname ,    address ,    contactphone ,    loginid ,    password ,    lastlogin ,    isactive



    function __construct() {
        parent::__construct();
        //$this->examcatid=Validator::Key($keys['layout_welcome_index_label');
    }
public static function Create(companymodel $companymodel) {
        $mysqli = Config::OpenDBConnection();
        $query = "insert into company(`CID`, `CNAME`, `DOMAIN`, `CONTACTEMAIL`, `CONTACTPHONE`, `ADDRESS`, `LAT`, `LONG`, `CSTRENGTH`, `SLOT`,`KEYS`, `CREATED-DATE`, `MODIFIED-DATE`) values({$companymodel->__params})";
	
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->bind_param("isssisssiiiss", $companymodel->CID,$companymodel->CNAME,$companymodel->DOMAIN,$companymodel->CONTACTEMAIL,$companymodel->CONTACTPHONE,$companymodel->ADDRESS,$companymodel->LAT,$companymodel->LONG,$companymodel->CSTRENGTH,$companymodel->SLOTS,$companymodel->KEYS,$companymodel->CREATEDDATE,$companymodel->MODIFIEDDATE);
        $stmt->execute();
        $id = $mysqli->insert_id;
        $mysqli->close();
        return $id;
    }
public static function UpdateSetup(companymodel $companymodel) {
        $mysqli = Config::OpenDBConnection();
        $query = "Update company set CNAME='$companymodel->CNAME',DOMAIN='$companymodel->DOMAIN',CONTACTEMAIL='$companymodel->CONTACTEMAIL',CONTACTPHONE='$companymodel->CONTACTPHONE' where CID='$companymodel->CID'";
	
        $stmt = Config::CreateStatement($mysqli, $query);
        //$stmt->bind_param("ssssi", $companymodel->CNAME,$companymodel->DOMAIN,$companymodel->CONTACTEMAIL,$companymodel->CONTACTPHONE,$companymodel->CID);
        $stmt->execute();
        $id = $mysqli->insert_id;
        $mysqli->close();
        return $id;
    }	
public static function ReadSingleByDomain($domain){
	$model = new companymodel();
        $mysqli = Config::OpenDBConnection();
        $query = "select DOMAIN from company where  DOMAIN='$domain'";
       $stmt = Config::CreateStatement($mysqli, $query);
       // $stmt->bind_param('s', $domain);
        $stmt->execute();
        $stmt->bind_result($model->DOMAIN);
        $stmt->execute();
        if ($stmt->fetch()) {
            return $model;
        }
        $stmt->close();
        $mysqli->close();
}

public static function ReadAll() {
        $companymodel = new companymodel();
        $mysqli = Config::OpenDBConnection();
        $query = "select * from company order by CID DESC";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->bind_result($companymodel->CID,$companymodel->CUID,$companymodel->CNAME,$companymodel->DOMAIN,$companymodel->CONTACTEMAIL,$companymodel->CONTACTPHONE,$companymodel->ADDRESS,$companymodel->LAT,$companymodel->LONG,$companymodel->CSTRENGTH,$companymodel->SLOTS,$companymodel->KEYS,$companymodel->CREATEDDATE,$companymodel->MODIFIEDDATE);
        $stmt->execute();
        $list = array();
        while ($stmt->fetch()) {
            $obj = new companymodel();
            Utils::COPY_ROW_TO_OBJ($obj, $companymodel);
            $list[$obj->CID] = $obj;
        }
        $mysqli->close();
        return $list;
    }	
 public static function ReadSingle($id) {
        $model = new companymodel();
		  $mysqli = Config::OpenDBConnection();
	//	echo $id;
         $query = "select * from company where CID =?";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->bind_param("i", $id);
		
        $stmt->bind_result($model->CID,$model->CNAME,$model->DOMAIN,$model->CONTACTEMAIL,$model->CONTACTPHONE,$model->ADDRESS,$model->LAT,$model->LONG,$model->CSTRENGTH,$model->SLOTS,$model->KEYS,$model->CREATEDDATE,$model->MODIFIEDDATE);
		$stmt->execute();
        if ($stmt->fetch()) {
            $mysqli->close();
            return $model;
        } else {
            $mysqli->close();
            return null;
        }
		    }
public static function  generate_company_uniqueId($length = 6,$cname,$phone) {
    $characters = $cname.$phone;
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}	

}
?>
