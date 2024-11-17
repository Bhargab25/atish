<?php
include_once('../../include_commons.php'); 
require('../../_errors/libError.php');
if(isset($_SESSION['userid'])){
    //$cid = $COMPANY_ID;
    #get lockers list
       // echo $getuserdetails->CID;
    if(isset($_GET['page'])){
       
      if($_GET['page'] >1){
         $page_no= $_GET['page']*16; 
         $page_no = $page_no - 16;  
      }else{
         $page_no= 0; 
      }    
      
      //$page_end = $page_no + 16;    
        
    }else{
        $page_no = 0;
    }
  
    $lockers = FADO_CAPACITY::ReadAllByCOMPID_bypage($COMPANY_ID,$page_no);  
    #get asset all
    $asset = ASSET_MODEL::ReadAll();    
    #get Free Assets list
    $FreeAssets = ASSET_MODEL::FreeAssets();  
    
}
?>
<table class="table table-hover" id="locklist">
                <tr>
                  <th style="width: 10px">#</th>
                  <th>FADO Unique ID</th>
				  <th>Assets</th>
                  <th>Status</th>  
                  <th>Is Empty</th>    
                  
                </tr>
                  
				  <?php 
                    $i=1;
                    foreach($lockers as $locs){ ?>
                <tr>
                  <td><?php echo $i; ?></td>
                  <td><a href="javascript:void();" onclick="openLock('<?php echo $locs->FADO_STORAGE_ID; ?>')"><?php echo $locs->FADO_STORAGE_ID; ?></a></td>
				  <td ><?php 
                        #Check This locker is assign to any assets or not
                        $check = ASSET_MODEL::ReadAllByFID($locs->FADO_STORAGE_ID);
                        //print_r($check);
                        $check_allow = SETUPMODEL::ReadSingle(1);
                                            
                        if(!empty($check)){
                            foreach($check as $chAsset){
                       echo "<a href='javascript:void();' onClick='NeedChange()' title='$chAsset->MACID'>".$chAsset->NAME."</a> ,";?>
                      <a href="removeAsset.php?assetid=<?php echo $chAsset->MACID; ?>" onClick="return confirm('Are you sure you want to delete this item?');"><i class="icon fa fa-minus-circle"></i></a>
                      <?php
                                 }
                          if($check_allow->MULTI_ASSET == 'on'){
                           ?>
                      <select name="asset_id" id="asset_id" onChange="assign('<?php echo $locs->FADO_STORAGE_ID; ?>',this,<?php echo count($check) ?>)">
                          <option>--Select--</option>
                          <?php 
                            //print_r($this->FreeAssets);
                          foreach($FreeAssets as $ast){ ?>
                            <option value="<?php echo $ast->ID ?>"><?php echo $ast->NAME; ?></option>
                          <?php  } ?>                        
                      </select>
                      <?php
                          }    
                            
                        }else{
                         ?>
                      <select name="asset_id" id="asset_id" onChange="assign('<?php echo $locs->FADO_STORAGE_ID; ?>',this,<?php echo count($check) ?>)">
                          <option>--Select--</option>
                          <?php 
                            //print_r($this->FreeAssets);
                          foreach($FreeAssets as $ast){ ?>
                            <option value="<?php echo $ast->ID ?>"><?php echo $ast->NAME; ?></option>
                          <?php  } ?>                        
                      </select>
                      <?php
                        } 
                        ?>
                      
                      <?php
                            
                            
                        
                      ?></td>
				  <td><span id="<?php echo $locs->FADO_STORAGE_ID; ?>" style="background-color: aliceblue; padding: 5px;">searching..</span></td>
				  <td>
                      <?php 
                        if(count($check)!=0 && count($check)>1){
                            echo '<b>Not available</b>';
                        }else{
                        ?>
                      <span id="Is<?php echo $locs->FADO_STORAGE_ID; ?>" style="background-color: aliceblue; padding: 5px;">
                          searching..
                      </span>
                      <?php
                        }
                      ?>
                      </td>

                   
                </tr>
				<?php $i++; } ?>
              </table>
<?php
?>