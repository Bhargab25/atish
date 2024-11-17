<!-- bootstrap datepicker -->
  <link rel="stylesheet" href="../../bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
<!-- jQuery 3 -->
<script src="../../bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="../../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
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

$(function () {

	
	
});	
	
	
  $(document).ajaxStart(function () {
    Pace.restart()
  })
	setInterval(function(){
        
	
	var mac = 'b8:27:eb:b2:2e:4f';
	var msg = 'get,0';
	var purpose = 'test';	
	callMQTT(msg,mac,purpose);
  // callMQTT(msg,mac,purpose);
}, 5000);

  
function formatMAC(e) {
    var r = /([a-f0-9]{2})([a-f0-9]{2})/i,
        str = e.target.value.replace(/[^a-f0-9]/ig, "");

    while (r.test(str)) {
        str = str.replace(r, '$1' + ':' + '$2');
    }

    e.target.value = str.slice(0, 17);
};
// Call MQTT FUNCTION--------------	
function callMQTT(msg,mac,purpose){
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
	// alert(msg);
  client.subscribe("lck/b8:27:eb:b2:2e:4f/stat");

	 var message = new Paho.MQTT.Message(msg);
message.destinationName = "lck/b8:27:eb:b2:2e:4f/oppo";
message.qos = 0;
 
client.send(message); 
 
}
client.onMessageArrived = function (message) {
  //console.log("msh: "+ Object.value[message]);
  
  console.log("Message Arrived: " + message.payloadString);
  console.log("eegrab/#:     " + message.destinationName);
  console.log("QoS:       " + message.qos);
  console.log("Retained:  " + message.retained);
  // Read Only, set if message might be a duplicate sent from broker
  console.log("Duplicate: " + message.duplicate);
  var response  = message.payloadString;
	  //alert(response);
  if(response.length >= 18){
	var lockinfo = response.substring(6, 10);
	for(var i=0; i<16 ; i++){
		var lockerNumber = i;
		showLockerStatus(lockinfo,lockerNumber);
	} 
	  
	if(purpose == 'release'){
	var lckId = $('#locNum').html();	

	}  
  }	
  
	
}	
}	
function doFail(){
	var status = "fail to connect";
	console.log("failure:" + status);
	location.reload();
}
//-----END MQTT-------		
	
function Check(n, k) //K = Lock Number and N=hexa to binary() conver lock status in reverse mode.
{ 
	//console.log('n:',n);
	//console.log('k:',k);
	//alert(n);
	var val = [n.slice(0, 2),n.slice(2)];
	var val = val[1]+val[0];
	//console.log('val:',val);
	n = parseInt(val, 16);
	//console.log('dec:',n);
	//console.log('checkVal:',(n & (1 << (16 - 1))))
    if (n & (1 << (k - 1))) {
       $.ajax({
	url: 'release.php',type: 'POST',data: {bookingId:$('#bookid').val(),lockUid:$('#locNum').html()}, success: function (result) {		
		var obj = jQuery.parseJSON(result);
		if(obj.status == 'success'){
		$('#stat').html('<div class="alert alert-success alert-dismissible" id="release_status">'+obj.message+'</div>');
		}else{
		$('#stat').html('<div class="alert alert-danger alert-dismissible" id="release_status">'+obj.message+'</div>');	
		}
	   
      }	
	});
	
	}
    else{
       console.log("Open"); 
	//alert('Open');
	
	$('#stat').html('<div class="alert alert-danger alert-dismissible" id="release_status"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4>Your Lock is open<h4>Please close manually before release</div>');
	}
} 
//===========================================
	
	
$('#openlock').click(function(){
	var cid = $('#lockers_details input[name=cid]').val();
	var macid = $('#lockers_details input[name=macid]').val();
	var lckId = $('#locNum').html();
	var msg;
	var locNum;
	if (lckId.indexOf('_') == -1) {
  	var loc = Math.round(lckId.substr(lckId.length - 2))-1; // => "1";
		msg = 'set,'+loc;
		locNum = loc;
		
	}else{
	
	var myString = lckId.substr(lckId.indexOf("_") + 1)-1;	
		msg = 'set,'+myString;
		locNum = myString;
	}
	
	alert(msg);
	
	//var msg = <?php echo "'set,".$_GET['locid']."'" ?>;
	var mac = macid;
	alert("lck/"+mac+"/stat");
	
var result = [];

var purpose = 'open';	

callMQTT(msg,mac,purpose);
	


// Connect the client, providing an onConnect callback
	
});	

$('#ReleaseLock').click(function(){
	var cid = $('#lockers_details input[name=cid]').val();
	var macid = $('#lockers_details input[name=macid]').val();
	var lckId = $('#locNum').html();
	alert(lckId);
	var msg;
	var locNum;
	if (lckId.indexOf('_') == -1) {
  	var loc = Math.round(lckId.substr(lckId.length - 2)); // => "1";
		msg = 'get,0';
		locNum = loc;
	}else{
	
	var myString = lckId.substr(lckId.indexOf("_") + 1);	
		msg = 'get,0'//+myString;
		locNum = myString;
	}
	var mac = macid;
	var purpose = "release";
	lockerNumber = locNum;
	callMQTT(msg,mac,"release");
  	
	
	
	
})	
	
function showLockerStatus(n,k){
	var val = [n.slice(0, 2),n.slice(2)];
	 val = val[1]+val[0];
	  n = parseInt(val, 16);
	 console.log('decimal:'+ n);
	 if (n & (1 << (k))){
		// $("#B827EBB22E4F_" + (k+1)).val('close');
		$("#B827EBB22E4F_" + (k+1)).addClass("green");
		// alert('green');
		  
		 console.log('lock:'+ k);
		 console.log('status:'+ (n & (1 << (k))));
	 }else{
		//$("#B827EBB22E4F_" + (k+1)).val('open');
		 $("#B827EBB22E4F_" + (k+1)).addClass("red");
		
		console.log('lock:'+ k);
		 console.log('status:'+ (n & (1 << (k))));
	 }
}
</script>


</body>
</html>

