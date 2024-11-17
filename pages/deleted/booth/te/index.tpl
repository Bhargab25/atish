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
      	      	<div class="alert alert-info alert-dismissible" >
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-check"></i> Sorry this booth is assign to an event!</h4>
					
                </div>
        <?php } ?>
		<div class="row">
		<div class="col-md-6">
		<div class="box box-default box-solid">
            <form class="" name="boothform" action="" method="post" enctype="multipart/form-data">
    	<div class="box-header with-border"><h4 class="box-title">Add New Booth</h4></div>
    	<div class="box-body">
		<div class="form-group">
        <label>Select location</label>
            <br/>
        <select name="booth" id="booth" class="form-control" onChange="getPlacemarker(this);">
            <option value="">--Select--</option>   
            <?php
                foreach($this->placemarks as $plc){
                if($plc['name'] != "" and $plc['is_facility'] != true){?>
            <option value="<?php echo $plc['id']; ?>"><?php echo $plc['name']; ?></option>   
            <?php
}}

            ?>
        </select>  
            </div>
            <br/>  
       <div class="form-group">
        <label>Select Campaign</label>
            <br/>
        <select name="camp" id="camp" class="form-control" onChange="getcamp(this);">
            <option value="">--Select--</option>   
            <?php
                foreach($this->campaigns as $camp){
                $today = date('Y-m-d H:i:s');
               
                if($camp['allday'] == 'true' || $camp['always_broadcast'] == 'true'){
                 #check this campaign is assign to any booth or not
                 $checkBooth = Booth_Model::ReadSingleByCampaign($camp['id']);
                 if(empty($checkBooth)){


                ?>
            <option value="<?php echo $camp['id']; ?>"><?php echo $camp['title']; ?></option>   
            <?php
}
}else{
#check campaing is end or not
$c_startdate = date('Y-m-d H:i:s',strtotime($camp['dtstart']));
$c_enddate = date('Y-m-d H:i:s',strtotime($camp['dtend']));
$today = date('Y-m-d H:i:s');
if(strtotime($c_startdate)<= strtotime($today) and strtotime($c_enddate) >= strtotime($today)){
 #check this campaign is assign to any booth or not
  $checkBooth = Booth_Model::ReadSingleByCampaign($camp['id']);
   if(empty($checkBooth)){
#show campaign
?>
        <option value="<?php echo $camp['id']; ?>"><?php echo $camp['title']; ?></option>       
            <?php
}
}else{
#update all booth and clear campaign

}
}
}

            ?>
        </select>  
            </div>
            <br>
        <div id="addbooth" class="form-group" style="display: none">
        <label>Booth Name</label>
        <input type="text" id="bname" name="bname"  required class="form-control" placeholder="Enter Booth Name">
		
		<br/>
		<label>Description</label>
       <textarea name="desc" id="desc" class="form-control" >
            </textarea>
		<br/>
		<label>Select services to assign booth[Optional]</label>
            <br/>
        <select name="services[]"  id="services" class="form-control select2"  multiple="multiple" data-placeholder="Select Booths"
                        style="width: 100%;">
            <option value="">--Select--</option> 
            <?php foreach($this->services as $srv){ ?>
            <option value="<?php echo $srv->ID; ?>"><?php echo $srv->NAME; ?></option> 
            <?php } ?>
        </select>  
        <br/>
		<label>Booth Logo</label>
        <input type="file" name="logo" class="form-control" placeholder="Upload your logo">
        
            
        </div>
		</div>
			<div class="box-footer with-border">
			<button type="submit" name="da" class="btn btn-flat btn-success btn-social"><i class="fa fa-plus"></i> Add Booth</button>
		    <button type="reset" class="btn btn-flat btn-warning pull-right">Cancel</button>
			</div>
                </form>
		</div>
		</div>
			
		<div class="col-md-6">
          <div class="box box-solid box-default">
            <div class="box-header">
              <h3 class="box-title">Booth List</h3>

            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
             <table id="example1" class="table table-bordered table-hover">
                 <thead>
                <tr>
                  <th style="width: 10px">#</th>
                  <th>Name</th>
				  <th>Description</th>
                  <th>Services</th>
				  <th style="width: 40px">Action</th>
                </tr>
                </thead>
                 <tbody>
                    <?php 
                            $i=1;

                        if(!empty($this->allBooth)){
                         foreach($this->allBooth as $booth){
?>
                    <tr>
                        <td><?php echo $i; ?></td>
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
                        <td><a href="delete.php?id=<?php echo base64_encode($booth->ID); ?>" class="btn btn-danger">Delete</a></td>
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
                  <th>Name</th>
				  <th>Description</th>
                  <th>Services</th>
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
