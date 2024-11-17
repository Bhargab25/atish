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
		<div class="col-md-6">
		<form role="form" method="post" name="category" action="cat.php">	
		<div class="box box-default box-solid">
    	<div class="box-header with-border"><h4 class="box-title">Add New Assets Category</h4></div>
    	<div class="box-body">
		<div class="form-group">
        <label>Category Name</label>
        <input type="text" name="cname" class="form-control" placeholder="Enter category name">
		<br/>
		
		
        </div>
		</div>
			<div class="box-footer with-border">
			<button type="submit" class="btn btn-flat btn-success btn-social" name="ad"><i class="fa fa-plus"></i> Add Category</button>
		    <button type="reset" class="btn btn-flat btn-warning pull-right">Cancel</button>
			</div>
		</div>
			</form>	
		</div>
			
		<div class="col-md-6">
          <div class="box box-solid box-default">
            <div class="box-header">
              <h3 class="box-title">Category List</h3>

            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <table class="table">
				
                <tr>
                  <th style="width: 10px">#</th>
                  <th>Category Name</th>
				  <th>Entry Date</th>
                  <th style="width: 40px">View</th>
				  <th style="width: 40px">Edit</th>
                </tr>
				 <?php  
                $i=1;
				foreach($this->category as $cat){ ?> 
                <tr>
                  <td><?php echo $i; ?></td>
                  <td><?php echo $cat->NAME; ?></td>
				  <td><?php echo $cat->CREATEDATE; ?></td>
                  <td style="text-align: center; font-size: 16px;"><i class="fa fa-fw fa-eye"></i></td>
				  <td style="text-align: center; font-size: 16px;"><a href="edit.php?id=<?php echo $cat->ID; ?>"><i class="fa fa-fw fa-cog"></i></a></td>
                </tr>
				<?php $i++ ; } ?>
              </table>
            </div>
            <!-- /.box-body -->
			  <div class="box-footer clearfix">
              <ul class="pagination pagination-sm no-margin pull-right">
                <li><a href="#">&laquo;</a></li>
                <li><a href="#">1</a></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
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
