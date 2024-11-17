 <?php 
include_once('../../include_commons.php'); 
require('../../_errors/libError.php');
$error = '';
$model = new BoothLogin_Model();

if(isset($_SESSION['userid'])){
   
    $deviceid = $_POST['devid'];
    $boothid = $_POST['boothid'];
    $eventid = $_POST['eventid'];
    #check this device is assign to any device or not
    $check = DEVICE_ASSIGN_MODEL::ReadSingleByDevice($deviceid);
    if(!empty($check)){
    if($check->STATUS == 'FREE' || $check->STATUS == ''){
        
    }else{
        echo "This device is already assign to";
    }
    }else{
        #assign this device to the booth
        $model->ID = 'NULL';
        $model->BID = $boothid;
        $model->DID = $deviceid;
        $model->EID = $eventid;
        $model->DEVICE_UUID = '';
        $model->SECRETKEY = md5($boothid.date('Y-m-d H:i:s'));  
       // print_r($model);
      echo   $loginid = BoothLogin_Model::Create($model);
      #booked it on device table
        #check already have or not
        if($loginid !=0){
           $checkassign = DEVICE_ASSIGN_MODEL::ReadSingle($deviceid);
        if(empty($checkassign)){
        $deviceModel = new DEVICE_ASSIGN_MODEL();
        $deviceModel->DEVICE_ID = $deviceid;
        $deviceModel->EVENT_ID = $eventid;
        $deviceModel->ASSIGN_TO = '0';
        $deviceModel->ASSIGN_DATETIME = date('Y-m-d H:i:s');
        $deviceModel->STATUS = 'BOOKED';
        $daid = DEVICE_ASSIGN_MODEL::Create($deviceModel);
            echo 'This device is successfully added to the booth';
            }else{
        if($checkassign->STATUS == 'RELEASED'){
            #update the device
            DEVICE_ASSIGN_MODEL::Booked($deviceid,$eventid);
            echo 'This device is successfully added to the booth';
        }else{
            echo 'This device is already booked';
        }    
        }  
        }
       
        
    }
   
	
}else{
	header('location:../login/index.php');
}


?>
