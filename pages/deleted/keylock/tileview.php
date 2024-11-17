<?php
include_once('../../include_commons.php'); 
require('../../_errors/libError.php');
if(isset($_SESSION['userid'])){
    //$cid = $COMPANY_ID;
    #get lockers list
       // echo $getuserdetails->CID;
    $lockers = FADO_CAPACITY::ReadAllByCOMPID($COMPANY_ID);  
    #get asset all
    $asset = ASSET_MODEL::ReadAll();    
    #get Free Assets list
    $FreeAssets = ASSET_MODEL::FreeAssets();  
}
//glyphicon glyphicon-inbox
?>

<div class="row"><div style="background-color: lightgrey; padding: 10px 0; margin: 10px;">
					<p><span  class="bar red"></span> Open</p>
				<p><span  class="bar green"></span> Close</p>
			   </div>	
				</div>
<div class="row">
					<div class="col-md-12">
						<form id="lockerSet" name="lockerSet">
						<?php
						//print_r($this->locks);
						$totalLocks = count($lockers);
						foreach($lockers as $locs){
						$lockid = substr($locs->FADO_STORAGE_ID, strpos($locs->FADO_STORAGE_ID, "_") + 1);
						 #Check This locker is assign to any assets or not
                        $check = ASSET_MODEL::ReadAllByFID($locs->FADO_STORAGE_ID);
                        //print_r($check);
                         if(empty($check)){
						
						?>
							
						<button type="button" name="<?php echo $locs->FADO_STORAGE_ID; ?>" id="<?php echo $locs->FADO_STORAGE_ID; ?>" class="lockBox">
                           <span><?php echo $lockid; ?></span> 
                        </button>
						<?php
						}else{
                        ?>   
                       <button type="button" name="<?php echo $locs->FADO_STORAGE_ID; ?>" id="<?php echo $locs->FADO_STORAGE_ID; ?>" class="lockBox">
                           <span class="glyphicon glyphicon-inbox"><?php echo $lockid; ?>
                           <br><?php
                             foreach($check as $chAsset){
                       echo "<a href='javascript:void();' onClick='NeedChange()' title='$chAsset->MACID'>".$chAsset->NAME."</a> ,";
                                 }
                             ?>
                           </span> 
                        </button>
                        <!--<input type="button" name="<?php //echo $locs->FADO_STORAGE_ID; ?>" id="<?php //echo $locs->FADO_STORAGE_ID; ?>" value="<?php //echo $lockid; ?><span class='glyphicon glyphicon-inbox'></span>" class="lockBox"> -->   
                        <?php     
                         }}
						?>
							</form>
					</div>
					
				</div>
<?php
?>