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
        Floors
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Floors</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      	      	<div class="alert alert-info alert-dismissible" style="display: none;">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-check"></i> New Device Added Successfully!</h4>
					
                </div>
		<div class="row">
		<div class="col-md-12">
		<div class="box box-default box-solid">
            <table class="table table-bordered table-hover dataTable" id="example1">
                     <tr> <th>Floor Name</th>
                      <th>Building Name</th>
                      <th>Created Date</th>
                    </tr>
                    <?php 
                        foreach($this->floor as $flr){
                        ?>
                    
                    <tr>
                        <td><?php echo $flr['name']; ?></td>
                        <td><?php echo $flr['group_name']; ?></td>
                        <td><?php echo $flr['created']; ?></td>
                    </tr>
                    <?php
                        }
                    ?>
                  </table>
		</div>
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
