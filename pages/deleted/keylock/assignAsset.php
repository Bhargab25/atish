 <?php 
include_once('../../include_commons.php'); 
require('../../_errors/libError.php');

$locker_id = $_POST['lid'];
$aset_id = $_POST['aid'];

$model = new ASSET_MODEL();

$model->FDO_UNIQUEID = $locker_id;
$model->ID = $aset_id;

ASSET_MODEL::assignLocker($model);

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
