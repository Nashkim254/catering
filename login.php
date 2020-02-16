<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Maseno University Catering Department</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome CSS-->
    <link rel="stylesheet" href="vendor/font-awesome/css/font-awesome.min.css">
    <!-- Fontastic Custom icon font-->
    <link rel="stylesheet" href="css/fontastic.css">
    <!-- Google fonts - Roboto -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700">
    <!-- jQuery Circle-->
    <link rel="stylesheet" href="css/grasp_mobile_progress_circle-1.0.0.min.css">
    <!-- Custom Scrollbar-->
    <link rel="stylesheet" href="vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.css">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="css/style.default.css" id="theme-stylesheet">
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="css/custom.css">
    <!-- Favicon-->
    <link rel="shortcut icon" href="img/favicon.ico">
    <!-- Tweaks for older IEs--><!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->


  <?php
session_start();
if (isset($_SESSION['id'])) {
  if ($_SESSION['user_type'] == 'ADMIN') {
    header("Location: ./admin.php");
    exit();
  }else if ($_SESSION['user_type'] == 'STORE_MANAGER') {
    header("Location: ./store_manager.php");
    exit();
  }else if ($_SESSION['user_type'] == 'CASHIER') {
    header("Location: ./cashier.php");
    exit();
  }
}
    ?>

  </head>
  <body>
    <div class="page login-page">
      <div class="container">
        <div class="form-outer text-center d-flex align-items-center">
          <div class="form-inner">
            <div class="logo text-uppercase"><span>Maseno University</span><strong class="text-primary">Cartering Departmant</strong></div>
            <p>Login</p>
            <form>
              <div class="form-group-material">
                <input id="username" type="text" name="loginUsername" required data-msg="Please enter your username" class="input-material">
                <label for="login-username" class="label-material">Username or Email</label>
              </div>
              <div class="form-group-material">
                <input id="password" type="password" name="loginPassword" required data-msg="Please enter your password" class="input-material">
                <label for="login-password" class="label-material">Password</label>
              </div>
              <div class="form-group text-center"><button id="login" class="btn btn-primary">Login</button>
              </div>
            </form><!-- <a href="#" class="forgot-pass">Forgot Password?</a> -->
          </div>
          <div class="copyrights text-center">
            <p>Design by <a href="#" class="external">Nashon</a></p>
            <!-- Please do not remove the backlink to us unless you support further theme's development at https://bootstrapious.com/donate. It is part of the license conditions. Thank you for understanding :)-->
          </div>
        </div>
      </div>
    </div>
    <!-- JavaScript files-->

    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/popper.js/umd/popper.min.js"> </script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="js/grasp_mobile_progress_circle-1.0.0.min.js"></script>
    <script src="vendor/jquery.cookie/jquery.cookie.js"> </script>
    <script src="vendor/chart.js/Chart.min.js"></script>
    <script src="vendor/jquery-validation/jquery.validate.min.js"></script>
    <script src="vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js"></script>
    <!-- Main File-->
    <script src="js/front.js"></script>


  <script type="text/javascript">
  $(document).ready(function(){

     $('#login').click(function(e){
      
      e.preventDefault();
      var username = $('#username').val();
      var password = $('#password').val();
      
        $.ajax({
          url : './Classes/Main.php',
          type : 'post',
          data :{login:1,username:username,password:password},
          async: false,
          success : function (res){
            if (res == 'ADMIN') {window.location.href = "./admin.php";}
              else if (res == 'STORE_MANAGER') {window.location.href = "./store_manager.php";}
                else if (res == 'CASHIER') {window.location.href = "./cashier.php";}
                  else{alert(res);}
          },
          error : function (res){
            alert('error');
            console.log(res);
          }
        });
     });

  });
</script>
  </body>
</html>