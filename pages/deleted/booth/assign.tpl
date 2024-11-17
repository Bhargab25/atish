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
        Booths
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Booths</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
          <?php if(isset($_GET['e'])){ ?>
      	      	<div class="alert alert-danger alert-dismissible" >
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-check"></i> Sorry this booth is assign to an event!</h4>
					
                </div>
        <?php } ?>
		<div class="row">	
		<div class="col-md-12">
          <div class="box box-solid box-default">
            <div class="box-header">
              <h3 class="box-title">Booth List</h3>

            </div>
            <!-- /.box-header -->
            <div class="box-body">
             <table id="example1" class="table table-bordered table-hover">
                 <thead>
                <tr>
                  <th style="width: 10px">#</th>
                  <th>Name</th>
				  <th>Description</th>
                  <th>Services</th>
                     <th>Event Name</th>
                     <th>Assign</th>
				  <th style="width: 40px">Action</th>
                </tr>
                </thead>
                 <tbody>
                    <?php 
                            $l=1;

                        if(!empty($this->allBooth)){
                         foreach($this->allBooth as $booth){
?>
                    <tr>
                        <td><?php echo $l; ?></td>
                        <td><?php echo $booth->NAME; ?></td>
                        <td><?php echo $booth->DESCRIPTION; ?></td>
                        <td><?php $service = Utils::CSV_TO_ARRAY($booth->SERVICES);
                           for($i=0; $i<count($service);$i++){
?>
                            <small class="label pull-right bg-blue" style="margin: 0 2px;"> <?php echo ServiceModel::ReadSingle($service[$i])->NAME;  ?>                 
      </small>
                            <?php
}

?></td>
                        <td>
                            <?php #get current event
                                $event = EVENT_MODEL::ReadSingleBybooth($booth->ID);
                                if(empty($event)){
                                echo 'Not Assign';
                                }else{
                                echo $event->NAME;
                                }
                            ?>
                        </td>
                        <td>
                            <?php if($booth->CAMPAIGN_ID != ''){ ?>
                            <select name="device" onChange="assignToBoothRegistration(this,<?php echo $booth->ID; ?>,<?php echo $event->ID ?>)">
                                <option>-- SELECT --</option>
                            <?php 
                                foreach($this->freeDevice as $fd){
                                #get device assign  or not
                                $as_id = DEVICE_ASSIGN_MODEL::ReadSingleByDevice($fd->ID);
echo $as_id->STATUS;
                                
                                $boothLogin = BoothLogin_Model::ReadSingleByEventBoothdevice($event->ID,$booth->ID,$fd->ID);
                            ?>
            <option value="<?php echo $fd->ID; ?>" <?php if($as_id->STATUS == 'BOOKED' and $boothLogin->DEVICE_UUID !=''){ ?> selected <?php } ?>   ><?php echo $fd->NAME; ?></option>
                            
                                
                         
<?php
  } ?>
                                </select>
                        <?php } ?>
                        </td>
                        <td><a href="delete.php?id=<?php echo base64_encode($booth->ID); ?>" class="btn btn-danger">Delete</a></td>
                        </tr>
                    <?php
$l++;
}
}
                        ?> 
                    </tbody>
                 <tfoot>
                 <tr>
                  <th style="width: 10px">#</th>
                  <th>Name</th>
				  <th>Description</th>
                  <th>Services</th>
                 <th>Event Name</th>
                 <th>Assign</th>
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
      <b>Version</b> 1.1.0
    </div>
    <strong>Copyright &copy; 2019-2020 <a href="https://eegrab.com">EEGRAB</a>.</strong> All rights
    reserved.
  </footer>

</div>
<!-- ./wrapper -->

<?php echo $this->footer; ?>
