<?php 
include_once('../../include_commons.php'); 
require('../../_errors/libError.php');

$user = new usermodel();
$rfidmodel = new RFIDModel();
if(!empty($_FILES["emp_csv"]["name"]))  
 { 
      $output = '';  
      $mime = array("text/csv","text/comma-separated-values");  
    //  $extension = end(explode(".", $_FILES["emp_csv"]["type"])); 
      if(in_array($_FILES["emp_csv"]["type"], $mime))  
      {  
      $file_data = fopen($_FILES["emp_csv"]["tmp_name"], 'r');  
      $count = 0;      
      while(($row = fgetcsv($file_data,10000,','))!== FALSE)  {
          if($count > 0){
           
              #check email id exist or not
              $checkMail = usermodel::ReadSingleByEmail($row[2]);
              if(empty($checkMail)){
                  #check RFID
                  $checkRFID = RFIDMODEL::ReadSingleByRFID($row[5]);
                  if(empty($checkRFID)){
               
                   $user->CID = '1'; 
             $user->NAME = $row[0].' '.$row[1];
             $user->EMAIL = $row[2];
             $user->PHONE = $row[3];
             $user->EMPLOYEE_CODE = $row[4];
             $user->PASSWORD = $row[3];//Phone number itself a password
            $user->CREATEDDATE = date('Y-m-d H:i:s');
            $user->MODIFIEDDATE = date('Y-m-d H:i:s');
            $uid = usermodel::Create($user);
              if($uid != 0){
                  $rfidmodel->USERID = $uid;	
		          $rfidmodel->RFID = $row[5];
		          $rfidmodel->ISACTIVE = '0';
			     $rf = RFIDModel::Create($rfidmodel);
                  if($rf != 0){
                     echo '0';
                  }    
                  }else{
                      #
                  echo $row[4].' , line No.'.$count; 
                  }
                 
              }
            
              }else{
                echo $row[2].' , line No.'.$count;  
              }
          }
         $count++;
      }
          
      }else  
      {  
           echo 'Error1';  
      }  
}else{
  echo 'Error2';    
}

?>