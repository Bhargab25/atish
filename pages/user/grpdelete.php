<?php
include_once('../../include_commons.php'); 

//session_destroy();
$id = base64_decode($_GET['gid']);
//echo $userid;
#user access details will be deleted
if(!empty(GroupModel::ReadSingle($id))){
GroupModel::Delete($id);
}
#main user delete
GroupModel::Delete($id);

header('location:../../pages/user/addgrps.php');
?>