
<?php include_once './includes/header.inc';  ?>
  <body>
<?php  
session_start();
if (!isset($_SESSION['id'])) {
  header("Location : ./index.php");
  exit();
}
if ($_SESSION['user_type'] != 'ADMIN') {
  header("Location : ./index.php");
  exit();
  
}
include_once('./includes/admin_menu.php');

?>
    <div class="page">
      <!-- navbar-->
<?php include_once './includes/horizontal_bar.inc';  ?>
      <!-- Breadcrumb-->
      <div class="breadcrumb-holder">
        <div class="container-fluid">
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="./admin.php">Home</a></li>
            <li class="breadcrumb-item active">Reports       </li>
          </ul>
        </div>
      </div>
      <section class="charts">
        <div class="container-fluid">
          <!-- Page Header-->
          <header> 
            <h1 class="h3 display">Statistical Reports            </h1>
          </header>
          <div class="row">
            <div class="col-lg-6">
              <div class="card line-chart-example">
                <div class="card-header d-flex align-items-center">
                  <h4>Sales and purchases reports</h4>
                </div>
                <div class="card-body">
                  <canvas id="lineChartExample"></canvas>
                </div>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="card bar-chart-example">
                <div class="card-header d-flex align-items-center">
                  <h4>Bar Chart Representation of the reports</h4>
                </div>
                <div class="card-body">
                  <canvas id="barChartExample"></canvas>
                </div>
              </div>
            </div>
            <div class="col-lg-12">
              <div class="card pie-chart-example">
                <div class="card-header d-flex align-items-center">
                  <h4>Top three most selling items</h4>
                </div>
                <div class="card-body">
                  <div class="chart-container">
                    <canvas id="pieChartExample"></canvas>
                  </div>
                </div>
              </div>
            </div>
           
            
          </div>
        </div>
      </section>
      <footer class="main-footer">
        <div class="container-fluid">
          <div class="row">
            <div class="col-sm-6">
              <p>Maseno University Catering &copy; 2019-2020</p>
            </div>
            <div class="col-sm-6 text-right">
              <p>Design by <a href="#" class="external">Nashon</a></p>
              <!-- Please do not remove the backlink to us unless you support further theme's development at https://bootstrapious.com/donate. It is part of the license conditions and it helps me to run Bootstrapious. Thank you for understanding :)-->
            </div>
          </div>
        </div>
      </footer>
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
    <script src="js/charts-custom.js"></script>
    <!-- Main File-->
    <script src="js/front.js"></script>
  </body>
</html>