<?php

class BOOKING_HISTORY extends BaseModel {

   

    public $ID; // USER ID
	public $CID; // COMPANY UNIQUE ID
    // int primary key auto_increment,
    public $EMPLOYEE_CODE; // LOCATION NAME
    public $RITM;
    public $REASON;
    public $RFID;
    // varchar(15),
    public $KEY_UUID; //branch address
	public $SLAVE_ID;
	public $ASSIGN_TIME;// space or it resources
	public $REALEASE_TIME;
	public $STATUS;
    //id ,    restaurantname ,    contactname ,    address ,    contactphone ,    loginid ,    password ,    lastlogin ,    isactive



    function __construct() {
        parent::__construct();
        //$this->examcatid=Validator::Key($keys['layout_welcome_index_label');
    }
   public static function Create(BOOKING_HISTORY $model) {
        $mysqli = Config::OpenDBConnection();
	  
		 $query = "INSERT INTO `booking_history`(`ID`, `CID`, `EMPLOYEE_CODE`,`RITM`,`REASON`,`RFID`, `KEY_UUID`, `SLAVE_ID`, `ASSIGN_TIME`, `REALEASE_TIME`, `STATUS`) VALUES (NULL, '$model->CID','$model->EMPLOYEE_CODE','$model->RITM','$model->REASON','$model->RFID', '$model->KEY_UUID','$model->SLAVE_ID','$model->ASSIGN_TIME','$model->REALEASE_TIME','$model->STATUS')";   
	   
	
        $stmt = Config::CreateStatement($mysqli, $query);
    
        $stmt->execute();
        $id = $mysqli->insert_id;
        $mysqli->close();
        return $id;
    }

public static function ReadBetdates($start_date,$enddate) {
        $model = new BOOKING_HISTORY();
        $mysqli = Config::OpenDBConnection();
        $query = "select * from booking_history WHERE DATE(`ASSIGN_TIME`) BETWEEN '$start_date' and '$enddate' order by DATE(`ASSIGN_TIME`) ASC";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->bind_result($model->ID, $model->CID, $model->EMPLOYEE_CODE,$model->RITM,$model->REASON,$model->RFID, $model->KEY_UUID,$model->SLAVE_ID,$model->ASSIGN_TIME,$model->REALEASE_TIME,$model->STATUS);
        $stmt->execute();
        $list = array();
        while ($stmt->fetch()) {
            $obj = new BOOKING_HISTORY();
            Utils::COPY_ROW_TO_OBJ($obj, $model);
            $list[$obj->ID] = $obj;
        }
        $mysqli->close();
        return $list;
    }
	
public static function ReadAllByRack($rack) {
$model = new BOOKING_HISTORY();
$mysqli = Config::OpenDBConnection();
$query = "select * from booking_history where `KEY_UUID`='$rack' AND `ASSIGN_TIME` >= DATE(NOW()) - INTERVAL 7 DAY order by ID DESC";
$stmt = Config::CreateStatement($mysqli, $query);
$stmt->bind_result($model->ID, $model->CID, $model->EMPLOYEE_CODE,$model->RITM,$model->REASON,$model->RFID, $model->KEY_UUID,$model->SLAVE_ID,$model->ASSIGN_TIME,$model->REALEASE_TIME,$model->STATUS);
$stmt->execute();
$list = array();
while ($stmt->fetch()) {
$obj = new BOOKING_HISTORY();
Utils::COPY_ROW_TO_OBJ($obj, $model);
$list[$obj->ID] = $obj;
}
$mysqli->close();
return $list;
}
 public static function release(BOOKING_HISTORY $model) {
         $mysqli = Config::OpenDBConnection();
        $query = 'update booking_history set `REALEASE_TIME`="'.$model->REALEASE_TIME.'",`STATUS`="RELEASED" where ID= '.$model->ID;
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->execute();
        $mysqli->close();
     
	} 
    
