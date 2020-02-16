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
            <li class="breadcrumb-item active"> Sales Stock      </li>
          </ul>
        </div>
      </div>
      <section>
        <div class="container-fluid">
          <!-- Page Header-->
          <header> 
            <h1 class="h3 display">Items In stock</h1>
          </header>
          <div class="row">
            
            
            
            <div class="col-lg-12">
              <div class="card">
                <div class="card-header">
                  <h4>Items In stock</h4>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-striped table-sm">
                      <thead>
                        <tr>
                         
                          <th>Name</th>
                          <th>Quantity in stock</th>
                          <th>Unit price</th>
                          <th>Date added</th>
                          <th>Date last edited</th>
                        </tr>
                      </thead>
                      <tbody id="items">
                       
                          
                 
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
    

    function getSalesItems(){
    $.ajax({
          url : './Classes/Main.php',
          type : 'post',
          data :{getSalesItems : 1},
          success : function (res){
            var data =  JSON.parse(res);
            console.log(data);
          //  alert(data);
            $('#items').empty();
           // $('#items').append('<tr><th>Name</th> <th>Quantity Available</th> <th>Unit Price</th> <th>Date Added</th> <th>Date last edited</th></tr>');
            for (var i = 0; i < data.length; i++) {
              //$('#item_name').append('<option value="'+data[i].ITEM_NAME+','+data[i].ID+','+data[i].PRICE+'">'+data[i].ITEM_NAME+'</option>');
              $('#items').append('<tr><td>'+data[i].ITEM_NAME+'</td> <td>'+data[i].ITEM_QUANTITY+'</td> <td>'+data[i].PRICE+'&nbsp;&nbsp;</td> <td>'+data[i].DATE_ADDED+'</td> <td>'+data[i].DATE_LAST_MODIFIED+'</td></tr>');
            }


          },
          error : function (res){
            alert('error');
            console.log(res);
          }
        });
}

$(document).ready(function(){
getSalesItems();
});
  </script>
  </body>
</html>