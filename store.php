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
            <li class="breadcrumb-item active"> Items in store      </li>
          </ul>
        </div>
      </div>
      <section>
        <div class="container-fluid">
          <!-- Page Header-->
          <header> 
            <h1 class="h3 display">Items in store</h1>
          </header>
          <div class="row">
            
            
            
            <div class="col-lg-12">
              <div class="card">
                <div class="card-header">
                  <h4>Items in store</h4>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-striped table-sm">
                      <thead>
                        <tr>
                        
                          <th>Name</th>
                           <th>Units</th>
                          <th>Quantity in store</th>
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
         <!-- Modal-->
                  <div id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
                    <div role="document" class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 id="update_quantity_title" class="modal-title">Update quantity of </h5>
                          <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
                        </div>
                        <div class="modal-body">
                          <p class="text-warning">The amount you input will be added to the currently available amount in store.</p>
                          <form>
                            <div class="form-group">
                              <label>Name</label>
                              <input type="text"  class="form-control" id="update_quantity_name" disabled>
                            </div>
                            <div class="form-group">       
                              <label>Quantity added</label>
                              <input type="number" placeholder="Quantity" class="form-control" min="1" id="update_quantity_quantity">
                            </div>
                            <input type="number" id="update_quantity_id" class="form-control" min="1" style="display: none;">
                           
                          </form>
                        </div>
                        <div class="modal-footer">
                          <button type="button" data-dismiss="modal" class="btn btn-secondary" id="close_qu">Close</button>
                          <button type="button" class="btn btn-primary" id="btn_update_q">Save changes</button>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- model -->
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
function getStoreItems(){
    $.ajax({
          url : './Classes/Main.php',
          type : 'post',
          data :{get_store_items : 1},
          success : function (res){
            var data =  JSON.parse(res);
            console.log(data);
            //alert(data);
            $('#items').empty();
            for (var i = 0; i < data.length; i++) {
              $('#items').append('<tr><td>'+data[i].ITEM_NAME+'</td><td>'+data[i].UNIT+'</td><td>'+data[i].ITEM_QUANTITY+'&nbsp;&nbsp;<a href="#" data-toggle="modal" data-target="#myModal" class="upq" update_id="'+data[i].ITEM_NAME+','+data[i].ID+'">Update</a></td><td>'+data[i].UNIT_PRICE+'&nbsp;&nbsp;</td><td>'+data[i].DATE_ADDED+'</td><td>'+data[i].DATE_LAST_MODIFIED+'</td></tr>');
            }


          },
          error : function (res){
            alert('error');
            console.log(res);
          }
        });
}
function updateQuantity(id, quantity){
  $.ajax({
          url : './Classes/Main.php',
          type : 'post',
          data :{update_store_quantity:1,id:id,quantity:quantity},
          success : function (res){
            alert(res);
          },
          error : function (res){
            alert('error');
            console.log(res);
          }
        });
}

$(document).ready(function(){
getStoreItems();

$("body").on("click", ".upq", function (event) {
 
  var v = $(this).attr('update_id');
  var details = v.split(',');
  $('#update_quantity_title').text('Update quantity of '+details[0]);
  $('#update_quantity_id').val(details[1]);
  $('#update_quantity_name').val(details[0]);


});

$('#btn_update_q').click(function(e){
  e.preventDefault();
  //alert('');
  var id = $('#update_quantity_id').val();
  var quantity = $('#update_quantity_quantity').val();
  if (quantity <=0 || isNaN(quantity) ){
    alert('Valid quantity please!'); 
    return;

}
updateQuantity(id,quantity);
$('#update_quantity_quantity').val(0);
$("#close_qu").trigger("click");
getStoreItems();


});

});
</script>
  </body>
</html>