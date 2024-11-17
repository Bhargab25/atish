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
  <?php echo $this->sidebar; ?>

  <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Assets
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Assets</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-bell-o"></i> Note:</h4>
				<p>If you put multiple asset in same locker space then Occupency feature is not available.</p>	
                </div>
		<?php if($this->error_u != ''){ ?>
      	      	<div class="alert alert-warning alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-bell-o"></i> <?php echo $this->error_u; ?></h4>
					
                </div>
	<?php	} ?>
			<?php if($this->error_p != ''){ ?>
      	      	<div class="alert alert-info alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-check"></i> <?php echo $this->error_p; ?></h4>
					Asset Serial Number : <?php echo $this->curD; ?> 
                </div>
	<?php	} ?>
		<div class="row">
		
			
		<div class="col-md-12">
          <div class="box box-solid box-default">
            <div class="box-header">
              <div class="col-md-6">  
              <h3 class="box-title">Asset List</h3>
</div>  
                
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding" >
              <table id="csv_table" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>Sl.</th>
                  <th>MacId</th>
                  <th>Csv FileName</th>
                  <th>Url</th>
                  <th>Action</th>
                </tr>
                </thead>
				<tbody>
					
					<tr>
					<td><?php echo '1'; ?></td>
					<td id="macid_label"></td>
					<td id="filename_label"></td>
					<td></td>
					<td> 
                        <button name="change" id="change">Change</button>
 </td>
					</tr>
					
				</tbody>
               <tfoot>
                <tr>
                  <th>Sl.</th>
                  <th>Mac Id</th>
                  <th>Csv FileName</th>
                  <th>Url</th>
                  <th>Action</th>
                </tr>
                </tfoot>
                
              </table>
            </div>
            <!-- /.box-body -->
			  <div class="box-footer clearfix">
              <ul class="pagination pagination-sm no-margin pull-right">
                  
                <li><a href="#">&laquo;</a></li>
                  <?php 
                    #looping as per total locks
                     $pageCount = ceil($this->TotalLockers/16);
                    for($i=1; $i<=$pageCount; $i++){
                    ?>
                <li><a href="#" ><?php echo $i; ?></a></li>
                  <?php
                    }
                    ?>
                <li><a href="#">&raquo;</a></li>
              </ul>
            </div>
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
      <b>Version</b> 2.4.0
    </div>
    <strong>Copyright &copy; 2018-2020 <a href="https://eegrab.com">eegrab</a>.</strong> All rights
    reserved.
  </footer>


</div>
	
<?php echo $this->footer; ?>
