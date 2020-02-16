<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Maseno University Catering department</title>
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
   <link rel="stylesheet" href="css/index.css">
    <!-- Favicon-->
    <link rel="shortcut icon" href="img/favicon.ico">
</head>
<body>

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

    <div class="indextop">
      <center><h1 class="welcome_note" style="color: #6ee;padding-top: 160px; font-size: 60px;">Welcome to Maseno University Catering Department karibu sana!</h1></center>
      
    </div>

    <div class="row" style="padding: 20px;">
      <div class="col-lg-6">
        <h1>Special Order</h1>
        <div>
          <p style="color: #e8d5d9; font-size: 20px;">
            Special orders are for groups of people who would want to have a special meal or meals prepared for them.
          </p>
          <a href="./special_order.php" style="color: #6ee; font-size: 40px;">Make Special Order Here..</a><br>
        </div>
        
      </div>
     <div class="col-lg-6">
      <a href="./login.php" style="color: #6ee; font-size: 40px;">Login Here!</a>

      <p style="color: #6ee; font-size: 25px;"><i>Only officials can login to this system.</i></p>
        
      </div>
      
    </div>

    <footer>
      <center>&copy; Copyrights <span>Maseno University Catering Department <?php echo date('Y'); ?></span></center><br>
      <center> <p style="color: white;">Designed by <span style="color: #141401; font-size: 25px;"> Nashon</span></p></center>
    </footer>



</body>
</html>