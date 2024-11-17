<?php

class PlantModel extends BaseModel {

    public $PID; // USER ID
	public $Barcode; // COMPANY UNIQUE ID
    // int primary key auto_increment,
    public $Name; // USER FULL NAME
	 public $Type; // USER FULL NAME
    // varchar(15),
    public $Price; //USER EMAIL ID
    //varchar(30),
    public $Description;
    //varchar(30),
    public $Instock;
	public $Discount;
	public $LastUpdate;
	
	

    //id ,    restaurantname ,    contactname ,    address ,    contactphone ,    loginid ,    password ,    lastlogin ,    isactive



    function __construct() {
        parent::__construct();
        //$this->examcatid=Validator::Key($keys['layout_welcome_index_label');
    }
public static function Create(PlantModel $PlantModel) {
        $mysqli = Config::OpenDBConnection();
        $query = "INSERT INTO `PlantDetails`(`PID`, `Barcode`, `Name`, `Type`, `Price`, `Description`, `Instock`, `Discount`, `LastUpdate`) values(NULL,'$PlantModel->Barcode','$PlantModel->Name','$PlantModel->Type','$PlantModel->Price','$PlantModel->Description','$PlantModel->Instock','$PlantModel->Discount','$PlantModel->LastUpdate')";
	
        $stmt = Config::CreateStatement($mysqli, $query);
    
        $stmt->execute();
        $id = $mysqli->insert_id;
        $mysqli->close();
        return $id;
    }
	

public static function ReadAll() {
        $model = new PlantModel();
        $mysqli = Config::OpenDBConnection();
        $query = "select * from PlantDetails order by ID DESC";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->bind_result($model->ID, $model->Barcode, $model->Name,$model->Type, $model->Price, $model->Description,$model->Instock,$model->Discount,$model->LastUpdate);
   
        $stmt->execute();
        $list = array();
        while ($stmt->fetch()) {
            $obj = new PlantModel();
            Utils::COPY_ROW_TO_OBJ($obj, $model);
            $list[$obj->UID] = $obj;
        }
        $mysqli->close();
        return $list;
    }


 public static function ReadSingle($id) {
        $model = new PlantModel();
		  $mysqli = Config::OpenDBConnection();
        $query = "select * from PlantDetails where ID ='$id'";
        $stmt = Config::CreateStatement($mysqli, $query);
      //  $stmt->bind_param("i", $id);
		
        $stmt->bind_result($model->ID, $model->Role, $model->Fname,$model->Lname, $model->Phone, $model->Email,$model->password,$model->Last_login,$model->Last_logout,$model->isactive);
		$stmt->execute();
        if ($stmt->fetch()) {
            $mysqli->close();
            return($model);
        } else {
            $mysqli->close();
            return null;
        }
		    }	
 public static function ReadSingleByEmail($email) {
        $model = new PlantModel();
		  $mysqli = Config::OpenDBConnection();
		
         $query = "select * from PlantDetails where Email =?";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->bind_param("s", $email);
		
        $stmt->bind_result($model->UID, $model->CID, $model->NAME,$model->ABOUT, $model->EMAIL, $model->PHONE,$model->EMPLOYEE_CODE,$model->CAREER_LEVEL,$model->PASSWORD,$model->CREATEDDATE,$model->MODIFIEDDATE,$model->ISACTIVE);
		$stmt->execute();
        if ($stmt->fetch()) {
            $mysqli->close();
            return $model;
        } else {
            $mysqli->close();
            return null;
        }
		    }
   
public static function Delete($id) {
        $mysqli = Config::OpenDBConnection();
        $query = "delete from PlantDetails where ID=?";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $mysqli->close();
    } 
public static function Deactivate($id) {
        $mysqli = Config::OpenDBConnection();
        $query = "update PlantDetails set isactive=1 where UID=?";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $mysqli->close();
    } 
    
public static function Activate($id) {
        $mysqli = Config::OpenDBConnection();
        $query = "update PlantDetails set isactive=0 where ID=?";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $mysqli->close();
    }  
    
public static function CheckInternet()
{
    $connected = @fsockopen("www.google.com", 80); 
                                        //website, port  (try 80 or 443)
    if ($connected){
        $is_conn = true; //action when connected
        fclose($connected);
    }else{
        $is_conn = false; //action in connection failure
    }
    return $is_conn;

} 
    
public static function callAPI($method, $url, $data){
   $curl = curl_init();
 	curl_setopt($curl, CURLOPT_POST, 1);
	curl_setopt($curl, CURLOPT_POSTFIELDS, $data);	
   

   // OPTIONS:
   curl_setopt($curl, CURLOPT_URL, $url);
   curl_setopt($curl, CURLOPT_HTTPHEADER, array(
      'token: b09a6938faa91b069dee62c377cf1232',
      'Content-Type: application/x-www-form-urlencoded',
   ));
   curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
   curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);

   // EXECUTE:
   $result = curl_exec($curl);
   if(!$result){die("Connection Failure");}
   curl_close($curl);
   return $result;
}    

}
?>
