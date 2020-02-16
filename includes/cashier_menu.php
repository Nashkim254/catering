    <!-- Side Navbar -->
    <nav class="side-navbar">
      <div class="side-navbar-wrapper">
        <!-- Sidebar Header    -->
        <div class="sidenav-header d-flex align-items-center justify-content-center">
          <!-- User Info-->
          <div class="sidenav-header-inner text-center"><img src="img/avatar-7.jpg" alt="person" class="img-fluid rounded-circle">
            <h2 class="h5"><?php echo ($_SESSION['name']); ?></h2><span>Cashier</span>
          </div>
          <!-- Small Brand information, appears on minimized sidebar-->
          <div class="sidenav-header-logo"><a href="index.php" class="brand-small text-center"> <strong>M</strong><strong class="text-primary">U</strong></a></div>
        </div>
        <!-- Sidebar Navigation Menus-->
        <div class="main-menu">
          <h5 class="sidenav-heading">Main menu</h5>
          <ul id="side-main-menu" class="side-menu list-unstyled">                  
            <li><a href="./cashier.php"> <i class="icon-home"></i>Home                             </a></li>
            <li><a href="./make_sale.php"> <i class="fa fa-money"></i>Make Sale </a></li>
            <li><a href="#exampledropdownDropdown" aria-expanded="false" data-toggle="collapse"> <i class="icon-interface-windows"></i>Manage items </a>
              <ul id="exampledropdownDropdown" class="collapse list-unstyled ">
                <li><a href="./sales_stock.php">Sales stock</a></li>
                <li><a href="./sales_logs.php">sales logs</a></li>
              </ul>
            </li>
            <li><a href="logout.php"> <i class="fa fa-sign-out"></i>Logout </a></li>
           
          </ul>
        </div>
        
      </div>
    </nav>