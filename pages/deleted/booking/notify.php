 <?php 
include_once('../../include_commons.php'); 
require('../../_errors/libError.php');

$bookingId = $_POST['bid'];
$template_id = $_POST['tid'];
#get Booking Details
$bdetails = BOOKING_HISTORY::ReadSingle($bookingId);
#get template details
$template_details = EMAIL_MODEL::ReadSingle($template_id);
#get user details

$userdetail = usermodel::ReadSingle($bdetails->USERID);

$getTemplate_subject =$template_details->SUBJECT;//'Your asset *ASSET NAME*';
$getTemplate_body = $template_details->BODY;
$asset = '*ASSET*';
$username = '*USERNAME*';
$start = '*START DATE*';
$end = '*END DATE*';
if(strpos($getTemplate_subject,$asset)!=false){
   $getTemplate_subject =  str_replace("*ASSET*",ASSET_MODEL::ReadSingle($bdetails->ASSET_ID)->NAME , $getTemplate_subject);
    
}

if(strpos($getTemplate_subject,$username)!=false){
   $getTemplate_subject =  str_replace("*USERNAME*",$userdetail->NAME , $getTemplate_subject);

}

if(strpos($getTemplate_subject,$start)!=false){
   $getTemplate_subject =  str_replace("*START DATE*",$bdetails->ASSIGN_TIME , $getTemplate_subject);
}
if(strpos($getTemplate_subject,$end)!=false){
   $getTemplate_subject =  str_replace("*END DATE*",$bdetails->REALEASE_TIME , $getTemplate_subject);

}

if(strpos($getTemplate_body,$asset)!=false){
  $getTemplate_body =  str_replace("*ASSET*",ASSET_MODEL::ReadSingle($bdetails->ASSET_ID)->NAME , $getTemplate_body);
}

if(strpos($getTemplate_body,$username)!=false){
   
   $getTemplate_body =  str_replace("*USERNAME*",$userdetail->NAME , $getTemplate_body); 
}

if(strpos($getTemplate_body,$start)!=false){
 
   $getTemplate_body =  str_replace("*START DATE*",$bdetails->ASSIGN_TIME , $getTemplate_body); 
}
if(strpos($getTemplate_body,$end)!=false){
  
   $getTemplate_body =  str_replace("*END DATE*",$bdetails->REALEASE_TIME , $getTemplate_body); 
}


#check internet connection
//echo $userdetail->EMAIL;
  #send mail to the user

$email = new EmailHandler();
$email->email_to = $userdetail->EMAIL;
$email->subject = $getTemplate_subject;
$email->message = EmailHandler::Template($getTemplate_subject,$getTemplate_body);
echo EmailHandler::Send($email);



?>
