<!-- jQuery 3 -->
<script src="../../bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="../../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- DataTables -->
<script src="../../bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="../../bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="../../bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="../../bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
<!-- Sparkline -->
<script src="../../bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<!-- jvectormap  -->
<script src="../../plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="../../plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- SlimScroll -->
<script src="../../bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- ChartJS -->
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../dist/js/demo.js"></script>

<script>

$( document ).ready(function() {
    $('#renewDiv').hide();  
	var pathurl = window.location.pathname.split('/');
	//var folder = path.basename(window.location.pathname);
   //alert(pathurl[3]);
	var module = pathurl[3];		
	$('span:contains("'+module+'")').closest('.treeview').addClass('active menu-open');
	
	$('#example1').DataTable({
      'paging'      : true,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : true
    });
  
    
	
});	

$('form[name="employee"]').submit(function(e){
    
    e.preventDefault(); //form will not submitted  
    $.ajax({
         url: 'uploadEmp.php',type: 'POST',data:new FormData(this),  
                     contentType:false,          // The content type used when sending data to the server.  
                     cache:false,                // To unable request pages to be cached  
                     processData:false,
                      beforeSend: function() {
              $("#loader").show();
                    }, 
                     success: function (result) {
                         alert(result);
                       if(result == 'Error1'){
                           $('#ajaxreport').show();
                           $('.callout-danger h4').html('Invalid File Format');
                           $('.callout-danger p').html('only CSV files are allowed');
                       }
                        else if(result == 'Error2'){
                            $('#ajaxreport').show();
                           $('.callout-danger h4').html('No input Found');
                           $('.callout-danger p').html('select a csv file before uploading');
                       }  
                        else if(result == '0'){
                             $('#ajaxreport').removeClass('callout_danger');
                            $('#ajaxreport').removeClass('callout_success');
                             $('#ajaxreport').show();
                             $('.callout-danger h4').html('Uploaded');
                        }else{
                          $('#ajaxreport').show();
                          $('.callout-danger h4').html('Invalid Entry');
                          $('.callout-danger p').html(result+' is already exist');  
                        }  
                          
                    },
        comlete: function(){
            document.location='view.php';
        }
     });
})    
 
    
//Send notification
    function sendNotification(bookingID){
        <?php 
        if(usermodel::CheckInternet()==false){
        ?>
      alert('Check your internet connection and try again');   
            
        <?php
        }else{
            ?>
                  $.ajax({
            url:'notify.php',
            type:'POST',
            data:{'bid':bookingID},
            beforeSend: function() {
              $("#loading-image").show();
           },    
             success: function (result) {
                 alert(result);
             }
        });
             
        <?php
        }
            ?>
        
    }
//-----------------    
    
//Force Release id due date is over
    function ForceRelease(bookingID){
        //alert('test');
        $.ajax({
            url:'../booking/release.php',
            type:'POST',
            data:{'bid':bookingID},
             success: function (result) {
                if(result == 0){
                           alert(result);
                         
                           $('.callout-success').show();
                          $('.callout-success h4').html('Successfully release');
                          $('.callout-success p').html('page will be automatically reload to reflect the changes');
                          setTimeout(function(){
                             location.reload(); 
                          },3000);
                          
                        }  
                       if(result == 1){
                           $('.callout-danger').show();
                           $('.callout-danger h4').html('Sorry your relaese is able to process');
                           $('.callout-danger p').html('Please try later ');
                       }
             }
        });
    }
//-----------------     
function Renew(bookingID){
    //alert(bookingID);
    // Encrypt

    
    $("form[name='renew_form'] input[type='hidden']").val(bookingID);
    $('#renewDiv').slideDown();
}    
    
//Update your renew form
 $('form[name="renew_form"]').submit(function(e){
        $('#renewDiv').hide();
    e.preventDefault(); //form will not submitted  
    $.ajax({
         url: '../booking/renew.php',type: 'POST',data:new FormData(this),  
                     contentType:false,          // The content type used when sending data to the server.  
                     cache:false,                // To unable request pages to be cached  
                     processData:false,       
                     success: function (result) {
                         //alert(result);
                      if(result == 0){
                           alert(result);
                         
                           $('.callout-success').show();
                          $('.callout-success h4').html('Successfully updated');
                          $('.callout-success p').html('page will be automatically reload to reflect the changes');
                          setTimeout(function(){
                             location.reload(); 
                          },3000);
                          
                        }  
                       if(result == 'Error1'){
                           $('.callout-danger').show();
                           $('.callout-danger h4').html('Sorry your booking is not updated');
                           $('.callout-danger p').html('Please try later or release your booking');
                       }
                          
                    }
     });
});      
</script>

</body>
</html>

