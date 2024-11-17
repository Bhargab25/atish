<?php echo $this->header; ?>
<?php
 
$dataPoints = array();
//Best practice is to create a separate file for handling connection to database
try{
     // Creating a new connection.
    // Replace your-hostname, your-db, your-username, your-password according to your database
    $link = new \PDO(   'mysql:host=localhost;dbname=eHub;charset=utf8mb4', //'mysql:host=localhost;dbname=canvasjs_db;charset=utf8mb4',
                        'root', //'root',
                        'Sargam777@', //'',
                        array(
                            \PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                            \PDO::ATTR_PERSISTENT => false
                        )
                    );
	
    $handle = $link->prepare("SELECT t1.month,

coalesce(SUM(t1.ongoing+t2.ongoing), 0) AS ongoing,
coalesce(SUM(t1.ongoing+t2.upcoming), 0) AS upcoming,
coalesce(SUM(t1.ongoing+t2.end), 0) AS end,
coalesce(SUM(t1.ongoing+t2.abort), 0) AS abort
from
(select DATE_FORMAT(a.Date,'%b') as month,
  DATE_FORMAT(a.Date, '%m-%Y') as md,
  '0' as  ongoing
  from (
    select curdate() - INTERVAL (a.a + (10 * b.a) + (100 * c.a)) DAY as Date
    from (select 0 as a union all select 1 union all select 2 union all select 3 union all select 4 union all select 5 union all select 6 union all select 7 union all select 8 union all select 9) as a
    cross join (select 0 as a union all select 1 union all select 2 union all select 3 union all select 4 union all select 5 union all select 6 union all select 7 union all select 8 union all select 9) as b
    cross join (select 0 as a union all select 1 union all select 2 union all select 3 union all select 4 union all select 5 union all select 6 union all select 7 union all select 8 union all select 9) as c
  ) a
  where a.Date <= NOW() and a.Date >= Date_add(Now(),interval - 6 month)
  group by md )t1
left join
(
  SELECT DATE_FORMAT(`ENDDATE`, '%b') AS month, SUM(if(`STATUS`='ONGOING',1,0)) as ongoing , SUM(if(`STATUS`='COMMING SOON',1,0)) as upcoming ,SUM(if(`STATUS`='END',1,0)) as end,SUM(if(`STATUS`='ABORT',1,0)) as abort,DATE_FORMAT(`ENDDATE`, '%m-%Y') as md FROM events where `ENDDATE` <= NOW() and `ENDDATE` >= Date_add(Now(),interval - 6 month)
  GROUP BY md
)t2
on t2.md = t1.md 
group by t1.md
order by t1.md"); 
    $handle->execute(); 
    $result = $handle->fetchAll(\PDO::FETCH_OBJ);
	//print_r($result);	
    foreach($result as $row){
		//echo $row->total;
        array_push($dataPoints, array("label"=> $row->month, "y"=> $row->ongoing,"y1"=> $row->upcoming));
    }
	$link = null;
}
catch(\PDOException $ex){
    print($ex->getMessage());
}
?>
<script>
window.onload = function() {
 
var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	theme: "light2",
	title:{
		text: "Yearly Report"
	},
	axisY: {
		title: "Monly Report (Number of events)"
	},
	data: [{
		type: "column",
		yValueFormatString: "#,##0.## Events",
		dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
	}]
});
chart.render();
 
}
</script>
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
        Reports
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Reports</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      	      	<div class="alert alert-info alert-dismissible" style="display: none;">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-check"></i> New Device Added Successfully!</h4>
					
                </div>
		<div class="row">
		
			
		<div class="col-md-4">
          <div class="box box-solid box-default">
            <div class="box-header">
              <h3 class="box-title">Event History</h3>

            </div>
            <!-- /.box-header -->
            <div class="box-body chart-responsive">
                <h3>Current Year:<strong> <?php echo date('Y'); ?></strong></h3> 
                <form>
                    <select>
                        <option>Yearly</option>
                        <option>Monthly</option>
                        <option>Weekly</option>
                    </select>
                </form>
               <div class="chart" id="event-chart" style="height: 300px; position: relative;"></div>
            </div>
            <!-- /.box-body -->
			  <div class="box-footer clearfix">
                <button class="default btn" id="eventchart">Download CSV <i class="fa fa-fw fa-download"></i></button>
              
            </div>
          </div>
          <!-- /. box -->
          
        </div>
		<div class="col-md-8">
            <div class="box box-solid box-default">
                <div class="box-header">
              <h3 class="box-title">Current Event</h3>

            </div>
                <div class="box-body">
                
                    <div id="chartContainer" style="height: 370px; width: 100%;">
                </div>
                 <div class="box-footer clearfix">
                <button class="default btn" id="eventchart">Download CSV <i class="fa fa-fw fa-download"></i></button>
              
            </div>
            </div>
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
