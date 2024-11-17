<?php
include_once('../../include_commons.php'); 
require('../../_errors/libError.php');
 $snd = $_POST['snd'];
$getAsset = ASSET_MODEL::ReadSingleByMAC($snd);
$get_Cat = ASCAT_MODEL::ReadSingle($getAsset->CAT_ID);


?>
<form class="form-horizontal" method="post"  name="edit_form" >
              <div class="box-body">
                  <div class="row">
                       <div class="col-sm-6">
                       <div class="form-group">
                      <label for="asset_name" class="col-sm-4 control-label">Classification</label><br clear="all">
                      <div class="col-sm-6">
                        <?php echo $get_Cat->NAME; ?>
                      </div>
                    </div>
                      </div>
                      <div class="col-sm-6">
                       <div class="form-group">
                      <label for="asset_name" class="col-sm-4 control-label">Locker No.</label><br clear="all">
                      <div class="col-sm-6">
                        <?php echo substr($getAsset->FDO_UNIQUEID, strpos($getAsset->FDO_UNIQUEID, "_") + 1); ?>
                      </div>
                    </div>
                      </div> 
                  </div>
                <div class="row">
                       <div class="col-md-6">
                       <div class="form-group">
                      <label for="asset_name" class="col-sm-4 control-label">Serial No.</label><br clear="all">
                      <div class="col-sm-10">
                        <?php echo $getAsset->MACID; ?>
                      </div>
                    </div>
                      </div>
                      <div class="col-md-6">
                       <div class="form-group">
                      <label for="asset_name" class="col-sm-4 control-label">Locker No.</label><br clear="all">
                      <div class="col-sm-10">
                      <?php echo $getAsset->CREATEDATE; ?>
                      </div>
                    </div>
                      </div> 
                  </div>
              
              </div>
              <!-- /.box-body -->
             </div>
              
              <!-- /.box-footer -->
            </form>
