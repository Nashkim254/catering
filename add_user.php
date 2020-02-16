<?php include_once './includes/header.inc';  
session_start();
?>
  <body>
<?php include_once('./includes/admin_menu.php');  ?>
    <div class="page">
      <!-- navbar-->
<?php include_once './includes/horizontal_bar.inc';  ?>



      <!-- Breadcrumb-->
      <div class="breadcrumb-holder">
        <div class="container-fluid">
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="./admin.php">Home</a></li>
            <li class="breadcrumb-item active">Add new system user       </li>
          </ul>
        </div>
      </div>
      <section class="forms">
        <div class="container-fluid">
          <!-- Page Header-->
          <header> 
            <h1 class="h3 display">Forms            </h1>
          </header>
          <div class="row">
            <div class="col-lg-6">
              <div class="card">
                <div class="card-header d-flex align-items-center">
                  <h4>User Names</h4>
                </div>
                <div class="card-body">
                  <p>Official names of the user.</p>
                  <form>
                    <div class="form-group">
                      <label>First name</label>
                      <input type="text" placeholder="First name" class="form-control" id="first_name">
                    </div>
                    <div class="form-group">       
                      <label>Last name</label>
                      <input type="text" placeholder="Last name" class="form-control" id="last_name">
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="card">
                <div class="card-header d-flex align-items-center">
                  <h4>Email and Username</h4>
                </div>
                <div class="card-body">
                  <p>Email and username of the user.<strong class="text-warning">Must not have been used to register someone else</strong></p>
                  <form class="form-horizontal">
                    <div class="form-group row">
                      <label class="col-sm-2">Email</label>
                      <div class="col-sm-10">
                        <input id="email" type="email" placeholder="Email Address" class="form-control form-control-success"><small class="form-text text-danger"></small>
                      </div>


                      <!--
                        <input type="text" name="first_name" placeholder="First Name" id="first_name" class="form-control"><br>
<input type="text" name="last_name" placeholder="Last Name" id="last_name" class="form-control"><br>
<input type="text" name="username" placeholder="username" id="username" class="form-control"><br>

<input type="email" name="email" placeholder="Email" id="email" class="form-control"><br>

<select name="user_type" id="user_type" class="form-control">
  <option value="">Choose user type</option>
  <option value="ADMIN">Admin</option>
  <option value="STORE_MANAGER">Store manager</option>
  <option value="CASHIER">Cashier</option>
</select><br>

<input type="password" name="password" placeholder="Password" id="password" class="form-control"><br>
<input type="password" name="con_password" placeholder="Confirm password" id="con_password" class="form-control"><br>

<input type="submit" name="register" value="Submit" id="register" class="btn btn-primary btn-sm">
</form></center>
  </div>
  </center>
</div>
                      -->
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-2">Username</label>
                      <div class="col-sm-10">
                        <input id="username" type="text" placeholder="Username" class="form-control form-control-warning"><small class="form-text"></small>
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-sm-2">User level</label>
                      <div class="col-sm-10">
                        <select id="user_type" type="text" placeholder="Pasword" class="form-control form-control-warning">
                          
                          <option value="ADMIN">Admin</option>
                          <option value="STORE_MANAGER">Store manager</option>
                          <option value="CASHIER">Cashier</option>
                        </select>
                          <small class="form-text"></small>
                      </div>
                    </div>
                    
                  </form>
                </div>
              </div>
            </div>
            <div class="col-lg-8">
              <div class="card">
                <div class="card-header d-flex align-items-center">
                  <h4>Choose User Password</h4>
                </div>
                <div class="card-body">
                  <form class="form-inline">
                    <div class="form-group">
                      <label for="inlineFormInput" class="sr-only">Password</label>
                      <input id="password" type="password" placeholder="Password" class="mr-3 form-control">
                    </div>
                    <div class="form-group">
                      <label for="inlineFormInputGroup" class="sr-only">Confirm password</label>
                      <input id="con_password" type="password" placeholder="Confirm password" class="mr-3 form-control form-control">
                    </div>
                    <div class="form-group">
                      <input type="submit" value="Add User" class="mr-3 btn btn-primary" id="register">
                    </div>
                  </form>
                </div>
              </div>
            </div>
          
      <footer class="main-footer">
        <div class="container-fluid">
          <div class="row">
            <div class="col-sm-6">
              <p>Maseno University Catering &copy; 2019-20200</p>
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
  $(document).ready(function () {
    $('#register').click(function(e){
      e.preventDefault();
      var first_name = $('#first_name').val();
      var last_name = $('#last_name').val();
      var username = $('#username').val();
      var user_type = $('#user_type').val();
      var email = $('#email').val();
      var password = $('#password').val();
      var con_password = $('#con_password').val();

      if (password.length <8) { alert ("Password must be 8 characters or more!"); return;}

      $.ajax({
          url : './Classes/Main.php',
          type : 'post',
          data :{register:1,first_name:first_name,last_name:last_name,user_type:user_type,email:email,con_password:con_password, username:username,password:password},
          async: false,
          success : function (res){
            alert(res);
            window.location.href = "./add_user.php";
          },
          error : function (res){
            alert('error');
            console.log(res);
          }
        });
    });
  });
</script>

  </body>
</html>