 public static function update_overdue(BOOKING_HISTORY $model) {
         $mysqli = Config::OpenDBConnection();
        $query = 'update booking_history set `STATUS`="OVERDUE" where ID= '.$model->ID;
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->execute();
        $mysqli->close();
     
	}     
	
public static function ReadAll() {
        $model = new BOOKING_HISTORY();
        $mysqli = Config::OpenDBConnection();
        $query = "select * from booking_history order by ID DESC";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->bind_result($model->ID, $model->CID, $model->EMPLOYEE_CODE,$model->RITM,$model->REASON,$model->RFID, $model->KEY_UUID,$model->SLAVE_ID,$model->ASSIGN_TIME,$model->REALEASE_TIME,$model->STATUS);
        $stmt->execute();
        $list = array();
        while ($stmt->fetch()) {
            $obj = new BOOKING_HISTORY();
            Utils::COPY_ROW_TO_OBJ($obj, $model);
            $list[$obj->ID] = $obj;
        }
        $mysqli->close();
        return $list;
    }
public static function ReadAllGrpbyRack() {
$model = new BOOKING_HISTORY();
$mysqli = Config::OpenDBConnection();
$query = "select * from booking_history group by KEY_UUID order by ID DESC";
$stmt = Config::CreateStatement($mysqli, $query);
$stmt->bind_result($model->ID, $model->CID, $model->EMPLOYEE_CODE,$model->RITM,$model->REASON,$model->RFID, $model->KEY_UUID,$model->SLAVE_ID,$model->ASSIGN_TIME,$model->REALEASE_TIME,$model->STATUS);
$stmt->execute();
$list = array();
while ($stmt->fetch()) {
$obj = new BOOKING_HISTORY();
Utils::COPY_ROW_TO_OBJ($obj, $model);
$list[$obj->ID] = $obj;
}
$mysqli->close();
return $list;
}

public static function ReadAllBooked() {
        $model = new BOOKING_HISTORY();
        $mysqli = Config::OpenDBConnection();
        $query = "select * from booking_history where STATUS!='RELEASED' order by ID DESC";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->bind_result($model->ID, $model->CID, $model->EMPLOYEE_CODE,$model->RITM,$model->REASON,$model->RFID, $model->KEY_UUID,$model->SLAVE_ID,$model->ASSIGN_TIME,$model->REALEASE_TIME,$model->STATUS);
        $stmt->execute();
        $list = array();
        while ($stmt->fetch()) {
            $obj = new BOOKING_HISTORY();
            Utils::COPY_ROW_TO_OBJ($obj, $model);
            $list[] = $obj;
        }
        $mysqli->close();
        return $list;
    }    
public static function ReadAllOverdue($limit) {
        $model = new BOOKING_HISTORY();
        $mysqli = Config::OpenDBConnection();
        $query = "select * from booking_history where TIMESTAMPDIFF(MINUTE,`ASSIGN_TIME`,NOW()) > $limit and STATUS != 'RELEASED'";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->bind_result($model->ID, $model->CID, $model->EMPLOYEE_CODE,$model->RITM,$model->REASON,$model->RFID, $model->KEY_UUID,$model->SLAVE_ID,$model->ASSIGN_TIME,$model->REALEASE_TIME,$model->STATUS);
        $stmt->execute();
        $list = array();
        while ($stmt->fetch()) {
            $obj = new BOOKING_HISTORY();
            Utils::COPY_ROW_TO_OBJ($obj, $model);
            $list[] = $obj;
        }
        $mysqli->close();
        return $list;
    }     
    
public static function ReadAllByUID($id) {// Dont modify this, its use on API
        $model = new BOOKING_HISTORY();
        $mysqli = Config::OpenDBConnection();
        $query = "select * from booking_history where USERID=? and STATUS!='RELEASED' order by ID DESC";
        $stmt = Config::CreateStatement($mysqli, $query);
	 $stmt->bind_param("i", $id);
        $stmt->bind_result($model->ID, $model->CID, $model->EMPLOYEE_CODE,$model->RITM,$model->REASON,$model->RFID, $model->KEY_UUID,$model->SLAVE_ID,$model->ASSIGN_TIME,$model->REALEASE_TIME,$model->STATUS);
        $stmt->execute();
        $list = array();
        while ($stmt->fetch()) {
            $obj = new BOOKING_HISTORY();
            Utils::COPY_ROW_TO_OBJ($obj, $model);
            $list[$obj->ID] = $obj;
        }
        $mysqli->close();
        return $list;
    }
public static function ReadAllByUID_History($id) {// Dont modify this, its use on API
        $model = new BOOKING_HISTORY();
        $mysqli = Config::OpenDBConnection();
        $query = "select * from booking_history where USERID=$id order by ID DESC";
        $stmt = Config::CreateStatement($mysqli, $query);
	// $stmt->bind_param("i", $id);
        $stmt->bind_result($model->ID, $model->CID, $model->EMPLOYEE_CODE,$model->RITM,$model->REASON,$model->RFID, $model->KEY_UUID,$model->SLAVE_ID,$model->ASSIGN_TIME,$model->REALEASE_TIME,$model->STATUS);
        $stmt->execute();
        $list = array();
        while ($stmt->fetch()) {
            $obj = new BOOKING_HISTORY();
            Utils::COPY_ROW_TO_OBJ($obj, $model);
            $list[$obj->ID] = $obj;
        }
        $mysqli->close();
        return $list;
    }    
public static function ReadAllByAID($id) {
        $model = new BOOKING_HISTORY();
        $mysqli = Config::OpenDBConnection();
        $query = "select * from booking_history where ASSET_ID='$id' and PAYMENT_STATUS != 'PAID' order by ID DESC";
        $stmt = Config::CreateStatement($mysqli, $query);
	// $stmt->bind_param("i", $id);
        $stmt->bind_result($model->ID, $model->CID, $model->EMPLOYEE_CODE,$model->RITM,$model->REASON,$model->RFID, $model->KEY_UUID,$model->SLAVE_ID,$model->ASSIGN_TIME,$model->REALEASE_TIME,$model->STATUS);
        $stmt->execute();
        $list = array();
        while ($stmt->fetch()) {
            $obj = new BOOKING_HISTORY();
            Utils::COPY_ROW_TO_OBJ($obj, $model);
            $list[$obj->ID] = $obj;
        }
        $mysqli->close();
        return $list;
    }	
public static function ReadAllByUID_cur($id) {
        $model = new BOOKING_HISTORY();
        $mysqli = Config::OpenDBConnection();
        $query = "select * from booking_history where USERID=?  order by ID DESC";
        $stmt = Config::CreateStatement($mysqli, $query);
	 $stmt->bind_param("i", $id);
        $stmt->bind_result($model->ID, $model->CID, $model->EMPLOYEE_CODE,$model->RITM,$model->REASON,$model->RFID, $model->KEY_UUID,$model->SLAVE_ID,$model->ASSIGN_TIME,$model->REALEASE_TIME,$model->STATUS);
        $stmt->execute();
        $list = array();
        while ($stmt->fetch()) {
            $obj = new BOOKING_HISTORY();
            Utils::COPY_ROW_TO_OBJ($obj, $model);
            $list[$obj->ID] = $obj;
        }
        $mysqli->close();
        return $list;
    }	
public static function ReadAllByUID_date_booked($uid,$date) {
        $model = new BOOKING_HISTORY();
        $mysqli = Config::OpenDBConnection();
         $query = "select * from booking_history where USERID=? and DATE(`ASSIGN_TIME`) = DATE('$date')  order by ID"; 
        $stmt = Config::CreateStatement($mysqli, $query);
	 $stmt->bind_param("i", $uid);
        $stmt->bind_result($model->ID, $model->CID, $model->EMPLOYEE_CODE,$model->RITM,$model->REASON,$model->RFID, $model->KEY_UUID,$model->SLAVE_ID,$model->ASSIGN_TIME,$model->REALEASE_TIME,$model->STATUS);
        $stmt->execute();
        $list = array();
        while ($stmt->fetch()) {
            $obj = new BOOKING_HISTORY();
            Utils::COPY_ROW_TO_OBJ($obj, $model);
            $list[$obj->ID] = $obj;
        }
        $mysqli->close();
        return $list;
    }	  

public static function ReadAllByUID_date_release($uid,$date) {
        $model = new BOOKING_HISTORY();
        $mysqli = Config::OpenDBConnection();
         $query = "select * from booking_history where USERID=? and DATE(`REALEASE_TIME`) = DATE('$date') and `PAYMENT_STATUS`='PAID'  order by ID"; 
        $stmt = Config::CreateStatement($mysqli, $query);
	 $stmt->bind_param("i", $uid);
        $stmt->bind_result($model->ID, $model->CID, $model->EMPLOYEE_CODE,$model->RITM,$model->REASON,$model->RFID, $model->KEY_UUID,$model->SLAVE_ID,$model->ASSIGN_TIME,$model->REALEASE_TIME,$model->STATUS);
        $stmt->execute();
        $list = array();
        while ($stmt->fetch()) {
            $obj = new BOOKING_HISTORY();
            Utils::COPY_ROW_TO_OBJ($obj, $model);
            $list[$obj->ID] = $obj;
        }
        $mysqli->close();
        return $list;
    }	
    
public static function CurrentMonth(){
        $currrent = date('Y-m-d');
        $model = new BOOKING_HISTORY();
        $mysqli = Config::OpenDBConnection();
        $query = "select * from booking_history where (MONTH(`ASSIGN_TIME`) = MONTH('$currrent')  AND YEAR(`ASSIGN_TIME`) = YEAR('$currrent')) order by ID DESC";
        $stmt = Config::CreateStatement($mysqli, $query);
	 //$stmt->bind_param("i", $id);
        $stmt->bind_result($model->ID, $model->CID, $model->EMPLOYEE_CODE,$model->RITM,$model->REASON,$model->RFID, $model->KEY_UUID,$model->SLAVE_ID,$model->ASSIGN_TIME,$model->REALEASE_TIME,$model->STATUS);
        $stmt->execute();
        $list = array();
        while ($stmt->fetch()) {
            $obj = new BOOKING_HISTORY();
            Utils::COPY_ROW_TO_OBJ($obj, $model);
            $list[] = $obj;
        }
        $mysqli->close();
        return $list;
}
public static function ReadAll_Latest_Booking_CID($cid) {
        $model = new BOOKING_HISTORY();
        $mysqli = Config::OpenDBConnection();
        $query = "select * from booking_history where CID=? order by ID DESC LIMIT 8";
        $stmt = Config::CreateStatement($mysqli, $query);
	 $stmt->bind_param("i", $cid);
        $stmt->bind_result($model->ID, $model->CID, $model->EMPLOYEE_CODE,$model->RITM,$model->REASON,$model->RFID, $model->KEY_UUID,$model->SLAVE_ID,$model->ASSIGN_TIME,$model->REALEASE_TIME,$model->STATUS);
        $stmt->execute();
        $list = array();
        while ($stmt->fetch()) {
            $obj = new BOOKING_HISTORY();
            Utils::COPY_ROW_TO_OBJ($obj, $model);
            $list[$obj->ID] = $obj;
        }
        $mysqli->close();
        return $list;
    }	
	
public static function Occupied($cid) {
        $model = new BOOKING_HISTORY();
        $mysqli = Config::OpenDBConnection();
        $query = "select * from booking_history where CID=? order by ID DESC ";
        $stmt = Config::CreateStatement($mysqli, $query);
	 $stmt->bind_param("i", $cid);
        $stmt->bind_result($model->ID, $model->CID, $model->EMPLOYEE_CODE,$model->RITM,$model->REASON,$model->RFID, $model->KEY_UUID,$model->SLAVE_ID,$model->ASSIGN_TIME,$model->REALEASE_TIME,$model->STATUS);
        $stmt->execute();
        $list = array();
        while ($stmt->fetch()) {
            $obj = new BOOKING_HISTORY();
            Utils::COPY_ROW_TO_OBJ($obj, $model);
            $list[$obj->ID] = $obj;
        }
        $mysqli->close();
        return $list;
    }	
	
public static function ReadAllByUID_past($id) {
        $model = new BOOKING_HISTORY();
        $mysqli = Config::OpenDBConnection();
        $query = "select * from booking_history where USERID=?  order by ID DESC";
        $stmt = Config::CreateStatement($mysqli, $query);
	 $stmt->bind_param("i", $id);
        $stmt->bind_result($model->ID, $model->CID, $model->EMPLOYEE_CODE,$model->RITM,$model->REASON,$model->RFID, $model->KEY_UUID,$model->SLAVE_ID,$model->ASSIGN_TIME,$model->REALEASE_TIME,$model->STATUS);
        $stmt->execute();
        $list = array();
        while ($stmt->fetch()) {
            $obj = new BOOKING_HISTORY();
            Utils::COPY_ROW_TO_OBJ($obj, $model);
            $list[$obj->ID] = $obj;
        }
        $mysqli->close();
        return $list;
    }	
	
