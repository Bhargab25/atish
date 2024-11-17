 <?php 
include_once('../../include_commons.php'); 
require('../../_errors/libError.php');

$bookingId = $_POST['bookingId'];
$original = str_replace('/','-',$_POST['datepicker']);
$datepicker = date("Y-m-d", strtotime($original));

#get time
$original_timepicker = str_replace('-',':',$_POST['timepicker']);
$timepicker = date("H:i:s", strtotime($original_timepicker));

 $getdateTime = $datepicker.' '.$timepicker;
#update booking history table to renew this booking
$update = BOOKING_HISTORY::renew($bookingId,$getdateTime);
$checkUpdate = BOOKING_HISTORY::ReadSingle($bookingId);
if($checkUpdate->REALEASE_TIME == $getdateTime){
    #send new OTP
    $otp = new OtpModel();
    $otp->OTP = OtpModel::generateNumericOTP('4');
    $otp->CREATEDATE = $checkUpdate->ASSIGN_TIME;
    $otp->EXPIRE_DATE = $getdateTime;
    $otp->USERID = $checkUpdate->USERID;
    $otp->BOOKING_ID = $checkUpdate->ID;
    //print_r($otp);
    OtpModel::update_on_generate($otp);
    echo  $getdateTime;
}else{
    echo 'Error1';
}



?>
