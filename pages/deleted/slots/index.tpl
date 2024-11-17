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
        Key Slots
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Key Slots</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <?php if($this->error_p != ''){ ?>    
      	      	<div class="alert alert-danger alert-dismissible" >
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-check"></i> <?php echo $this->error_p; ?></h4>
					
                </div>
        <?php } ?>
        
		<div class="row">
		<div class="col-md-12">
		<div class="box box-default box-solid">
            <form class="" name="keyForm" action="index.php" method="post" enctype="multipart/form-data">
    	<div class="box-header with-border"><h4 class="box-title">Add New Key</h4></div>
    	<div class="box-body">
            <div class="form-group col-xs-4">
        <label>Select Rack</label>
               <select class="form-control">
                    <option>1</option>
                </select>
		 </div>
		<div class="form-group col-xs-4">
        <label>Number Of Key</label>
        <input type="text" id="keyname" name="keyname"  required class="form-control" placeholder="Enter Number Of Key">
		 </div>
            <div class="form-group col-xs-4">
      <br>
        <button type="submit" name="da" class="btn btn-flat btn-success btn-social "><i class="fa fa-plus"></i> Show Keys</button>
		 </div>
         
		
       
		</div>
			<div class="box-footer with-border">
			
		    <button type="reset" class="btn btn-flat btn-warning pull-right">Cancel</button>
			</div>
                </form>
		</div>
		</div>
			</div>	
        <div class="row">
		<div class="col-md-12">
          <div class="box box-solid box-default">
            <div class="box-header">
              <h3 class="box-title">Key List</h3>

            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered table-hover" id="example1">
                <thead>
<tr>
                  <th style="width: 10px">#</th>
                  <th>KEY Name</th>
				  <th>RFID Number</th>
                 
                  <th style="width: 40px">Status</th>
				  <th style="width: 40px">Action</th>
                </tr>
</thead>
                
                  <tbody>
  <?php 
                            $i=1;

                        if(!empty($this->allDevice)){
                         foreach($this->allDevice as $advc){
?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $advc->NAME; ?></td>
                        <td><?php echo $advc->SERIAL_No; ?></td>
                   
                        <td><?php 
                                #check device assign or free
                                $ass = DEVICE_ASSIGN_MODEL::ReadSingleByDevice($advc->ID);
                                if(empty($ass)){
                                echo 'FREE';
}else{
    if($ass->STATUS == 'FREE'){
echo 'FREE';
} else{
echo 'ASSIGNED';
}               
}
                        ?></td>
                        <td>
                            <?php if(empty($ass) or $ass->STATUS == 'FREE'){ ?>
                            <a href="delete.php?id=<?php echo base64_encode($advc->ID); ?>" class="btn btn-danger" onClick="return confirm('are you sure want to delete this device?')">Delete</a>
                            <?php } ?>
                        </td>
                        </tr>
                    <?php
$i++;
}
}
                        ?>  
</tbody>
                  <tfoot>
                  <tr>
                  <th style="width: 10px">#</th>
                  <th>Device Name</th>
				  <th>Serial Number</th>
                  <th style="width: 40px">Status</th>
				  <th style="width: 40px">Action</th>
                </tr>
                  </tfoot>
                
              </table>
            </div>
            <!-- /.box-body -->
			  <div class="box-footer clearfix">
        
              
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
      <b>Version</b> 1.1.0
    </div>
    <strong>Copyright &copy; 2019-2020 <a href="https://eegrab.com">EEGRAB</a>.</strong> All rights
    reserved.
  </footer>

</div>
<!-- ./wrapper -->

<?php echo $this->footer; ?>
