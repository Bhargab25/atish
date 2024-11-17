<?php
include_once('../../include_commons.php'); 

//session_destroy();
$rackid = base64_decode($_GET['id']);

//echo $userid;
#user access details will be deleted
RackModel::delete($rackid);

header('location:index.php');
?>