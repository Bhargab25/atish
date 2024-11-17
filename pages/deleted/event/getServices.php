 <?php 
include_once('../../include_commons.php'); 
require('../../_errors/libError.php');

$model = new Booth_Model();
if(isset($_SESSION['userid'])){
    
$pl_id = Utils::CSV_TO_ARRAY($_POST['bid']);
    
	$getuserdetails = usermodel::ReadSingle($_SESSION['userid']);
	
	if($getuserdetails->UTYPE == 'ADMIN'){
        foreach($pl_id as $pid){
        
            #convert csv to array
            $services = Utils::CSV_TO_ARRAY(Booth_Model::ReadSingle($pid)->SERVICES);
            if(count($services) == 1){
            
            
    ?>
<li style="margin: 5px 0; padding: 5px 0;">
<label>
                      <input type="checkbox" name="services[]" value="<?php echo Booth_Model::ReadSingle($pid)->SERVICES; ?>" checked class="form-group">
                      <?php echo ServiceModel::ReadSingle(Booth_Model::ReadSingle($pid)->SERVICES)->NAME; ?>
                    </label>
    <span class="pull-right badge bg-blue">31</span>
</li>    
   
<?php
}else{
    #populate the array
    foreach($services as $srv){
        
        ?>
<li>
<label>
                      <input type="checkbox" name="services[]" value="<?php echo $srv; ?>" checked class="form-group">
                      <?php echo ServiceModel::ReadSingle($srv)->NAME; ?>
                    </label>
    <span class="pull-right badge bg-blue">31</span>
</li> 
<?php
    }            
                
                
            }
        }
	}
	
	
	
}else{
	header('location:../login/index.php');
}


?>
