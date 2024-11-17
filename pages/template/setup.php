<?php 
include_once('../../include_commons.php'); 
require('../../_errors/libError.php');



$template = new EMAIL_MODEL();

if($_POST['email_temp'] == '--Select--'){
    echo 'Please select a template';
    die();
}
if($_POST['subject'] == ''){
    echo 'Please add some subject for your email';
    die();
}
if($_POST['body'] == ''){
    echo 'Please add some message for your users';
    die();
}
$template->ID = $_POST['email_temp'];
$template->SUBJECT = $_POST['subject'];
$template->BODY = nl2br($_POST['body']);

 EMAIL_MODEL::update($template);
if($_POST['email_temp'] != '--Select--'){
$getdata = EMAIL_MODEL::ReadSingle($_POST['email_temp']);
$data = array('id'=>$getdata->ID,'subject'=>$getdata->SUBJECT,'body'=>str_replace('<br />','',$getdata->BODY));
echo json_encode($data);    
}

#---------end here

#setting 




?>
