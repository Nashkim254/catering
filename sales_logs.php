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
}else if ($_SESSION['user_type'] == 'CASHIER') {
 include_once('./includes/cashier_menu.php');
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
            <li class="breadcrumb-item active"> Sales logs      </li>
          </ul>
        </div>
      </div>
      <section>
        <div class="container-fluid">
          <!-- Page Header-->
          <header> 
            <h1 class="h3 display">Sales logs</h1>
          </header>
          <div class="row">
            
            
            
            <div class="col-lg-12">
              <div class="card">
                <div class="card-header">
                  <h4>Sales logs</h4>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-striped table-sm">
                      <thead id="sales_log">
                  
                        
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>

        </div>
      </section>
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
                        
                          <th>Name</th>
                          <th>Price</th>
                          <th>Quantity</th>
                          <th>Total</th>
                          
                        </tr>
                      </thead>
                      <tbody id="sold_items">
                        
                       
                      </tbody>
                    </table>
                  </div>
                </div>
              
                        </div>
                      </div>
                    </div>
                  
                  <!-- model -->
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

function getSalesLogs(){
    $.ajax({
          url : './Classes/Main.php',
          type : 'post',
          data :{getSalesLogs : 1},
          success : function (res){
            var data =  JSON.parse(res);
            //console.log(data[0]);
            $('#sales_log').empty();
            $('#sales_log').append('<tr><th>#</th><th>Receipt Number</th><th>Type</th><th>Date</th><th>Time</th><th>Cashier</th><th style="text-align: center;">Items Sold</th><th>Total</th></tr>');
            for(var i=0; i < data.length; i++){

              $('#sales_log').append('<tr><td>'+(i+1)+'</td><td>'+data[i].receipt_no+'</td><td>'+data[i].sales_type+'</td><td>'+data[i].s_date+'</td><td>'+data[i].s_time+'</td><td>'+data[i].fname+'   '+data[i].lname+'</td><td><a href="#" data-toggle="modal" data-target="#myModal"  vid="'+data[i].receipt_no+'" class="view">items sold</a></td><td>'+data[i].net_total+'</td></tr>');
              //var items_sold =getSoldItems(data[i].receipt_no);
              //var id = data[i].receipt_no;
            //  $('#'+id).text('hhh');
              
            }

          },
          error : function (res){
            alert('error');
            console.log(res);
          }
        });
}

function getSoldItems(id){
    $.ajax({
          url : './Classes/Main.php',
          type : 'post',
          data :{getSoldItems : 1, receipt_id:id},
          success : function (res){
            //alert(res);

            var data =  JSON.parse(res);
            console.log(data[0]);
            $('#title').text('Items sold for receipt number :'+id);
            $('#sold_items').empty();
            for(var i=0; i < data.length; i++){
              $('#sold_items').append('<tr><td>'+data[i].name+'</td><td>'+data[i].price+'</td><td>'+data[i].quantity+'</td><td>'+data[i].sub_total+'</td></tr>');
            }
            goToByScroll('sold_items');
          },
          error : function (res){
            alert('error');
            console.log(res);
          }
        });

}
function goToByScroll(id) {
    // Remove "link" from the ID
    id = id.replace("link", "");
    // Scroll
    $('html,body').animate({
        scrollTop: $("#" + id).offset().top
    }, 'slow');
}

$(document).ready(function () {
  getSalesLogs();

$("body").on("click", ".view", function (event) {
  var id = $(this).attr('vid');
  //alert(link_name);
  getSoldItems(id)
});

});

</script>
  </body>
</html>