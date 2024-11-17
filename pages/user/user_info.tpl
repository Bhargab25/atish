<?php echo $this->header; ?>
<body class="hold-transition skin-yellow-light sidebar-mini">
<div class="wrapper">

  <header class="main-header">

    <!-- Logo -->
    <?php echo $this->logo; ?>

    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <?php echo $this->nav; ?>

    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <?php 
if($this->role== 'admin' || $this->role == 'superadmin'){
echo $this->sidebar;
}?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        User Profile
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Examples</a></li>
        <li class="active">User profile</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="row">
        <div class="col-md-3">

          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
				
              <img class="profile-user-img img-responsive img-circle" src="../../dist/img/no-image.png" alt="User profile picture">
				

              <h3 class="profile-username text-center"><?php echo $this->profile_user->NAME; ?></h3>
              <?php if(!empty($this->profile_current_emp)){ ?>
              <p class="text-muted text-center"><?php echo $this->profile_current_emp->DESIGNATION; ?> at <?php echo $this->profile_current_emp->COMPANY_NAME; ?></p>
                <?php } ?>
                
            <?php 
                    if($this->role != 'admin'){
              ?>
                <a href="../home/logout.php" class="btn btn-block btn-primary" >LOGOUT</a>
                <?php
}
                ?>    
              
<!--              <a href="#settings" class="btn btn-primary btn-block"><b>Book Your FADO</b></a>
-->            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

          <!-- About Me Box -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Info</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <strong><i class="fa fa-user margin-r-5"></i> About Me</strong>

              <p class="text-muted" id="about_show">
                <?php echo $this->profileuser_about->DESCRIPTION; ?>
				  <button type="button" class="btn btn-default btn-lrg ajax" title="Ajax Request">
                <i class="fa fa-spin fa-refresh"></i>
              </button>
              </p>

              <hr>

              <strong><i class="fa fa-map-marker margin-r-5"></i> Location</strong>

              <p class="text-muted"></p>

              <hr>


              <strong><i class="fa fa-file-text-o margin-r-5"></i> Employement <button type="button" class="btn btn-default btn-sml ajax" title="Ajax Request">
                <i class="fa fa-spin fa-refresh"></i>
              </button></strong>

              
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              
              <li class="active"><a href="#timeline" data-toggle="tab">Timeline</a></li>
              <li><a href="#settings" data-toggle="tab">Settings</a></li>
			   <li><a href="#booking" data-toggle="tab">Booking</a></li>
				
            </ul>
            <div class="tab-content">
              
              <!-- /.tab-pane -->
              <div class="active tab-pane" id="timeline">
                <!-- The timeline -->
                  
                <?php 

