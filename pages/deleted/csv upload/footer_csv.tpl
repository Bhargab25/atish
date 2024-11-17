<!-- bootstrap datepicker -->
  <link rel="stylesheet" href="../../bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
<!-- jQuery 3 -->
<script src="../../bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="../../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- DataTables -->
<script src="../../bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="../../bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- PACE -->
<script src="../../bower_components/PACE/pace.min.js"></script>
<!-- SlimScroll -->
<script src="../../bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="../../bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../dist/js/demo.js"></script>
<!-- page script -->
<script src="../../API/paho-mqtt.js"></script>
<script type="text/javascript">
  // To make Pace works on Ajax calls
	
	

//	
$(function () {

	 $('#example1').DataTable()
    $('#csv_table').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
var change = false;
var update = false;
var pkg = '';

	
});	
	
	
function setChange(e){
	change = true;
	pkg = e;
	$('#changeCsv_'+pkg).show();
    $('#ac_change_'+pkg).click(function(){
	alert('hsggs');
});
	
	//$("'#changeCsv_"+pkg+"'").show();
}



function FinalCall(){
	$('div').find('.alert-success').find('h4').html('<i class="icon fa fa-check"></i>Process Completed');
		setTimeout(function(){// wait for 5 secs(2)
           window.location = 'index.php?msg=complete'; // then reload the page.(3)
      }, 5000);
}


	
function SendRequestMqtt(macid,url){
	
	var macurl = url;
	
	var msg = 'update,1';
	
	
	
	
	//var msg = <?php echo "'set,".$_GET['locid']."'" ?>;
	var mac = macid;
	
var result = [];
var client = new Paho.MQTT.Client("letsfado.com", 8083, "myClientId" + new Date().getTime());
	
client.connect({userName : "eegrab",password : "eegrab@123!",onSuccess:onConnect,onFailure:doFail});



	
// set callback handlers
client.onConnectionLost = function (responseObject) {
    console.log("Connection Lost: "+responseObject.errorMessage);
	
}



client.onMessageArrived = function (message) {
  console.log("Message Arrived: "+message.payloadString);
  	
}
 
// Called when the connection is made
function onConnect(){
	 alert(msg);
  client.subscribe("lck/"+mac+"/oppo");

	 var message = new Paho.MQTT.Message(msg);
message.destinationName = "lck/"+mac+"/oppo";
message.qos = 0;
message.retained = true; 

client.send(message); 
	console.log("total:",message.retained);
	
 
}
client.onMessageArrived = function (message) {
	
  //console.log("msh: "+ Object.value[message]);
	 console.log("Message Arrived: " + message.payloadString);
	 console.log("Retained:  " + message.retained);
  if(message.payloadString == 'update,1'){
	  client.subscribe("lck/"+mac+"/stat"); 
  }	
  if(message.payloadString == 'update,0'){
	 FinalCall();
	 }
  console.log("Message Arrived: " + message.payloadString);
  
}	


	


// Connect the client, providing an onConnect callback
	
}
function doFail(){
	alert("fail to connect");
}

</script>



</body>
</html>

