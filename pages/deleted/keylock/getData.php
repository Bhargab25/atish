<?php
include_once('../../include_commons.php'); 
require('../../_errors/libError.php');
 $id = base64_decode($_POST['catid']);

echo $get_Cat = ASCAT_MODEL::ReadSingle($id)->NAME;


?>

