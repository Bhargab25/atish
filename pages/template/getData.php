<?php 
include_once('../../include_commons.php'); 
require('../../_errors/libError.php');

#get template data by id
$id = $_POST['Tid'];
$getTemplate = EMAIL_MODEL::ReadSingle($id);
$body = str_replace('<br />','',$getTemplate->BODY);
$data = array('subject'=>$getTemplate->SUBJECT,'body'=>$body);
echo json_encode($data);
?>
