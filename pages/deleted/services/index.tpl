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
        Services
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Services</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <?php if($this->error_p != ''){ ?>
      	      	<div class="alert alert-warning alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-alert"></i> <?php echo $this->error_p; ?></h4>
					
                </div>
        <?php } ?>
		<div class="row">
		<div class="col-md-4">
		<div class="box box-default box-solid">
            <form class="" name="deviceForm" action="index.php" method="post" enctype="multipart/form-data">
    	<div class="box-header with-border"><h4 class="box-title">Add New Service</h4></div>
    	<div class="box-body">
		<div class="form-group">
        <label>Service Name</label>
        <input type="text" id="sname" name="sname"  required class="form-control" placeholder="Enter Device Name">
		
		<br/>
		<label>Description</label>
       <textarea name="desc" id="desc" class="form-control" >
            </textarea>
		<br/>
		<label>Select Booth to assign services[Optional]</label>
            <br/>
        <select name="booth" id="booth" class="form-control">
            <option value="">--Select--</option>  
            <?php foreach($this->booths as $bt){ ?>
            <option value="<?php echo $bt->ID; ?>"><?php echo $bt->NAME; ?></option>  
            <?php } ?>
        </select>    
        </div>
		</div>
			<div class="box-footer with-border">
			<button type="submit" name="da" class="btn btn-flat btn-success btn-social"><i class="fa fa-plus"></i> Add Services</button>
		    <button type="reset" class="btn btn-flat btn-warning pull-right">Cancel</button>
			</div>
                </form>
		</div>
		</div>
			
		<div class="col-md-8">
          <div class="box box-solid box-default">
            <div class="box-header">
              <h3 class="box-title">Services List</h3>

            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-hover">
                <thead>
                 <tr>
                  <th style="width: 10px">#</th>
                  <th>Name</th>
				  <th>Description</th>
                  <th>Booths</th>
				  <th style="width: 40px">Action</th>
                </tr>
                </thead>
                <tbody>
                    <?php 
                            $i=1;

                        if(!empty($this->services)){
                         foreach($this->services as $serv){
?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $serv->NAME; ?></td>
                        <td><?php echo $serv->DESCRIPTION; ?></td>
                        <td><?php 
                            if($serv->BOOTHID == 0){
echo "Not Assign";
}else{
?>
                            <small class="label pull-right bg-blue" style="margin: 0 2px;">
<?php                             
echo Booth_Model::ReadSingle($serv->BOOTHID)->NAME;
?></small>
          <?php                      
}?></td>
                        <td><a href="delete.php?id=<?php echo base64_encode($serv->ID); ?>" class="btn btn-danger">Delete</a></td>
                        </tr>
                    <?php
$i++;
}
}
                        ?>
                </tbody>
                <tfoot>
                <th style="width: 10px">#</th>
                  <th>Name</th>
				  <th>Description</th>
                  <th>Booths</th>
				  <th style="width: 40px">Action</th>
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
      <b>Version</b> 2.1.0
    </div>
    <strong>Copyright &copy; 2019-2020 <a href="https://eegrab.com">EEGRAB</a>.</strong> All rights
    reserved.
  </footer>

</div>
<!-- ./wrapper -->

<?php echo $this->footer; ?>
