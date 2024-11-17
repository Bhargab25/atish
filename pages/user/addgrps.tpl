<?php echo $this->header; ?>
<body class="skin-purple sidebar-mini">
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
        Manage your groups
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">groups</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div id='loader' style="z-index: 2; background: #fff; top: 0;  width: 100vw; height: 100vh; position: absolute; opacity: 0.5; display: none;"><img src="../../dist/img/loader.gif" /></div>
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
					Your Group Name : <?php echo $this->curD; ?> 
                </div>
	<?php	} ?>
       
		<div class="row">
		<div class="col-md-6">
		<form role="form" method="post" name="Asset" action="addgrps.php">	
		<div class="box box-default box-solid">
    	<div class="box-header with-border"><h4 class="box-title">Add New Group</h4></div>
    	<div class="box-body">
		<div class="form-group">
        <label>Group Name: </label>
       <input type="text" id="groupid" name="groupid" value="" class="form-control">
		<br/>
            
		
        </div>
		</div>
			<div class="box-footer with-border">
			<button type="submit" class="btn btn-flat btn-success btn-social" name="ad"><i class="fa fa-plus"></i> Add Group</button>
		    <button type="reset" class="btn btn-flat btn-warning pull-right">Cancel</button>
			</div>
		</div>
			</form>	
		</div>
			
		<div class="col-md-6">
            
          <div class="box box-solid box-default">
            <div class="box-header">
              <h3 class="box-title">Group List</h3>

            </div>
            <!-- /.box-header -->
            <div class="box-body " id="assetlist">
              <table id="asset_table" class="table table-bordered table-hover">
                <thead>
                    
                <tr>
                   <th style="width: 10px">#</th>
                  <th>Group ID</th>
				  <th>Access Detail</th>
                  
				  <th style="width: 40px">Action</th>
                </tr>
                </thead>
                <tbody>
				 <?php 
                    $i=1;
                    foreach($this->grps as $grp){ ?>
				<tr>
                    <!-- data-toggle="modal" data-target="#modal-default" -->
                 <td><?php echo $i; ?></td>
                  
				  <td><?php echo $grp->GNAME; ?></td>
                  <td style="text-align: center; font-size: 16px;"><i class="fa fa-fw fa-eye" data-toggle="modal" data-target="#modal-default"  onClick="showdata('<?php echo $grp->GNAME; ?>','<?php echo $grp->ID; ?>')"></i></td>
				  <td style="text-align: center; font-size: 16px;"><a href="grpdelete.php?gid=<?php echo base64_encode($grp->ID) ?>" onClick="return confirm('are you sure, you want to delete this asset')"><i class="fa fa-fw fa-close"></i></a></td>
                </tr>  
				<?php
$i++;
				}
				?>
				</tbody>
                <tfoot>
                <tr>
                    <th style="width: 10px">#</th>
                  <th>Group ID</th>
				  <th>Access Detail</th>
                  <th style="width: 40px">Action</th>
				 
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
			 <div class="modal fade" id="modal-default">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header" style="background-color: #ffd800 !important;">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Default Modal</h4>
              </div>
              <div class="modal-body">
                
             
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
               
              </div>    
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
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
