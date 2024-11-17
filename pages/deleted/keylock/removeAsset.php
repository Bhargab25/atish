 <?php 
include_once('../../include_commons.php'); 
require('../../_errors/libError.php');

$assetid = $_GET['assetid'];


$model = new ASSET_MODEL();

$model->MACID = $assetid;
//$model->ID = $aset_id;

ASSET_MODEL::removeSpace($model);

#check this locker have any assignment or not

$check = ASSET_MODEL::ReadSingleByMAC($assetid);
if(empty($check)){
    echo '0';
}else{
    if($check->ISACTIVE == 'Y'){
        header('Location:locksList.php');
    }else{
        echo '0';
    }
}



?>