 public static function ReadSingle($id) {
        $model = new BOOKING_HISTORY();
		  $mysqli = Config::OpenDBConnection();
		
         $query = "select * from booking_history where ID =?";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->bind_param("i", $id);
		
        $stmt->bind_result($model->ID, $model->CID, $model->EMPLOYEE_CODE,$model->RITM,$model->REASON,$model->RFID, $model->KEY_UUID,$model->SLAVE_ID,$model->ASSIGN_TIME,$model->REALEASE_TIME,$model->STATUS);
		$stmt->execute();
        if ($stmt->fetch()) {
            $mysqli->close();
            return $model;
        } else {
            $mysqli->close();
            return null;
        }
		    }
	
	public static function ReadSingleByUid($USERID) {
        $model = new BOOKING_HISTORY();
		  $mysqli = Config::OpenDBConnection();
		
         $query = "select * from booking_history where USERID =?";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->bind_param("i", $USERID);
		
        $stmt->bind_result($model->ID, $model->CID, $model->EMPLOYEE_CODE,$model->RITM,$model->REASON,$model->RFID, $model->KEY_UUID,$model->SLAVE_ID,$model->ASSIGN_TIME,$model->REALEASE_TIME,$model->STATUS);
		$stmt->execute();
        if ($stmt->fetch()) {
            $mysqli->close();
            return $model;
        } else {
            $mysqli->close();
            return null;
        }
		    }
    
