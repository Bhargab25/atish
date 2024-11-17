 <?php 
include_once('../../include_commons.php'); 
require('../../_errors/libError.php');

$locker_id = $_POST['lid'];

#check this locker have any assignment or not

$check = ASSET_MODEL::ReadSingleByFID($locker_id);
if(empty($check)){
    echo '0';
}else{
    if($check->ISACTIVE == 'Y'){
        echo '1';
    }else{
        echo '0';
    }
}



?>
