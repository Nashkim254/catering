<?php include_once './includes/header.inc';  ?>
  <body>
<?php  
session_start();
if (!isset($_SESSION['id'])) {
  header("Location : ./index.php");
  exit();
}
if ($_SESSION['user_type'] == 'ADMIN') {
  include_once('./includes/admin_menu.php');
}else if ($_SESSION['user_type'] == 'STORE_MANAGER') {
 include_once('./includes/store_keeper_menu.php');
}else {
   header("Location : ./index.php");
  exit();
}

?>
    <div class="page">
      <!-- navbar-->
<?php include_once './includes/horizontal_bar.inc';  ?>
      <!-- Breadcrumb-->
      <div class="breadcrumb-holder">
        <div class="container-fluid">
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="./index.php">Home</a></li>
            <li class="breadcrumb-item active"> Store Activities      </li>
          </ul>
        </div>
      </div>
      <section>
        <div class="container-fluid">
          <!-- Page Header-->
          <header> 
            <h1 class="h3 display">Store logs</h1>
          </header>
          <div class="row">
            
            
            
  <div class="col-lg-6 col-lg-12"class="logs_display">
              <div class="card">
                <div class="card-header">
                  <h4>Store logs</h4>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-striped table-sm">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Date</th>
                          <th>Time</th>
                          <th>Transaction</th>
                          <th>Details</th>
                        </tr>
                      </thead>
                      <tbody id="logs">
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
              <p>Design by <a href="#" class="external">Nashon</a></p>
              <!-- Please do not remove the backlink to us unless you support further theme's development at https://bootstrapious.com/donate. It is part of the license conditions and it helps me to run Bootstrapious. Thank you for understanding :)-->
            </div>
          </div>
        </div>
      </footer>
    </div>
      <!-- Modal-->
                  <div id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
                    <div role="document" class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 id="title" class="modal-title"></h5>
                          <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
                        </div>
               
                
               <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-striped table-sm">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Item</th>
                          <th>Quantity</th>
                          
                        </tr>
                      </thead>
                      <tbody id="details">
                        
                      </tbody>
                    </table>
                  </div>
                </div>
              
                        </div>
                      </div>
                    </div>
                  
                  <!-- model -->
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
  function getStoreLogs() {
        $.ajax({
          url : './Classes/Main.php',
          type : 'post',
          data :{getStoreLogs : 1},
          success : function (res){
          //  alert(res);
            var data =  JSON.parse(res);
            $('#logs').empty();
            for (var i = 0; i < data.length; i++) {
              $('#logs').append('<tr><td>'+data[i].ID+'</td><td>'+data[i].TRUNSACTION_DATE+'</td><td>'+data[i].TRUNSACTION_TIME+'</td><td>'+data[i].TRUNSACTION+'</td><td><a href="#" data-toggle="modal" data-target="#myModal"  class="view" vid="'+data[i].ID+'">See Details</a></td></tr>');
            }


          },
          error : function (res){
            alert('error');
            console.log(res);
          }
        });
}

  function getTransactionDetails(id){
          $.ajax({
          url : './Classes/Main.php',
          type : 'post',
          data :{getTransactionDetails:1, id:id},
          success : function (res){
            //alert(res);
            var data = JSON.parse(res);
            $('#title').text('Transaction details ID number :'+id);
            $('#details').empty();
            for(var i=0; i < data.length; i++){
            $('#details').append('<tr><td>'+(i+1)+'</td><td>'+data[i].name+'</td><td>'+data[i].quantity+'  '+data[i].units+'</td></tr>');
            }
          },
          error : function (res){
            alert('error');
            console.log(res);
          }
        });
  }
  
$(document).ready(function(){
  getStoreLogs();
  $("body").on("click", ".view", function (event) {
  var id = $(this).attr('vid');
  getTransactionDetails(id);
 

});
});
</script>
  </body>
</html>