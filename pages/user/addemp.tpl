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
        Add User
        <small>Preview</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">User Management</a></li>
        <li class="active">Add User</li>
      </ol>
    </section>

    
      
      <!-- Main content -->
    <section class="content">
        
        <div class="row">
        <div class="col-md-12">
            <div class="callout callout-danger" style="display: none" id="ajaxreport">
                <h4 id="error">
                </h4>
                <p></p>
            </div>
            <div class="box box-primary">
                  <div id='loader' style="z-index: 2; background: #fff; top: 0;  width: 100vw; height: 100vh; position: absolute; opacity: 0.5; display: none;"><img src="../../dist/img/loader.gif" /></div>
               <div class="box-header with-border">
              <h3 class="box-title">Bulk User Upload</h3>
                <form role="form" method="post" name="employee">
                    <div class="col-xs-6">
					 <label for="fname">Upload your CSV file:</label>	
                  <input type="file" class="form-control" id="emp_csv" name="emp_csv" placeholder="Upload your csv file">
                </div>
                    <div class="col-xs-6"> 
                      <label><br></label><br>
                    <button type="submit" name="upload" class="btn btn-primary">Upload</button>
				  </div>
                </form> 
                   <a href="../../profile/sampledata.csv" target="_blank" title="Download your Sample CSV file from here">Download your Sample CSV file from here</a>
                 </div> 
                
            </div>
        </div>
        <div class="clearfix"></div>  
        </div>
      <div class="row">
        
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Add User</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="post" name="employee_add" action="addemp.php">
				<div class="box-body">
					<div class="col-xs-6">
					 <label for="fname">First Name</label>	
                  <input type="text" class="form-control" id="fname" name="fname" placeholder="enter your first name here">
                </div>
					<div class="col-xs-6">
					 <label for="fname">Last Name</label>	
                  <input type="text" class="form-control" id="lname" name="lname" placeholder="enter your last name here">
                </div>
				</div>
              <div class="box-body">
                <div class="col-xs-6">
                  <label for="Email1">Email address</label>
                  <input type="email" class="form-control" name="Email1" id="Email1" placeholder="Enter email">
                </div>
                <div class="col-xs-6">
                  <label for="phone">Phone Number</label>
                  <input type="tel" class="form-control" id="phone" name="phone" placeholder="Phone Number">
                </div>
		 
              </div>
				<div class="box-body">
					<div class="col-xs-6">
					 <label for="password">Password</label>	
                  <input type="password" class="form-control" id="password" name="password" placeholder="password">
                </div>
					<div class="col-xs-6">
					 <label for="fname">Employee Code</label>	
                  <input type="text" class="form-control" id="empcode" name="empcode" placeholder="">
                </div>
				</div>
				<div class="box-body">
					<div class="col-xs-6">
					 <label for="rfid">Scan your RFID Card</label>	
                  <input type="text" class="form-control" id="rfid" name="rfid" placeholder="RFID">
                </div>
					
				</div>
              <!-- /.box-body -->

              <div class="box-footer">
				 <div class="col-xs-6"> 
                    <button type="submit" name="au" class="btn btn-primary">Add User</button>
				  </div>
				  <div class="col-xs-6">
				  </div>	  
              </div>
            </form>
          </div>
          <!-- /.box -->

        </div>
        <!--/.col (left) -->
      
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
    
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 2.4.0
    </div>
    <strong>Copyright &copy; 2014-2016 <a href="https://adminlte.io">Almsaeed Studio</a>.</strong> All rights
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
      
      <!-- /.tab-pane -->
    </div>
  </aside>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>

</div>
<?php echo $this->footer; ?>
