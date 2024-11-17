<?php 
include_once('../../include_commons.php'); 
require('../../_errors/libError.php');

$asset = new ASSET_MODEL();
$cat = new ASCAT_MODEL();
if(!empty($_FILES["ass_csv"]["name"]))  
 { 
      $output = '';  
      $mime = array("text/csv","text/comma-separated-values");  
    //  $extension = end(explode(".", $_FILES["emp_csv"]["type"])); 
      if(in_array($_FILES["ass_csv"]["type"], $mime))  
      {  
      $file_data = fopen($_FILES["ass_csv"]["tmp_name"], 'r');  
      $count = 0;   
      
      while(($row = fgetcsv($file_data,10000,',')))  {
        
          
         if($count > 0){
            
              $macid = $DEVICEID;
              #check cat exist or not
              $check_cat = ASCAT_MODEL::ReadSingleByName($row[1]);
            
              if(empty($check_cat)){
                  #create this category
                  $cat->NAME = $row[1];
                  $cat->CREATEDATE = date('Y-m-d H:i:s');
                  $cat->ISACTIVE = 'Y';
                  $catid = ASCAT_MODEL::Create($cat);
              }else{
                  $catid = $check_cat->ID;
              }
              #check asset
            //  echo $row[3];
              $check_asset = ASSET_MODEL::ReadSingleByMAC($row[3]);
              if(empty($check_asset)){
                  #create asset successfully
                  $asset->FDO_UNIQUEID = ltrim($macid.'_'.$row[0]);
                  $asset->CAT_ID = $catid;
                  $asset->NAME = $row[2];
                  $asset->PRICE = '0.00';
                  $asset->MACID = $row[3];
                  $asset->RFID = '';
                  $asset->CREATEDATE = date('Y-m-d H:i:s');
                  $asset->MODIFIEDDATE = date('Y-m-d H:i:s');
                  $asset->ISACTIVE = 'Y';
                  $ass_id = ASSET_MODEL::Create($asset);
                  if($ass_id!=0){
                      echo $row[2].' with serial no.'.$row[3].' successfully added'.$count;
                      echo '<br>';
                  } 
              }else{
                  #error this asset already exits
                  echo $row[2].' with serial no.'.$row[3].' is already exist. line no:'.$count;
                  echo '<br>';
                 
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