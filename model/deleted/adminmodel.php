<?php

class companymodel extends BaseModel {

    public $cid;
    // int primary key auto_increment,
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
	public $LOCKERS;
	public $SUBSCRIPTION;
	public $CREATEDDATE;
	public $MODIFIEDDATE;

    //id ,    restaurantname ,    contactname ,    address ,    contactphone ,    loginid ,    password ,    lastlogin ,    isactive



    function __construct() {
        parent::__construct();
        //$this->examcatid=Validator::Key($keys['layout_welcome_index_label');
    }



    public function validate() {
        reset($this->errors);
        Validator::validate($this, "loginid", "Required", Validator::$VALIDATION_NONE);
        Validator::validate($this, "password", "Required", Validator::$VALIDATION_NONE);
        return!$this->haserrors();
    }

    public static function login($loginid, $password) {
        $model = new newusermodel();
        $mysqli = Config::OpenDBConnection();
        $query = "select * from ws_newadmin where loginid=? and password =?";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->bind_param("ss", $loginid, $password);
        $stmt->bind_result($model->id, $model->utype, $model->loginid, $model->password, $model->lastlogin);
        $stmt->execute();
        if ($stmt->fetch()) {
            $mysqli->close();
            return $model;
        } else {
            $mysqli->close();
            return null;
        }
    }

    public static function ChangePassword($password, $id) {
        $mysqli = Config::OpenDBConnection();
        $query = "update ws_newadmin set password =? where id=?";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->bind_param("si", $password, $id);
        $stmt->execute();
        $mysqli->close();
    }

//--------------------------------------
    public static function ReadSingleRestaurant($id) {
        $model = new newusermodel();
        $mysqli = Config::OpenDBConnection();
        $query = "select * from ws_newadmin where id =?";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->bind_param("i", $id);
        $stmt->bind_result($model->id, $model->utype, $model->loginid, $model->password, $model->lastlogin);
        $stmt->execute();
        if ($stmt->fetch()) {
            $mysqli->close();
            return $model;
        } else {
            $mysqli->close();
            return null;
        }
    }

    public static function ReadEmailidbyemail($email) {
        $model = new newusermodel();
        $mysqli = Config::OpenDBConnection();
        $query = "select loginid from ws_newadmin where  loginid=?";
        $stmt = $mysqli->stmt_init();
        $stmt->prepare($query);
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $stmt->bind_result($email);
        $stmt->execute();
        if ($stmt->fetch()) {
            return $email;
        }
        $stmt->close();
        $mysqli->close();
    }

    public static function LoginUser(adminmodel $m) {
        $model = new adminmodel();
        $mysqli = Config::OpenDBConnection();
        $query = "select * from ws_newadmin where  loginid=? and password=?";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->bind_param("ss", $m->loginid, $m->password);
        $stmt->bind_result($model->id, $model->utype, $model->loginid, $model->password, $model->lastlogin);
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
