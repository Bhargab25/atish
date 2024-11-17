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
        Company Settings
        <small>only admin can view</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Company Management</a></li>
        <li class="active">Settings</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      
      <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box">
                <form name="settings" method="post" >
                <input type="hidden" name="cid" id="cid" value="<?php echo $this->company->CID; ?>" />    
            <div class="box-header">
              <h3 class="box-title">Your Company Settings</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              
				<div class="row">
					<div class="col-md-6">
						<label for="fname">Company Name</label>	
                  			<input type="text" class="form-control" value="<?php echo $this->company->CNAME; ?>" id="cname" name="cname" >
					</div>
				   <div class="col-md-6">
						<label for="fname">Company Email</label>	
                  			<input type="text" class="form-control" value="<?php echo $this->company->CONTACTEMAIL; ?>" id="cemail" name="cemail" >
					</div>
				</div>	
				<div class="clearfix" style="margin: 10px"></div>
				<div class="row">
					<div class="col-md-6">
						<label for="fname">Company Domain</label>	
                  			<input type="text" value="<?php echo $this->company->DOMAIN; ?>" class="form-control" id="cdomain" name="cdomain" >
					</div>
				   <div class="col-md-6">
						<label for="fname">Company Phone</label>	
                  			<input type="text" value="<?php echo $this->company->CONTACTPHONE; ?>" class="form-control" id="cphone" name="cphone" >
					</div>
				</div>	
				<div class="clearfix" style="margin: 10px"></div>
				<div class="row">
					<div class="col-md-6">
						<h3>
							Company Settings:
						</h3>
						<table width="100%">
							<tr>
								<th>Number of slots Alowed
								   <article>1 slot = 15 keys</article>
								</th
								<td>
                                <input type="text" name="slotnum" id="slotnum" value="<?php echo $this->company->SLOTS; ?>" >
								
								</td>
							</tr>
							
							
						</table>
					</div>
					
					<div class="col-md-6">
						<h3>
							KeyRacks Facilities:
						</h3>
						<table class="table">
							<tr align="right">
								<th>User Can book any number of keys 
								
								</th>
								<th><label>
                                    Single Booking
                                    <?php 
                                        if($this->getSettings->MULTI_BOOKING == '1'){
?>
                                    <input type="radio" name="BookAss" value="1" checked ></label>
                                    <?php
}else{
?>
                                     <input type="radio" name="BookAss" value="1"  ></label>
                                    <?php
}
?>
                                    <label>
                                    
								</th>
                                    <th >
                                    Multiple Booking
                                    <?php 
                                        if($this->getSettings->MULTI_BOOKING > '1'){
?>    
 <input type="radio" name="BookAss" value="0" checked  ></label>
								    <input type="text" name="AssetBook" id="AssetBook" value="<?php echo $this->getSettings->MULTI_BOOKING; ?>" style="display: block">
                                        <?php }else{ ?>
                                        <input type="radio" name="BookAss" value="0"  ></label>
								    <input type="text" name="AssetBook" id="AssetBook" value="" style="display: none">
                                        <?php } ?>

                                    
                                </th>
							</tr>
							
							
							
						</table>
					</div>
				</div>
				<div class="clearfix" style="margin: 10px"></div>
            
            </div>
			  
            <!-- /.box-body -->
			 <div class="box-footer">
			 	<div class="row">
				 	<div class="col-md-6 col-pull-right">
						<button type="submit" name="submit" class="btn btn-success pull-right" style="margin:0 10px;"><i class="fa fa-gear"></i> Update
          </button>  &nbsp;
						<button type="reset" class="btn btn-warning pull-right"><i class="fa fa-gear"></i> Cancel
          </button>
					</div>
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
