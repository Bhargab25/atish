<?php echo $this->header; ?>
<body class="hold-transition skin-purple sidebar-mini">
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
  <?php echo $this->sidebar; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
 <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        View All Bookings
        <small>only admin can view all bookings</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Booking</a></li>
        
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      
      <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <div class="callout callout-success" style="display: none">
                <h4></h4>
                <p></p>
            </div>
            <div class="callout callout-danger" style="display: none">
                <h4></h4>
                <p></p>
            </div>
            
            
            
          <!-- general form elements -->
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">All Bookings</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div id='loader' style="z-index: 2; background: #fff; top: 0;  width: 100vw; height: 100vh; position: absolute; opacity: 0.5; display: none;"><img src="../../dist/img/loader.gif" /></div>    
              <table class="table no-margin" id="example1">
                  <thead>
                  <tr>
                    <th>#</th>  
                    <th>Booking ID</th>
                    <th>Key RackId</th>
                    <th>Employee Code</th>
					<th>Group Name</th>  
                    <th>Booking Date</th>    
                    <th>Release DateTime</th>
                    <th>Status</th>  
                  </tr>
                  </thead>
                  <tbody>
					  <?php 
                            $i = 1;
                            if(!empty($this->Booking)){
							foreach($this->Booking as $booking){
						?>
                  <tr>
                    <td><?php echo $i; ?></td>  
                    <td><?php echo $this->company->CUID.'@'.$booking->ID ?> </td>
                    <td><?php echo ASSET_MODEL::ReadSingle($booking->ASSET_ID)->NAME; ?></td>
                    <td><span class="label label-success"><?php echo usermodel::ReadSingle($booking->USERID)->NAME; ?></span></td>
                      <td><?php echo FADO_CAPACITY::ReadSingle($booking->LOCKER_ID)->FADO_STORAGE_ID; ?></td>
                    <td>
                      <?php echo $booking->ASSIGN_TIME; ?>
                    </td>  
                    <td>
                      <?php echo $booking->REALEASE_TIME; ?>
                    </td>
                    <td><?php if($booking->PAYMENT_STATUS == 'NOT PAID'){
                            $today = strtotime(date('Y-m-d H:i:s'));
                            if($today > strtotime($booking->REALEASE_TIME)){?>
<span class="label label-danger">Overdue</span>
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
                         <?php   }else{
                           ?>
                        <span class="label label-warning">Booked</span>
                        <?php
                        }}else{?>
<span class="label label-success">Release</span>
<?php } ?></td>  
                  </tr>
                  <?php
                    $i++;
					    }
                    
                    }
					?>
                  </tbody>
                </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

        </div>
        <!--/.col (left) -->
      
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
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
  
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>

</div>
<?php echo $this->footer; ?>