if(empty($this->userAccess)){
                echo 'Nothing Found';
}else{ ?>  
                <ul class="timeline timeline-inverse">
					
				<!--Get All booking here-->	
					<?php foreach($this->userAccess as $usa){ 
                        $login = $usa->LAST_LOGIN;
                        $logout = $usa->LAST_LOGOUT;
                        $access_from = $usa->LOGIN_PLATFORM;	
						
					?>
                  <!-- timeline time label -->
                  <li class="time-label">
                        <span class="bg-black">
                          <?php                  
							$dt = new DateTime($login);
							$re_dt = new DateTime($logout);
							$date = $dt->format('d M Y,D');
							$time = $dt->format('h:i:s A');
							echo $date;
							$hourdiff = round((strtotime($logout) - strtotime($login))/3600, 1);
							 ?>
                        </span>
                  </li>
                  <!-- /.timeline-label -->
                  <!-- timeline item -->
                  <li>
                    <i class="fa fa-user bg-yellow"></i>

                    <div class="timeline-item">
                      <span class="time"><i class="fa fa-clock-o"></i> <?php echo $time; ?></span>

                      <h3 class="timeline-header"><?php echo $this->profile_user->NAME ?> loged in via <?php echo $access_from; ?> </h3>
						<p class="timeline-body no-border">
							<?php echo $this->profile_user->NAME ?> access this system 5 times. 
							Total used our today is 3:00:00.
							<a href="#" class="btn btn-primary btn-xs">More Details</a>
						</p>
						
						
                      
                      
                    </div>
                  </li>
                  <!-- END timeline item -->
					<?php 
					$getBooking = BOOKING_HISTORY::ReadAllByUID_date_booked($usa->USERID,$usa->LAST_LOGIN);
					//echo count($getBooking);
					if(!empty($getBooking)){
					?>
                  <!-- timeline item -->
                  <li>
                    <i class="fa fa-calendar-plus-o bg-aqua"></i>
						<?php 
							#Get booking Details
							foreach($getBooking as $gb){
							$bookingTime = new DateTime($gb->ASSIGN_TIME);
							$releaseTime = new DateTime($gb->REALEASE_TIME);
							
							$btime = $bookingTime->format('h:i:s A');
							$rtime = $releaseTime->format('h:i:s A');
								
							if($gb->IT_RES_ID!=''){
						$get_locker_type = 'IT_RESOURCE';
					    $get_locker_detail = ITRESOURCE_CAPACITY::ReadSingle($gb->IT_RES_ID);
					    $get_space_type = FADO_CATEGORY::ReadSingle($get_locker_detail->LOCKER_SPACE_ID)->TYPE;
					    $locNum =  $get_locker_detail->LOCKER_NUM;
					}
					if($gb->LOCKER_ID!=''){
						$get_locker_type = 'STORAGE';
						$get_locker_detail = FADO_CAPACITY::ReadSingle($gb->LOCKER_ID);
					     $get_space_type = FADO_CATEGORY::ReadSingle($get_locker_detail->LOCKER_SPACE_ID)->TYPE;
					 	$locNum =  $get_locker_detail->FADO_STORAGE_ID;
                       
					}
					
					
					?>
                    <div class="timeline-item">
                      <span class="time"><i class="fa fa-clock-o"></i>  <?php echo $btime; ?></span>

                      <h3 class="timeline-header no-border"><a href="#"><?php echo $this->profile_user->ENAME ?></a> Booked a <?php echo $get_space_type; ?>
                      </h3>
						<p class="timeline-body no-border">FADO ID: #<a href="javascript:void()"><?php echo $locNum; ?></a></p>
						
                    </div>
					  <?php
						
						
					}
					?>
                  </li>
                  <!-- END timeline item -->
					<?php
					}
					$get_r_Booking = BOOKING_HISTORY::ReadAllByUID_date_release($usa->USERID,$usa->LAST_LOGIN);
					if(!empty($get_r_Booking)){
					?>
                  <!-- timeline item -->
                  <li>
                    <i class="fa fa-calendar-minus-o bg-yellow"></i>
						<?php 
							#Get booking Details
							
							foreach($get_r_Booking as $gb){
							$bookingTime = new DateTime($gb->ASSIGN_TIME);
							$releaseTime = new DateTime($gb->REALEASE_TIME);
							
							$btime = $bookingTime->format('h:i:s A');
							$rtime = $releaseTime->format('h:i:s A');
								
							if($gb->IT_RES_ID!=''){
						$get_locker_type = 'IT_RESOURCE';
					    $get_locker_detail = ITRESOURCE_CAPACITY::ReadSingle($gb->IT_RES_ID);
					    $get_space_type = FADO_CATEGORY::ReadSingle($get_locker_detail->LOCKER_SPACE_ID)->TYPE;
					    $locNum =  $get_locker_detail->LOCKER_NUM;
					}
					if($gb->LOCKER_ID!=''){
						$get_locker_type = 'STORAGE';
						$get_locker_detail = FADO_CAPACITY::ReadSingle($gb->LOCKER_ID);
					     $get_space_type = FADO_CATEGORY::ReadSingle($get_locker_detail->LOCKER_SPACE_ID)->TYPE;
					 	$locNum =  $get_locker_detail->FADO_STORAGE_ID;
                       
					}
					
					if($gb->PAYMENT_STATUS == 'PAID'){
					?>
                    <div class="timeline-item">
                      <span class="time"><i class="fa fa-clock-o"></i> <?php echo $btime; ?></span>

                      <h3 class="timeline-header no-border"><a href="#"><?php echo $this->profile_user->ENAME ?></a> Released a <?php echo $get_space_type; ?>
                      </h3>
						<p class="timeline-body no-border">FADO ID: #<a href="javascript:void()"><?php echo $locNum; ?></a></p>
						
						
                    </div>
					  <?php
						}
						
					}
					?>
                  </li>
                  <!-- END timeline item -->
                <?php
				}}
				?>
                 
                  <li>
                    <i class="fa fa-clock-o bg-gray"></i>
                  </li>
                </ul>
                  <?php } ?>
              </div>
              <!-- /.tab-pane -->

              <div class="tab-pane" id="settings">
				  <h3>
					Your personal info:
				  </h3>
                <form class="form-horizontal">
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Name</label>

                    <div class="col-sm-10">
                      <input type="email" class="form-control" id="inputName" placeholder="Name" value="<?php echo $this->profile_user->NAME ?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputEmail" class="col-sm-2 control-label">Email</label>

                    <div class="col-sm-10">
                      <input type="email" class="form-control" id="inputEmail" value="<?php echo $this->profile_user->EMAIL ?>" placeholder="Email">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Phone</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" value="<?php echo $this->profile_user->PHONE ?>" id="inputName" placeholder="Name">
                    </div>
                  </div>
                  
                  
                  
                  
                </form>
				  
				<h3>
					Tell Us something about you:
				  </h3>
				  <form class="form-horizontal">
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">About</label>

                    <div class="col-sm-10">
						<textarea class="form-control" name="about" id="about"><?php 
							if($this->profileuser_about->DESCRIPTION !=''){
echo $this->profileuser_about->DESCRIPTION;
}else{
echo '';
}
 ?>
						</textarea>
					  </div>
                  </div>
                  
                 
                  
                  <div class="form-group" >
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="button" class="btn btn-danger" id="abt_submit">Submit</button>
                    </div>
                  </div>
				 </form>
				  <h3>
					Add your employement:
				  </h3>
				  <div class="alert alert-success alert-dismissible" id="employement_div">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Alert!</h4>
                <span id="smsg">Success alert preview. This alert is dismissable.</span>
              </div>
                <form class="form-horizontal">
                  <div class="form-group">
                    <label for="cname" class="col-sm-2 control-label">Company Name</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="cname" placeholder="Company Name">
                    </div>
                  </div>
				<div class="form-group">
                    <label for="cloc" class="col-sm-2 control-label">Company Location</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="cloc" name="cloc" placeholder="Company Location">
                    </div>
                  </div>	
                  <div class="form-group">
                    <label for="designation" class="col-sm-2 control-label">Designation</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="designation" placeholder="Email">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="joiningDate" class="col-sm-2 control-label">Joining Date</label>

                    <div class="col-sm-6">
                      <input type="date" class="form-control" id="joiningDate" value="1980-08-26" placeholder="Joining Date">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="ReleaseDate" class="col-sm-2 control-label">Release Date</label>

                    <div class="col-sm-6">
                      <input type="date" class="form-control" id="ReleaseDate" value="1980-08-26"  placeholder="Release Date">
                    </div>
					<div class="col-sm-4">
						<div class="checkbox">
                      <input type="checkbox" name="release" id="relaese" value="0000-00-00"> Present
						</div>
                    </div>  
                  </div>
                  
                  
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="button" class="btn btn-danger" name="employement_add" id="employement_add">Submit</button>
                    </div>
                  </div>
                </form>
			  </div>
				 <!-- /.tab-pane -->
				<div class="tab-pane" id="booking">
					<h3>
						Your Booking History <?php echo (BOOKING_HISTORY::ReadAllByUID_History($this->profile_user->UID)); ?>
						</h3>
					<div class="row">
						<div class="col-md-12">
						
                            <table class="table table-hover" id="example1">
                                <tr>
                                <th>#</th>
                                <th>Asset Name</th>
                                <th>Locker No.</th>
                                <th>Booking Time</th>
                                <th>Release Time</th>
                                <th>Status</th>
                                </tr>
                                <?php
                                  
                                    $getBooking = BOOKING_HISTORY::ReadAllByUID_History($this->profile_user->UID);
                                   $i = 1;
                            if(!empty($getBooking)){
							foreach($getBooking as $booking){
                                $getAsset = ASSET_MODEL::ReadSingle($booking->ASSET_ID);
                                ?>
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $getAsset->NAME; ?></td>
                                    <td><?php echo FADO_CAPACITY::ReadSingle($booking->LOCKER_ID)->FADO_STORAGE_ID; ?></td>
                                    <td><?php echo $booking->ASSIGN_TIME; ?></td>
                                    <td><?php echo $booking->REALEASE_TIME; ?></td>
                                    <td><?php if($booking->PAYMENT_STATUS == 'NOT PAID'){
                            $today = strtotime(date('Y-m-d H:i:s'));
                            if($today > strtotime($booking->REALEASE_TIME)){?>
<span class="label label-danger">Overdue</span>
                        <?php
                        if($this->role == 'admin'){
                                ?>
                        <div class="btn-group">
                  <button type="button" class="btn btn-danger">Action</button>
                  <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown">
                    <span class="caret"></span>
                    <span class="sr-only">Toggle Dropdown</span>
                  </button>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="javascript::Void();" onClick="sendNotification('<?php echo $booking->ID; ?>')">Send Notification</a></li>
                    <li><a href="javascript::Void();" onClick="Renew('<?php echo $booking->ID; ?>')">Renew</a></li>
                    <li><a href="javascript::Void();" onClick="ForceRelease('<?php echo $booking->ID; ?>')">Force Release</a></li>
                    
                  </ul>
                </div>
                         <?php  } }else{
                           ?>
                        <span class="label label-warning">Booked</span>
                        <?php
                        }}else{?>
<span class="label label-success">Release</span>
<?php } ?></td>
                                </tr>
                                <?php
$i++;
                                }}
