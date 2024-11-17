<?php 
include_once('../../include_commons.php'); 
require('../../_errors/libError.php');

if(isset($_GET['uid'])){
	
$profileuser_employement = EMPLOYEMENT_MODEL::ReadAllByUID($_GET['uid']);
$profile_current_emp = EMPLOYEMENT_MODEL::CurrentEmployement($_GET['uid']);
	
					foreach($profileuser_employement as $pe){
if($pe->RELEASEDATE == '0000-00-00'){
$release = 'Present';
}else{
$release = $pe->RELEASEDATE;
}
?>
				<li class="time-label">
        <span class="bg-blue">
            <?php echo $pe->JOINDATE.'-'.$release ?>
        </span>
    </li>  
				  <!-- timeline item -->
    <li>
        <!-- timeline icon -->
        <i class="fa fa-envelope bg-blue"></i>
        <div class="timeline-item">
            <span class="time"><i class="fa fa-clock-o"></i> <?php echo $release; ?></span>

            <h3 class="timeline-header"><a href="#"><?php echo $pe->COMPANY_NAME; ?></a> ...</h3>

            <div class="timeline-body">
				Working as a <strong> <?php echo $pe->DESIGNATION; ?></strong>
            </div>

            <div class="timeline-footer">
                <a class="btn btn-primary btn-xs">...</a>
            </div>
        </div>
    </li>
				  
    <!-- END timeline item -->
				  <?php
}
				  ?>

				<li id="end_emp">
                    <i class="fa fa-clock-o bg-gray"></i>
                  </li> 
<?php	
}

?>