 	public static function Get1stBooking($USERID) {
        $model = new BOOKING_HISTORY();
		  $mysqli = Config::OpenDBConnection();
		
         $query = "select * from booking_history where USERID ='$USERID' order by ID ASC LIMIT 1";
        $stmt = Config::CreateStatement($mysqli, $query);
        //$stmt->bind_param("i", $USERID);
		
        $stmt->bind_result($model->ID, $model->CID, $model->EMPLOYEE_CODE,$model->RITM,$model->REASON,$model->RFID, $model->KEY_UUID,$model->SLAVE_ID,$model->ASSIGN_TIME,$model->REALEASE_TIME,$model->STATUS);
		$stmt->execute();
        if ($stmt->fetch()) {
            $mysqli->close();
            return $model;
        } else {
            $mysqli->close();
            return null;
        }
		    }  

public static function ReadAllBookedByRackgrp() {
        $model = new BOOKING_HISTORY();
        $mysqli = Config::OpenDBConnection();
        $query = "select * from booking_history where STATUS!='RELEASED' group by `KEY_UUID` order by ID DESC";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->bind_result($model->ID, $model->CID, $model->EMPLOYEE_CODE,$model->RITM,$model->REASON,$model->RFID, $model->KEY_UUID,$model->SLAVE_ID,$model->ASSIGN_TIME,$model->REALEASE_TIME,$model->STATUS);
        $stmt->execute();
        $list = array();
        while ($stmt->fetch()) {
            $obj = new BOOKING_HISTORY();
            Utils::COPY_ROW_TO_OBJ($obj, $model);
            $list[] = $obj;
        }
        $mysqli->close();
        return $list;
    } 
public static function ReadSingleByUidNAid($EMPLOYEE_CODE,$KEY_UUID,$SLAVE_ID) {
        $model = new BOOKING_HISTORY();
		  $mysqli = Config::OpenDBConnection();
		
         $query = "select * from booking_history where EMPLOYEE_CODE ='$EMPLOYEE_CODE' AND KEY_UUID='$KEY_UUID' AND `STATUS`='BOOKED' and SLAVE_ID=$SLAVE_ID";
        $stmt = Config::CreateStatement($mysqli, $query);
        //$stmt->bind_param("sii", $EMPLOYEE_CODE,$KEY_UUID,$SLAVE_ID);
		
        $stmt->bind_result($model->ID, $model->CID, $model->EMPLOYEE_CODE,$model->RITM,$model->REASON,$model->RFID, $model->KEY_UUID,$model->SLAVE_ID,$model->ASSIGN_TIME,$model->REALEASE_TIME,$model->STATUS);
		$stmt->execute();
        if ($stmt->fetch()) {
            $mysqli->close();
            return $model;
        } else {
            $mysqli->close();
            return null;
        }
		    }	

