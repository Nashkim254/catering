
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
            <li class="breadcrumb-item"><a href="admin.php">Home</a></li>
            <li class="breadcrumb-item active">Users of the system       </li>
          </ul>
        </div>
      </div>
      <section>
        <div class="container-fluid">
          <!-- Page Header-->
          <header> 
            <h1 class="h3 display">Users            </h1>
          </header>
          <div class="row">
            <div class="col-lg-6">
              <div class="card">
                <div class="card-header">
                  <h4>Administrators</h4>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>First Name</th>
                          <th>Last Name</th>
                          <th>Username</th>
                        </tr>
                      </thead>
                      <tbody id="admins">
                        
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="card">
                <div class="card-header">
                  <h4>Store Managers</h4>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-striped table-hover">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>First Name</th>
                          <th>Last Name</th>
                          <th>Username</th>
                        </tr>
                      </thead>
                      <tbody id="managers"></tbody>
                      
                      
                    </table>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="card">
                <div class="card-header">
                  <h4>Cashiers</h4>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-striped table-hover">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>First Name</th>
                          <th>Last Name</th>
                          <th>Username</th>
                        </tr>
                      </thead>
                      <tbody id="cashiers">
                        

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
              <p>Your company &copy; 2019-2020</p>
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
      function getUsers(){
          $.ajax({
          url : './Classes/Main.php',
          type : 'post',
          data :{getUsers:1},
          success : function (res){
            var data = JSON.parse(res);
            $('#admins').empty();
            $('#cashiers').empty();
            $('#managers').empty();
            $('#details').append('<tr><th>#</th><th>Item name</th><th>Quantity</th></tr>');
            for(var i=0; i < data.length; i++){
              if (data[i].USER_TYPE == 'ADMIN') {
                $('#admins').append('<tr><th scope="row">'+(i+1)+'</th><td>'+data[i].FIRST_NAME+'</td><td>'+data[i].LAST_NAME+'</td> <td>'+data[i].USERNAME+'</td></tr>');
              }else if (data[i].USER_TYPE == 'STORE_MANAGER') {
                $('#managers').append('<tr><th scope="row">'+(i+1)+'</th><td>'+data[i].FIRST_NAME+'</td><td>'+data[i].LAST_NAME+'</td> <td>'+data[i].USERNAME+'</td></tr>');
              }else if (data[i].USER_TYPE == 'CASHIER') {
                $('#cashiers').append('<tr><th scope="row">'+(i+1)+'</th><td>'+data[i].FIRST_NAME+'</td><td>'+data[i].LAST_NAME+'</td> <td>'+data[i].USERNAME+'</td></tr>');
              }

            }
          },
          error : function (res){
            alert('error');
            console.log(res);
          }
        });
      }


      $(document).ready(function () {
        getUsers();
      });
    </script>
  </body>
</html>