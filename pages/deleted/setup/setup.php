<?php 
include_once('../../include_commons.php'); 
require('../../_errors/libError.php');



$company = new companymodel();
$setup = new SETUPMODEL();

//echo $_POST['cname'];
//echo $companyid = $_POST['cid'];
#update company Details
$company->CID = $_POST['cid'];
$company->CNAME = $_POST['cname'];
$company->CONTACTEMAIL = $_POST['cemail'];
$company->DOMAIN = $_POST['cdomain'];
$company->CONTACTPHONE = $_POST['cphone'];
 companymodel::UpdateSetup($company);


#---------end here

#setting 

$getsetup = SETUPMODEL::ReadAll();

if(empty($getsetup)){
  if($_POST['BookAss']=='0'){
   
      $setup->MULTI_BOOKING = $_POST['AssetBook'];
}else{
    $setup->MULTI_BOOKING =1; 
}

$setup->MULTI_ASSET = $_POST['BookAss'];
SETUPMODEL::Create($setup);
    
    
}else{
    if($_POST['BookAss']=='0'){
   $setup->MULTI_BOOKING = $_POST['AssetBook']; 
}else{
   
        $setup->MULTI_BOOKING ='1'; 
}
if(isset($_POST['locAss'])){
   $setup->MULTI_ASSET = 'on'; 
}else{
    
    $setup->MULTI_ASSET = 'off'; 
}

//$setup->ID = '1';    
SETUPMODEL::Update($setup);
echo 'Succcesfully Updated';    
}







?>
