<?php echo $this->header; ?>
<body class="hold-transition login-page">
	
<div class="login-box">
  <div class="login-logo">
	  
    <a href="javascript:void();"><img src="../../dist/img/login_logo.png" width="200vh" alt="FADO" title="FADO"></a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
      
    <p class="login-box-msg">FADO ULTIMATE LOCKER SOLUTION</p>

    <form action="iforget.php" method="post" name="login-form">
	  
       
		  <?php if($this->error_u != ''){ ?>
		<div class="form-group has-warning">
		  <label class="control-label" for="inputWarning"><i class="fa fa-bell-o"></i><?php echo $this->error_u; ?> </label>
		  <?php }else { ?>
			<div class="form-group has-feedback">
			<?php } ?>
        <label class="control-label">Enter your email id </label>        
        <input type="email" class="form-control" placeholder="Email" name="login">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
       <?php if($this->error_p != ''){ ?>
		<div class="form-group has-warning">
		  <label class="control-label" for="inputWarning"><i class="fa fa-bell-o"></i><?php echo $this->error_p; ?> </label>
		  <?php }else { ?>
			<div class="form-group has-feedback">
			<?php } ?>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
         
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat" name="log_submit">Send</button>
        </div>
        <!-- /.col -->
      </div>
    </form>


    
    

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->
<?php echo $this->footer; ?>   
