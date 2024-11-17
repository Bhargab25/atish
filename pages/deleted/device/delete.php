 <?php 
include_once('../../include_commons.php'); 
require('../../_errors/libError.php');
$model = new usermodel();
if(isset($_SESSION['userid'])){
    $getuserdetails = usermodel::ReadSingle($_SESSION['userid']);
    if($getuserdetails->UTYPE == 'ADMIN'){
      $did = base64_decode($_GET['id']);
      #check device is assign or not
        $ass = DEVICE_ASSIGN_MODEL::ReadSingleByDevice($did);
        if(empty($ass)){
            DEVICE_MODEL::Delete($did);
        }else{
            if($ass->STATUS == 'FREE'){
             DEVICE_MODEL::Delete($did);  
             #remove from assign table
             DEVICE_ASSIGN_MODEL::Delete($ass->ID);    
            }
        }
       header('location:index.php'); 
        
    }else{
         header('location:../login/index.php');
         die('This is a restricted area');
    }
  
}else{
    header('location:../login/index.php');
}





?>
