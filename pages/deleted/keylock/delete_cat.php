<?php
include_once('../../include_commons.php'); 

//session_destroy();
$catid = base64_decode($_GET['catid']);
//echo $userid;
#user access details will be deleted
ASSET_MODEL::DeleteAllByCat($catid);
ASCAT_MODEL::delete($catid);
header('location:cat.php');
?>