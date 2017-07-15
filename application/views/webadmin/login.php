<?php echo $html_head;?>
<style>
    .content-wrapper, .right-side, .main-footer{margin-left:0px !important;text-align: center;background:none !important;}
    </style>
<body class="hold-transition login-page">
<div class="login-box">
    <div class="login-logo" style="background-color: white;">
      <a href="<?php echo ADMIN_BASE_URL;?>"><img src="<?php echo SiteImagesURL;?>logo.png" /><?php //echo SITE_NAME;?></a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Sign in to start your session</p>

    <form action="javascript:void(0);" method="post" name="mtmv_admin_login_form" id="mtmv_admin_login_form">
      <div class="form-group has-feedback">
          <input type="email" name="userName" id="userName" class="form-control" placeholder="Email">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
          <input type="password" name="password" id="password" class="form-control" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <!--<input type="checkbox"> Remember Me -->
              <a href="#">I forgot my password</a>
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
            <button type="submit" name="loginInSubmit" id="loginInSubmit" class="btn btn-primary btn-block btn-flat">Sign In</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

    <!--<div class="social-auth-links text-center">
      <p>- OR -</p>
      <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in using
        Facebook</a>
      <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign in using
        Google+</a>
    </div>
    <!-- /.social-auth-links -

    <a href="#">I forgot my password</a><br>
    <!--<a href="register.html" class="text-center">Register a new membership</a>-->

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->
<?php echo $footer;?>
<script src="<?php echo SiteJSURL; ?>webadmin/login-forgot-password.js"></script>
<script>
    $(function () {
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' // optional
        });
        $.AdminLTE.Admin_Base_Url='<?php  echo ADMIN_BASE_URL;?>';
    });
    
    myJsMain.login();
    myJsMain.forgot_password();
</script>