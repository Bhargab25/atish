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
        Events
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Event</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      	      	<div class="alert alert-info alert-dismissible" style="display: none;">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-check"></i> New event Added Successfully!</h4>
					
                </div>
		<div class="row">
            <form class=""  action="index.php" method="post" enctype="multipart/form-data">
		    <div class="col-xs-12">
                <div class="box">
            <div class="box-header">
              <h3 class="box-title">All Events</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>Event Name</th>
                  <th>Start Date</th>
                  <th>End Date</th>
                  <th>Services</th>
                  <th>Invities</th>
                  <th>Status</th>    
                  <th>Action</th>        
                </tr>
                </thead>
                <tbody>
                    <?php 
                        foreach($this->getEvents as $ge){
                        #get Invities details by event
                        
//print_r($get_invites);
                    ?>
           
                <tr>
                  <td><a href="edit.php?e=<?php echo base64_encode($ge->ID); ?>"><?php echo $ge->NAME; ?></a></td>
                  <td><?php echo date('d-m-Y',strtotime($ge->STARTDATE)); ?></td>
                  <td><?php echo date('d-m-Y',strtotime($ge->ENDDATE)); ?></td>
                  <td><?php foreach(Utils::CSV_TO_ARRAY($ge->SERVICES) as $serv){?>
<small class="label pull-right bg-green" style="margin: 0 2px;"><?php echo ServiceModel::ReadSingle($serv)->NAME; ?></small>
                      <?php
}  ?></td>
                  <td>
                    <?php
$get_invites = INVITE_MODEL::ReadAllByEvnt($ge->ID);
//print_r($get_invites);
if(empty($get_invites)){
?>
                      <small class="label pull-right bg-red">No Invitation sent yet</small>                     
                      <?php
}else{
    foreach($get_invites as $gi){
    if($gi->STATUS == 'NO RESPONSE' or $gi->STATUS ==''){
?>
  <small class="label pull-right bg-blue" style="margin: 0 2px;">                    
<?php echo usermodel::ReadSingle($gi->USERID)->FNAME.' '.usermodel::ReadSingle($gi->USERID)->LNAME; ?>
      </small> 
<?php 
}else if($gi->STATUS == 'INTERESTED' or $gi->STATUS == 'MAYBE'){
?>
  <small class="label pull-right bg-green" style="margin: 0 2px;">                    
<?php echo usermodel::ReadSingle($gi->USERID)->FNAME.' '.usermodel::ReadSingle($gi->USERID)->LNAME; ?>
      </small> 
                      <?php 
}else if($gi->STATUS == 'NOT INTERESTED'){
?>
  <small class="label pull-right bg-red" style="margin: 0 2px;">                    
<?php echo usermodel::ReadSingle($gi->USERID)->FNAME.' '.usermodel::ReadSingle($gi->USERID)->LNAME; ?>
      </small> 
<?php 
}else if($gi->STATUS == 'NO RESPONSE'){
?>
  <small class="label pull-right bg-orange" style="margin: 0 2px;">                    
<?php echo usermodel::ReadSingle($gi->USERID)->FNAME.' '.usermodel::ReadSingle($gi->USERID)->LNAME; ?>
      </small>                       
                      <?php
}

}
}
?>
                        
                    </td>
                    <td><?php echo $ge->STATUS; ?></td>
                    <td><a href="javascript:void();" class="btn btn-default">+ Add People</a>
                        
                    </td>
                </tr>
                    <?php } ?>
            
                </tbody>
                <tfoot>
                <tr>
                   <th>Event Name</th>
                  <th>Start Date</th>
                  <th>End Date</th>
                  <th>Services</th>
                  <th>Invities</th>
                   <th>Status</th>
                   <th>Action</th>    
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>    
            </div>
			
		
            </form>
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
