<?php 
include_once('../../include_commons.php'); 
require('../../_errors/libError.php');

  $booking_id = $_POST['bookingId'];
  $locker_unique_id = $_POST['lockUid'];
 $getBooking_Details = BOOKING_HISTORY::ReadSingle($booking_id);
//print_r($getBooking_Details);
 if($getBooking_Details->CID == '7'){
	 //Webel sector 5 saltlake kolkata
	 $payment_method = 'N/A';
 	 $amount = '0.00';
 }
else{
	$payment_method = 'PAYU';
 	 $amount = $getBooking_Details->PAYMENT;
}

if($getBooking_Details->CID == '2'){
	 //TCS MUMBAI DEMO
	 $token = '89c6a10524686ea15b775dba37ba81b9';
}
else{
	
	$token = USR_Access_Model::ReadSingleByCid($getBooking_Details->CID)->KEY;
	
}


 $method = 'POST';
 $url = 'dev.letsfado.com/API/release_locker.php';
 $data = 'booking_id='.$booking_id.'&locker_uid='.$locker_unique_id.'&payby='.$payment_method.'&amount='.$amount;

 //$method.'--'.$url.'--'.$data.'--'.$token;

$rel = ApiModel::callAPI($method, $url, $data,$token); 
	echo $rel;


?>