 <?php 
include_once('../../include_commons.php'); 
require('../../_errors/libError.php');



  #send mail to the user
$api= new ApiModel();

$method = 'POST';
$url = 'http://dev.letsfado.com/API/sendmail.php';
$data = 'subject='.$getTemplate_subject.'&body='.$getTemplate_body.'&email='.$userdetail->EMAIL; 
echo ApiModel::callAPI($method, $url, $data);
    




?>