?>
                                <tr>
                                <th>#</th>
                                <th>Asset Name</th>
                                <th>Locker No.</th>
                                <th>Booking Time</th>
                                <th>Release Time</th>
                                <th>Status</th>
                                </tr>
                            </table>
                       
						</div>	
					</div>
					
				</div>	

					
				</div>
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      
      <!-- /.row -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 2.4.0
    </div>
    <strong>Copyright &copy; 2018-2020 <a href="https://eegrab.com">eegrab</a>.</strong> All rights
    reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
      <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
      <!-- Home tab content -->
      <div class="tab-pane" id="control-sidebar-home-tab">
        <h3 class="control-sidebar-heading">Recent Activity</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-birthday-cake bg-red"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

                <p>Will be 23 on April 24th</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-user bg-yellow"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>

                <p>New phone +1(800)555-1234</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>

                <p>nora@example.com</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-file-code-o bg-green"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>

                <p>Execution time 5 seconds</p>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

        <h3 class="control-sidebar-heading">Tasks Progress</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Custom Template Design
                <span class="label label-danger pull-right">70%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Update Resume
                <span class="label label-success pull-right">95%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-success" style="width: 95%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Laravel Integration
                <span class="label label-warning pull-right">50%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-warning" style="width: 50%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Back End Framework
                <span class="label label-primary pull-right">68%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-primary" style="width: 68%"></div>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

      </div>
      <!-- /.tab-pane -->

      <!-- Settings tab content -->
      <div class="tab-pane" id="control-sidebar-settings-tab">
        <form method="post">
          <h3 class="control-sidebar-heading">General Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Report panel usage
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Some information about this general settings option
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Allow mail redirect
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Other sets of options are available
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Expose author name in posts
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Allow the user to show his name in blog posts
            </p>
          </div>
          <!-- /.form-group -->

          <h3 class="control-sidebar-heading">Chat Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Show me as online
              <input type="checkbox" class="pull-right" checked>
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Turn off notifications
              <input type="checkbox" class="pull-right">
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Delete chat history
              <a href="javascript:void(0)" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
            </label>
          </div>
          <!-- /.form-group -->
        </form>
      </div>
      <!-- /.tab-pane -->
    </div>
  </aside>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>

</div>
<?php echo $this->footer; ?>