	public static function CheckAssetFree($ASSETID) {
        $model = new BOOKING_HISTORY();
		  $mysqli = Config::OpenDBConnection();
		
         $query = "select * from booking_history where ASSET_ID =? and PAYMENT_STATUS='NOT PAID'";
        $stmt = Config::CreateStatement($mysqli, $query);
        $stmt->bind_param("i", $ASSETID);
		
        $stmt->bind_result($model->ID, $model->CID, $model->EMPLOYEE_CODE,$model->RITM,$model->REASON,$model->RFID, $model->KEY_UUID,$model->SLAVE_ID,$model->ASSIGN_TIME,$model->REALEASE_TIME,$model->STATUS);
		$stmt->execute();
        if ($stmt->fetch()) {
            $mysqli->close();
            return $model;
        } else {
            $mysqli->close();
            return null;
        }
		    }    
    
public static function Get12MOnthReport(){/*
	$model = new BOOKING_HISTORY();
        $mysqli = Config::OpenDBConnection();
        $query = "SELECT t1.month,
coalesce(SUM(t1.amount+t2.amount), 0) AS total
from
(
  select DATE_FORMAT(a.Date,'%b') as month,
  DATE_FORMAT(a.Date, '%m-%Y') as md,
  '0' as  amount
  from (
    select curdate() - INTERVAL (a.a + (10 * b.a) + (100 * c.a)) DAY as Date
    from (select 0 as a union all select 1 union all select 2 union all select 3 union all select 4 union all select 5 union all select 6 union all select 7 union all select 8 union all select 9) as a
    cross join (select 0 as a union all select 1 union all select 2 union all select 3 union all select 4 union all select 5 union all select 6 union all select 7 union all select 8 union all select 9) as b
    cross join (select 0 as a union all select 1 union all select 2 union all select 3 union all select 4 union all select 5 union all select 6 union all select 7 union all select 8 union all select 9) as c
  ) a
  where a.Date <= NOW() and a.Date >= Date_add(Now(),interval - 12 month)
  group by md
)t1
left join
(
  SELECT DATE_FORMAT(`REALEASE_TIME`, '%b') AS month, SUM(`PAYMENT`) as amount ,DATE_FORMAT(`REALEASE_TIME`, '%m-%Y') as md
  FROM booking_history
  where `REALEASE_TIME` <= NOW() and `REALEASE_TIME` >= Date_add(Now(),interval - 12 month)
  GROUP BY md
)t2
on t2.md = t1.md 
group by t1.md
order by t1.md";
        $stmt = Config::CreateStatement($mysqli, $query);
	// $stmt->bind_param("i", $id);
        $stmt->bind_result($model->month,$model->md,$model->total);
        $stmt->execute();
        $list = array();
        while ($stmt->fetch()) {
            $obj = new BOOKING_HISTORY();
            Utils::COPY_ROW_TO_OBJ($obj, $model);
            $list[] = $obj;
        }
        $mysqli->close();
        return $list;
        
        fil; abd
        
        
*/}
	
	
}
?>
