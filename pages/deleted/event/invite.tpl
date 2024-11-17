<?php echo $this->header; ?>
<body class="hold-transition skin-green sidebar-mini">
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
        Events
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Event</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      	      	<div class="alert alert-info alert-dismissible" style="display: none;">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-check"></i> New event Added Successfully!</h4>
					
                </div>
        
		<div class="row">
            
		<div class="col-md-12">
               <div class="box box-solid box-default">
                   <div class="box-header">
              <h3 class="box-title">Select Event</h3>
                
            </div>
                <div class="box-body col-md-6">
                    <form class=""  action="invite.php" method="GET" enctype="application/x-www-form-urlencoded">
                    <div class="input-group">
               
                <!-- /btn-group -->
                <select class="form-control" id="event" name="event">
                    <option>--Select--</option>  
                        <?php foreach($this->GetAllEvent as $gav){
?>
                    <option value="<?php echo base64_encode($gav->ID.'-'.date('H:i:s')); ?>"><?php echo $gav->NAME; ?></option>  
                    <?php
} ?>
                          
                </select>
                         <div class="input-group-btn">
                  <button type="submit" class="btn btn-info">Get Invities</button>
                </div>
              </div> 
                     </form>
                </div>   
            </div>   
        </div>
			
		<div class="col-md-12">
          <div class="box box-solid box-default">
            <div class="box-header">
              <h3 class="box-title">Invite List</h3>

            </div>
            <!-- /.box-header -->
            <div class="box-body ">
                <table id="example1" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>User Name</th>
                  <th>Event Name</th>
                  <th>Response</th>
                  <th>Event Status</th>
                         
                </tr>
                </thead>
                <tbody>
                    <?php 
                   //   print_r($this->AllInvities);
                       if(!empty($this->AllInvities)){


                        foreach($this->AllInvities as $Ai){
                        #get Invities details by event
                        $get_event = EVENT_MODEL::ReadSingle($Ai->EVENTID);
                    ?>
           
                <tr>
                  <td><?php echo usermodel::ReadSingle($Ai->USERID)->FNAME.' '.usermodel::ReadSingle($Ai->USERID)->LNAME; ?></td>
                  <td><?php echo $get_event->NAME; ?></td>
                  <td><?php echo $Ai->STATUS; ?></td>
                  <td><?php echo $get_event->STATUS; ?></td>
                  
                </tr>
                    <?php }} ?>
            
                </tbody>
                <tfoot>
                <tr>
                   <th>User Name</th>
                  <th>Event Name</th>
                  <th>Response</th>
                  <th>Event Status</th> 
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
			  
          </div>
          <!-- /. box -->
          
        </div>
           
		</div>
		
			
			
			
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 1.1.0
    </div>
    <strong>Copyright &copy; 2019-2020 <a href="https://eegrab.com">EEGRAB</a>.</strong> All rights
    reserved.
  </footer>

</div>
<!-- ./wrapper -->

<?php echo $this->footer; ?>
