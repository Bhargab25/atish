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
        Add or edit role
        <small>only admin can view all roles</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">role Management</a></li>
        <li class="active">Add/manage</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      
      <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- left column -->
          
        <div class="col-md-6">
            <form class="" role="form" method="post" action="">  
                  <div class="box box-default box-solid">
                      <div class="box-header with-border"><h4 class="box-title">Add New Role</h4></div>
                      <div class="box-body">
                          <div class="form-group">
                                <label>Role Name</label>
                                <input type="text" name="rolename" class="form-control" placeholder="Enter role name">
                                <br/>
                                </div>
                        <div class="form-group">
                          <label>Features:</label>
                             <hr>
                            <div class="row">
                           <div class="col-md-6"><p>
                                 <label>
                                   <input type="checkbox" name="features" value="Dashboard" id="features_0">
                                   All</label>
                                 <br>
                          </p></div> 
                            <div class="col-md-6">
                            <p>
                              <label>
                                <input type="checkbox" name="User Management" value="User Management" id="UserManagement_0" style="color: brown">
                                Add</label>
                              <br>
                              <label>
                                <input type="checkbox" name="view" value="View All" id="UserManagement_1">
                               Edit</label>
                              <br>
                              <label>
                                <input type="checkbox" name="add" value="Add User" id="UserManagement_2">
                                Disable</label>
                              <br>
                               <label>
                                <input type="checkbox" name="add" value="Add User" id="UserManagement_2">
                                Delete</label>
                              <br> 
                          </p>
                            </div>
                          </div>
                            
                             
                           
                        </div>      
                      </div>
                      <div class="box-footer with-border">
			<button type="submit" class="btn btn-flat btn-success btn-social" name="ad"><i class="fa fa-plus"></i> Add Role</button>
		    <button type="reset" class="btn btn-flat btn-warning pull-right">Cancel</button>
			</div>
                  </div>
             </form>   
        </div>
           
        <!--/.col (left) -->
          <div class="col-md-6">
              <div class="box box-default box-solid">
                  <div class="box-header with-border"><h4 class="box-title">View Role</h4></div>
                  <div class="box-body">
                      <table class="table table-hover" >
                          <tr>
                              <th>Role Name</th>
                              <th>Features</th>
                              <th>Action</th>
                          </tr>
                         <tr>
                              <td>Super Admin</td>
                              <td>All</td>
                              <td><a href="javascript:void();">Delete</a></td>
                          </tr>
                      </table>
                  </div>
              </div>
          </div>  
      
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
