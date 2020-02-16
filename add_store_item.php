
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
      <!-- Breadcrumb-->
      <div class="breadcrumb-holder">
        <div class="container-fluid">
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="./store_manager.php">Home</a></li>
            <li class="breadcrumb-item active"> Add  store item      </li>
          </ul>
        </div>
      </div>
      <section>
        <div class="container-fluid">
          <!-- Page Header-->
          <header> 
            <h1 class="h3 display">Create new store item</h1>
          </header>
         
         <div class="col-lg-12">
              <div class="card">
                <div class="card-header d-flex align-items-center">
                  <h4>Add store item</h4>
                </div>
                <div class="card-body">
                  <form class="form-horizontal" method="post" action="./Classes/Main.php">
                    <div class="form-group row">
                      <label class="col-sm-2 form-control-label">Name</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" name="name">
                      </div>
                    </div>
                    <div class="line"></div>
                    <div class="form-group row">
                      <label class="col-sm-2 form-control-label">Units of measurement</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" placeholder="e.g Kgs, Litres etc" name="unit"> 

                      </div>

                    </div>
                    <div class="line"></div>
                    <div class="form-group row">
                      <label class="col-sm-2 form-control-label">Price per unit</label>
                      <div class="col-sm-10">
                        <input type="number" name="price" class="form-control" placeholder="Price">
                      </div>
                    </div>

                    <div class="line"></div>
                    <div class="form-group row">
                      <label class="col-sm-2 form-control-label">Quantity</label>
                      <div class="col-sm-10">
                        <input type="number" name="quantity" class="form-control" placeholder="Quantity">
                      </div>
                    </div>
                    
                    
                  
                    <div class="line"></div>
                    <div class="form-group row">
                      <div class="col-sm-4 offset-sm-2">
                        <button type="submit" class="btn btn-secondary btn-sm">Cancel</button>
                        <input type="submit" name="add_store_item" value="Add Item" class="btn btn-primary btn-sm">
                      </div>
                    </div>
                  </form>
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
  </body>
</html>