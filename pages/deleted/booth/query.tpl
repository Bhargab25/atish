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
        Query Management for feedback form
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">question management</li>
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
					
                </div>
	<?php	} ?>
		<div class="row">
		<div class="col-md-4">
		<form role="form" method="post" name="query" action="query.php">	
		<div class="box box-default box-solid">
    	<div class="box-header with-border"><h4 class="box-title">Add New Query</h4></div>
    	<div class="box-body">
		<div class="form-group">
        
        <label>Select Booth</label>
                  <select class="form-control select2" name="booth[]" required multiple="multiple" data-placeholder="Select Booth" >
                      <?php
                            if(!empty($this->getAllBooth)){
                                foreach($this->getAllBooth as $ge){
                           
                           ?>
                            
                      <option value="<?php echo $ge->ID; ?>"><?php echo $ge->NAME; ?></option>
                      <?php
}}

?>
                      
                   
                  </select>
		<br/>    
	
		<label>Question:</label>
        <input id ="que" name="que" type="text" class="form-control"  placeholder="Enter your query">
        </div>
		</div>
			<div class="box-footer with-border">
			<button type="submit" class="btn btn-flat btn-success btn-social" name="ad"><i class="fa fa-plus"></i> Add Query</button>
		    <button type="reset" class="btn btn-flat btn-warning pull-right">Cancel</button>
			</div>
		</div>
			</form>	
            
        <form role="form" method="post" name="query_update" id="query_update" action="query.php" style="display: none">	
            <input type="hidden" name='id' value="">
		<div class="box box-default box-solid">
    	<div class="box-header with-border" style="background-color: yellowgreen"><h4 class="box-title">Update Query</h4></div>
    	<div class="box-body">
		<div class="form-group">
        
        <label>Select Booth</label>
                  <select class="form-control select2" name="booth[]" required multiple="multiple" data-placeholder="Select Booth" >
                      <?php
                            if(!empty($this->getAllBooth)){
                                foreach($this->getAllBooth as $ge){
                           
                           ?>
                            
                      <option value="<?php echo $ge->ID; ?>"><?php echo $ge->NAME; ?></option>
                      <?php
}}

?>
                      
                   
                  </select>
		<br/>    
	
		<label>Question:</label>
        <input id ="que" name="que" type="text" class="form-control"  placeholder="Enter your query">
        </div>
		</div>
			<div class="box-footer with-border">
			<button type="submit" class="btn btn-flat btn-success btn-social" name="ad"><i class="fa fa-plus"></i> Add Query</button>
		    <button type="reset" class="btn btn-flat btn-warning pull-right">Cancel</button>
			</div>
		</div>
			</form>    
		</div>
			
		<div class="col-md-8">
          <div class="box box-solid box-default">
            <div class="box-header">
              <h3 class="box-title">Query List</h3>

            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered" id="example1">
               <thead>
 <tr>
                  <th style="width: 10px">#</th>
                  <th> QUERY</th>
				  <th>BOOTH ID</th>	
                    
				  <th style="width: 40px">Action</th>
                </tr>
</thead>
				 <tbody>
<?php 
                    $i=1;
                    if(!empty($this->getquery)){
                    foreach($this->getquery as $query){                    
                    ?>
          <tr>
                  <td><?php echo $i; ?></td>
                  <td><?php echo $query->QUERY; ?></td>
					
				 <td><?php $blist = Utils::CSV_TO_ARRAY($query->BOOTHID); 
                                foreach($blist as $bl){ ?>
                        <span class="label label-info"><?php echo Booth_Model::ReadSingle($bl)->NAME; ?>                      <button type="button" class="btn btn-box-tool" onclick="delete_booth('<?php echo $bl; ?>','<?php echo $query->ID;?>')"><i class="fa fa-times"></i>
                    </button></span>    
                        <?php } ?></td>
                  <td style="text-align: center; font-size: 16px;"><a href="javascript:void();" onClick="update_query('<?php echo $query->ID;?>');" class="glyphicon  glyphicon-edit"></a> |<a href="delete.php?<?php echo base64_encode('id').'='.base64_encode($query->ID); ?>" onClick="return confirm('are you sure you want to delete this visitor')" class="glyphicon  glyphicon-trash"></a> </td>
                </tr>        
<?php
$i++;
} }  ?>
</tbody>
        <tfoot>
                   <tr>
                 <th style="width: 10px">#</th>
                  <th> QUERY</th>
				  <th>BOOTH ID</th>	
                    
				  <th style="width: 40px">Action</th>
                </tr>
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
      <b>Version</b> 2.4.0
    </div>
    <strong>Copyright &copy; 2018-2020 <a href="https://eegrab.com">eegrab</a>.</strong> All rights
    reserved.
  </footer>


</div>
	
<?php echo $this->footer; ?>
