
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
            <li class="breadcrumb-item active">Special Order Menu       </li>
          </ul>
        </div>
      </div>
      <section>
        <div class="container-fluid">
          <!-- Page Header-->
          <header> 
            <h1 class="h3 display">Special Orders for <?php echo ($_GET['group']); ?></h1>
          </header>
          <div class="row">


            <div class="col-lg-4" id="bf" style="display: none;">
              <div class="card">
                <div class="card-header">
                  <h4>Breakfast</h4>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-striped table-sm">
                      <thead>
                        <tr>
                          
                          <th>Name</th>
                          <th>Quantity per person</th>
                          
                        </tr>
                      </thead>
                      <tbody id="bft">
                        
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>

                 <div class="col-lg-4" id="ln" style="display: none;">
              <div class="card">
                <div class="card-header">
                  <h4>Lunch</h4>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-striped table-sm">
                      <thead>
                        <tr>
                         
                          <th>Name</th>
                          <th>Quantity per person</th>
                          
                        </tr>
                      </thead>
                      <tbody id="lnt">
                        
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>


                 <div class="col-lg-4" id="sp" style="display: none;">
              <div class="card">
                <div class="card-header">
                  <h4>Supper</h4>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-striped table-sm">
                      <thead>
                        <tr>
                        
                          <th>Name</th>
                          <th>Quantity per person</th>
                          
                        </tr>
                      </thead>
                      <tbody id="spt">
                        
                      </tbody>
                    </table>
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
              <p>Maseno University Cartering &copy; 2019-2020</p>
            </div>
            <div class="col-sm-6 text-right">
              <p>Design by <a href="https://bootstrapious.com/p/bootstrap-4-dashboard" class="external">Nashon</a></p>
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
    <!-- Main File-->
    <script src="js/front.js"></script>

<script type="text/javascript">


function getMealMenu(id,name){
    $.ajax({
          url : './Classes/Main.php',
          type : 'post',
          data :{getMealMenu : 1, id:id},
          success : function (res){
            var data = JSON.parse(res);
          if (name == 'BREAKFAST') {
            $('#bf').show();
            $('#bft').empty();
            for(var i=0; i < data.length; i++){
              $('#bft').append('<tr><td>'+data[i].name+'</td><td>'+data[i].per+'</td></tr>');
            }
          }else if (name == 'LUNCH') {
            $('#ln').show();
            $('#lnt').empty();
            for(var i=0; i < data.length; i++){
              $('#lnt').append('<tr><td>'+data[i].name+'</td><td>'+data[i].per+'</td></tr>');
            }
          }else if (name == 'SUPPER') {
            $('#sp').show();
            $('#spt').empty();
            for(var i=0; i < data.length; i++){
              $('#spt').append('<tr><td>'+data[i].name+'</td><td>'+data[i].per+'</td></tr>');
            }
          }
          },
          error : function (res){
            alert('error');
            console.log(res);
          }
        });
}
    function getMeals(id){
    $.ajax({
          url : './Classes/Main.php',
          type : 'post',
          data :{getMeals : 1,id:id},
          success : function (res){
          //alert(res);
          var data = JSON.parse(res);
          for(var i=0; i <data.length; i++){
            getMealMenu(data[i].id, data[i].name);
          }
          },
          error : function (res){
            alert('error');
            console.log(res);
          }
        });
}
$(document).ready(function (){
  var id = <?php echo ($_GET['id']); ?>;
  getMeals(id);
});
</script>


  </body>
</html>