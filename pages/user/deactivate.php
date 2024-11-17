<?php
include_once('../../include_commons.php'); 

//session_destroy();
$userid = base64_decode($_GET['uid']);
#user access details will be deleted
if(!empty(USR_Access_Model::ReadAllByUID_list($userid))){
USR_Access_Model::Delete($userid);
}
#main user delete
usermodel::Deactivate($userid);

header('location:../../pages/user/view.php');
?>