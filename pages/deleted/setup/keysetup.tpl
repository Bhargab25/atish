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
        Company Key Slot Settings
        <small>only admin can view</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Settings</a></li>
        <li class="active">Key Setup</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      
      <!-- Main content -->
    <section class="content">
        <div class="row">
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
      <div class="row">
        <!-- left column -->
           <div class="box">
               <div class="box-header"><h3>Manage your Key Racks</h3></div>
          <!-- /.box -->
                <div class="box-body">
                   <table class="table table-hover" align="center">
                        <tr>
                           <th>RackId</th>
                            
                            <th>Group 1</th>
                            <th>Group 2</th>
                            <th>Group 3</th>
                            <th> Admin</th>
                            <th> Manager</th>
                       </tr>
                       <?php for($i=1; $i<=15 ; $i++){ ?>
                       <tr>
                           <td><?php echo $i; ?></td>
                           <td><input type="checkbox" value="" id="g1" name="g1"></td>
                           <td><input type="checkbox" value="" id="g2" name="g2"></td>
                           <td><input type="checkbox" value="" id="g3" name="g3"></td>
                           <td><input type="checkbox" value="" id="admin" name="admin"></td>
                           <td><input type="checkbox" value="" id="manager" name="manager"></td>
                       </tr>
                        <?php } ?>
                    </table>
               </div>
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
