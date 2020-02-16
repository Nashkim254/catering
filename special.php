
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
            <li class="breadcrumb-item active">Special Orders       </li>
          </ul>
        </div>
      </div>
      <section>
        <div class="container-fluid">
          <!-- Page Header-->
          <header> 
            <h1 class="h3 display">Special Orders</h1>
          </header>
          <div class="row">
            
            
            
            <div class="col-lg-12">
              <div class="card">
                <div class="card-header">
                  <h4>Special Orders</h4>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-striped table-sm">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Group Name</th>
                          <th>Date of meal</th>
                          <th>Contact Person</th>
                          <th>Email</th>
                          <th>Phone</th>
                          <th>Meals</th>
                          <th>Total Amount</th>
                          <th>Clear</th>
                          <th>Date Cleared</th>
                          <th>People</th>
                          <th>Order Date</th>
                          <th>M-Pesa ID</th>
                          <th>Receipt number</th>
                        </tr>
                      </thead>
                      <tbody id="orders">
                        
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
  function getOrders(){
    $.ajax({
          url : 'http://localhost/Projects/Catering/Classes/Main.php',
          type : 'post',
          data :{getOrders : 1},
          success : function (res){
          //  alert(res);
            var data =  JSON.parse(res);
          //  console.log(data);
          //  alert(data);
            $('#orders').empty();
           // $('#orders').append('<tr><th>ID</th><th>Group Name</th><th>Date of meal</th><th>Contact Person</th><th>Email</th><th>Phone</th><th>Meals</th><th>Total Amount</th><th>Clear</th><th>Date Cleared</th></th></tr>');
            for (var i = 0; i < data.length; i++) {
              console.log(data[i]);
              if (data[i].CLEARED == 0) {
              $('#orders').append('<tr><td>'+data[i].ID+'</td><td>'+data[i].GROUP_NAME+'</td><td>'+data[i].DATE_OF_MEAL+'</td><td>'+data[i].CONTACT_FNAME+'   '+data[i].CONTACT_LNAME+'</td><td><a href="'+data[i].CONTACT_EMAIL+'">'+data[i].CONTACT_EMAIL+'</a></td><td>'+data[i].CONTACT_PHONE+'</td><td><a href="special_order_menu.php?group='+data[i].GROUP_NAME+'&id='+data[i].ID+'">See meals</a></td><td>'+data[i].TOTAL_AMOUNT+'</td><td><a href="./Classes/Main.php?clear_order=set&id='+data[i].ID+'">Clear</a></td><td>N/A</td></td><td>'+data[i].NUMBER_OF_PEOPLE+'</td><td>'+data[i].DATE_OF_ORDER+'</td><td>'+data[i].TID+'</td><td>'+data[i].CONFIRMATION_ID+'</td></tr>');  
            }else{

              $('#orders').append('<tr><td>'+data[i].ID+'</td><td>'+data[i].GROUP_NAME+'</td><td>'+data[i].DATE_OF_MEAL+'</td><td>'+data[i].CONTACT_FNAME+'   '+data[i].CONTACT_LNAME+'</td><td><a href="'+data[i].CONTACT_EMAIL+'">'+data[i].CONTACT_EMAIL+'</a></td><td>'+data[i].CONTACT_PHONE+'</td><td><a href="special_order_menu.php?group='+data[i].GROUP_NAME+'&id='+data[i].ID+'">See meals</a></td><td>'+data[i].TOTAL_AMOUNT+'</td>><td>Cleared</td><td>'+data[i].DATE_CLEARED+'</td></td><td>'+data[i].NUMBER_OF_PEOPLE+'</td><td>'+data[i].DATE_OF_ORDER+'</td><td>'+data[i].TID+'</td><td>'+data[i].CONFIRMATION_ID+'</td></tr>');
              }
            }


          },
          error : function (res){
            alert('error');
            console.log(res);
          }
        });
}
$(document).ready(function (){
  getOrders();
});
</script>
  </body>
</html>