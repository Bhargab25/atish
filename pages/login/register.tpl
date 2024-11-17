<?php echo $this->header; ?>
<body class="hold-transition register-page">
<div class="register-box">
  <div class="register-logo">
     <a href="javascript:void();"><b>FADO</b><br/>ULTIMATE LOCKER SYSTEM</a>
  </div>

  <div class="register-box-body">
    <p class="login-box-msg">Register your company</p>

    <form action="register.php" name= "companyReg" method="post">
      <div class="form-group has-feedback">
        <input type="text" class="form-control" name="cname" placeholder="Company name">
        <span class="glyphicon glyphicon-briefcase form-control-feedback"></span>
      </div>
		 <div class="form-group has-feedback">
        <input type="text" class="form-control" name="domain" placeholder="Domain">
        <span class="glyphicon glyphicon-globe form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="email" class="form-control" name="email" placeholder="Email">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="phone" class="form-control" name="phone" placeholder="Phone">
        <span class="glyphicon glyphicon-phone form-control-feedback"></span>
      </div>
		 <div class="form-group has-feedback">
        <input type="text" class="form-control" name="address" placeholder="Address">
        <span class="glyphicon glyphicon-road form-control-feedback"></span>
      </div>
		 <div class="form-group has-feedback">
        <input type="text" class="form-control" name="lat" placeholder="Lat">
        <span class="glyphicon glyphicon-screenshot form-control-feedback"></span>
      </div>
		 <div class="form-group has-feedback ">
        <input type="text" class="form-control" name="long" placeholder="Long">
        <span class="glyphicon glyphicon-screenshot form-control-feedback "></span>
      </div>
      <div class="form-group has-feedback">
        <input type="number" class="form-control" name="strength" placeholder="Company Strength">
        <span class="glyphicon glyphicon-certificate form-control-feedback"></span>
      </div>
		<div class="form-group has-feedback">
        <input type="text" class="form-control" name="lockers" placeholder="Needed Locker">
        <span class="glyphicon glyphicon-th-large form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox"> I agree to the <a href="#">terms</a>
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" name="c" class="btn btn-primary btn-block btn-flat">Register</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

   

    <a href="index.php" class="text-center">I already have a membership</a>
  </div>
  <!-- /.form-box -->
</div>
<!-- /.register-box -->

<?php echo $this->footer; ?>  
