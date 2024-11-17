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
        Rack
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Racks</li>
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
					You KeyRacks Number : <?php echo $this->curD; ?> 
                </div>
	<?php	} ?>
        <div class="row">
        <div class="col-md-12">
            <div class="callout callout-info" style="display: none" id="ajaxreport">
                <h4 id="error">
                </h4>
                <p></p>
            </div>
            <div class="box box-primary">
               <div class="box-header with-border">
              <h3 class="box-title">Bulk Slots with KeyRacks Upload</h3>
                <form role="form" method="post" name="bulk_asset" >
                    <div class="col-xs-6">
					 <label for="fname">Upload your CSV file:</label>	
                  <input type="file" class="form-control" required id="ass_csv" name="ass_csv" placeholder="Upload your csv file">
                        
                 <p><a href="../../profile/sampleAssetData.csv"><strong>Download</strong> your Sample CSV file from here</a></p>        
                </div>
                    <div class="col-xs-6"> 
                      <label><br></label><br>
                    <button type="submit" name="upload" class="btn btn-primary">Upload</button>
				  </div>
                </form> 
                 </div>    
            </div>
        </div>
        </div>
		<div class="row">
		<div class="col-md-6">
		<form role="form" method="post" name="Asset" action="index.php">	
		<div class="box box-default box-solid">
    	<div class="box-header with-border"><h4 class="box-title">Add New Slot</h4></div>
    	<div class="box-body">
		<div class="form-group">
        <label>Select Slot: </label>
        <select id="slotid">
            <option value="1">1</option>    
        </select>
		<br/>
        <table class="table">
            <tr>
                <th>#</th>
                <th>TagID</th>
                <th>Key Num</th>
            </tr>
            <tr>
                <td>1.</td>
                <td><input type="text" id="tagid_1" name="tagid_1" value="" class="form-control"></td>
                <td><select id="keynum" name="keynum">
                    <option>-- Select --</option>
                        <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                    <option value="11">11</option>
                    <option value="12">12</option>
                    <option value="13">13</option>
                    <option value="14">14</option>
                    <option value="15">15</option>
                    </select></td>
            </tr>
            
            
        </table>    
		
        </div>
		</div>
			<div class="box-footer with-border">
			<button type="submit" class="btn btn-flat btn-success btn-social" name="ad"><i class="fa fa-plus"></i> Add Racks</button>
		    <button type="reset" class="btn btn-flat btn-warning pull-right">Cancel</button>
			</div>
		</div>
			</form>	
		</div>
			
		<div class="col-md-6">
            
          <div class="box box-solid box-default">
            <div class="box-header">
              <h3 class="box-title">Key Rack List</h3>

            </div>
            <!-- /.box-header -->
            <div class="box-body " id="assetlist">
              <table id="asset_table" class="table table-bordered table-hover">
                <thead>
                    
                <tr>
                   <th style="width: 10px">#</th>
                  <th>SlotID</th>
                   <th>Key No.</th>        
				  <th>TagID</th>
                  
                  <th style="width: 40px">Last Access</th>
				  <th style="width: 40px">Edit</th>
                </tr>
                </thead>
                <tbody>
				 <?php 
                    $i=1;
                    foreach($this->racks as $rack){ ?>
				<tr>
                    <!-- data-toggle="modal" data-target="#modal-default" -->
                 <td><?php echo $i; ?></td>
                  <td><?php echo $rack->SLOT_ID; ?></td>
				  <td><?php echo $rack->KEYNUM; ?></td>
                  <td><?php echo $rack->TAGID; ?></td>
                  <td style="text-align: center; font-size: 16px;"><i class="fa fa-fw fa-eye" data-toggle="modal" data-target="#modal-default"  onClick="showdata('<?php echo $rack->TAGID; ?>','<?php echo $rack->KEYNUM; ?>')"></i></td>
				  <td style="text-align: center; font-size: 16px;"><a href="delete.php?id=<?php echo base64_encode($rack->ID) ?>" onClick="return confirm('are you sure, you want to delete this asset')"><i class="fa fa-fw fa-close"></i></a></td>
                </tr>  
				<?php
$i++;
				}
				?>
				</tbody>
                <tfoot>
                <tr>
                  <th style="width: 10px">#</th>
                  <th>SlotID</th>
                   <th>Key No.</th>        
				  <th>TagID</th>
                  
                  <th style="width: 40px">Last Access</th>
				  <th style="width: 40px">Edit</th>
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
