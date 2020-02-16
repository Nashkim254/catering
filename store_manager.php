
<?php include_once './includes/header.inc';  ?>
  <body>
<?php  
session_start();
if (!isset($_SESSION['id'])) {
  header("Location : ./index.php");
  exit();
}
if ($_SESSION['user_type'] != 'STORE_MANAGER') {
  header("Location : ./index.php");
  exit();
  
}
include_once('./includes/store_keeper_menu.php');

?>
    <div class="page">
      <!-- navbar-->
<?php include_once './includes/horizontal_bar.inc';  ?>
      <!-- Counts Section -->
      <section class="dashboard-counts section-padding">
        <center> <h1>Welcome Store Manager</h1></center>
      </section>
      <!-- Header Section-->
      <section class="dashboard-header section-padding">
        <div class="container-fluid">
          <div class="row d-flex align-items-md-stretch">
            <!-- To Do List-->
           <?php include_once('./includes/ethics.inc');  ?>
            <!-- Pie Chart-->
           <!--  <div class="col-lg-3 col-md-6">
              <div class="card project-progress">
                <h2 class="display h4">Top 3 most selling items</h2>
                <p>Ranks of most selling items for the past 7 days.</p>
                <div class="pie-chart">
                  <canvas id="pieChart" width="300" height="300"> </canvas>
                </div>
              </div>
            </div> -->
            <!-- Line Chart -->
           <!--  <div class="col-lg-6 col-md-12 flex-lg-last flex-md-first align-self-baseline">
              <div class="card sales-report">
                <h2 class="display h4">Sales & Store report</h2>
                <p>Store and sales statistics for this year.</p>
                <div class="line-chart">
                  <canvas id="lineCahrt"></canvas>
                </div>
              </div>
            </div> -->
          </div>
        </div>
      </section>
      <!-- Statistics Section-->
     
      <!-- Updates Section -->
      <section class="mt-30px mb-30px">
        <div class="container-fluid">
          <div class="row">
            <div class="">
              <!-- Recent Updates Widget          -->
           


      <footer class="main-footer" style=" width: 100%;">
        <div class="container-fluid">
          <div class="row">
            <div class="col-sm-6">
              <p>Maseno University catering department &copy; 2019-2020</p>
            </div>
            <div class="col-sm-6 text-right">
              <p>Design by <a href="#" class="external">Nashon</a></p>
              <!-- Please do not remove the backlink to us unless you support further theme's development at https://bootstrapious.com/donate. It is part of the license conditions and it helps me to run Bootstrapious. Thank you for understanding :)-->
            </div>
          </div>
        </div>
      </footer>
    </div>
  </div>
</div>
</section>
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
    <script src="js/charts-home.js"></script>
    <!-- Main File-->
    <script src="js/front.js"></script>
  </body>
</html>