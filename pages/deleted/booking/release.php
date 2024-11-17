 <?php 
include_once('../../include_commons.php'); 
require('../../_errors/libError.php');

 $bookingId = $_POST['bid'];
#get Booking Details
$bdetails = BOOKING_HISTORY::ReadSingle($bookingId);

#get user details

$userdetail = usermodel::ReadSingle($bdetails->USERID);
//echo date('Y-m-d H:i:s',strtotime(strtotime(date('Y-m-d H:i:s')),60*5));
#releaese your asset
$book = new BOOKING_HISTORY();
$book->PAYMENT = '0.00';
$book->PAYMENT_METHOD = 'NA';
$book->REALEASE_TIME = date('Y-m-d H:i:s');
$book->BOOKED_HOUR = $hourdiff = round((strtotime($bdetails->REALEASE_TIME) - strtotime($bdetails->ASSIGN_TIME))/3600, 1);
$book->EXTRA_HOUR = $extra = round((strtotime(date('Y-m-d H:i:s')) - strtotime($bdetails->REALEASE_TIME))/3600, 1);
$book->ID = $bookingId;    
//print_r($book);
BOOKING_HISTORY::release($book);
$bdetails = BOOKING_HISTORY::ReadSingle($bookingId);
if($bdetails->PAYMENT_STATUS == 'PAID'){
    echo 0;
}else{
    echo 1;
}






?>
