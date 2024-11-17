<?php 
include_once('../../include_commons.php'); 
require('../../_errors/libError.php');
$result= array();
$type = trim($_POST['type']);
$cid = $_POST['cid'];

if($type == 'SPACE'){
$getLockers = FADO_CAPACITY::ReadAllByCOMPID($cid);
if(empty($getLockers)){
	echo '0';
}else{	
?>
				<div class="col-xs-3">
	
                  <label for="small">SMALL <input type="radio" class="form-control" ></label>
                </div>
                <div class="col-xs-4">
                  <label for="medium">MEDIUM<input type="radio" class="form-control" ></label>
                </div>
                <div class="col-xs-5">
                  <label for="large">LARGE<input type="radio" class="form-control" ></label>
                </div>
<?php
}}
if($type == 'ITRESOURCE'){
$getLockers = ITRESOURCE_CAPACITY::ReadAllByCID($cid);
 if(empty($getLockers)){
	 echo '0';
 }else{	
	?>
 <label for="small">SMALL 1<input type="radio" class="form-control" ></label>
                </div>
                <div class="col-xs-4">
                  <label for="medium">MEDIUM1<input type="radio" class="form-control" ></label>
                </div>
                <div class="col-xs-5">
                  <label for="large">LARGE1<input type="radio" class="form-control" ></label>
                </div>
<?php
}}
?>	

