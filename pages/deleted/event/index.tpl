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
        <?php if($this->error_u != ''){ ?>
<div class="alert alert-info alert-dismissible" >
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-check"></i> <?php echo $this->error_u; ?></h4>
					
                </div>

<?php
} ?>
      	      	
		<div class="row">
            <form class=""  action="index.php" method="post" enctype="multipart/form-data">
		<div class="col-md-6">
		<div class="box box-default box-solid">
            
    	<div class="box-header with-border"><h4 class="box-title">Add New Event</h4></div>
    	<div class="box-body">
              <div class="form-group">
        <div class="col-xs-5">
                <label for="startdate">Start Date</label>
                  <input type="date" name="sdate" class="form-control" min="<?php echo date('d-m-Y'); ?>" placeholder="dd-mm-yyyy">
        </div> 
        <div class="col-xs-5">
                <label for="startdate">End Date</label>
                  <input type="date" name="edate" class="form-control" placeholder="dd-mm-yyyy">
        </div>    
        </div>
            <div style="clear: both"></div>
		<div class="form-group">
                  <label for="event_name">Event Name</label>
                  <input type="text" required class="form-control" id="event_name" name="event_name" placeholder="Enter event name">
        </div>
         <div class="form-group">
             <label for="desc">Description</label>
             <textarea name="desc" id="desc" class="form-control"></textarea>
            </div>

       
            
        <div class="form-group">
                <label>Select Booths</label>
                <select class="form-control select2" name="getbooth[]" id="getbooth" required multiple="multiple" data-placeholder="Select Booths"
                        style="width: 100%;">
                  <?php 
                        foreach($this->allBooth as $booth){
                    ?>
                    <option value="<?php echo $booth->ID; ?>"><?php echo $booth->NAME; ?></option>
                    <?php } ?>
                </select>
              </div>
             <div class="form-group">
                <label>Select Invities</label>
                <select class="form-control select2" name="invite[]" id="invite[]" required multiple="multiple" data-placeholder="Select Invities"
                        style="width: 100%;">
                  <?php 
                        foreach($this->allusers as $users){
                         if($users->UTYPE != 'ADMIN'){
                    ?>
                    <option value="<?php echo $users->ID; ?>"><?php echo $users->FNAME.' '.$users->LNAME; ?></option>
                    <?php }} ?>
                </select>
              </div>
		</div>
			<div class="box-footer with-border">
			<button type="submit" name="av" class="btn btn-flat btn-success btn-social"><i class="fa fa-plus"></i> Add Event</button>
		    <button type="reset" class="btn btn-flat btn-warning pull-right">Cancel</button>
			</div>
                
		</div>
		</div>
			
		<div class="col-md-6">
          <div class="box box-solid box-default">
            <div class="box-header">
              <h3 class="box-title">Service List</h3>

            </div>
            <!-- /.box-header -->
            <div class="box-body ">
                <ul id="serv" class="nav nav-stacked">
                    
                </ul>
            </div>
            <!-- /.box-body -->
			  
          </div>
          <!-- /. box -->
          
        </div>
            </form>
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
