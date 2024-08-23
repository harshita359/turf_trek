<?php
require_once "db/config.php";
check_login();

include('includes/allfunction.php');

include('includes/header.php');
include('includes/sidebar.php');

?>
<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
    </li>

  </ul>


  <!-- Right navbar links -->
  <ul class="navbar-nav ml-auto">
    <!-- Messages Dropdown Menu -->

    <!-- Notifications Dropdown Menu -->

    <li class="nav-item">
      <a class="nav-link" href="logout.php" role="button">
        <i class="fa-solid fa-right-from-bracket"></i> Logout
      </a>
    </li>
  </ul>
</nav>
<!-- /.navbar -->
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text">Dashboard</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Dashboard</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <?php
        if ($_SESSION['user_role'] == 'admin') {
        ?>
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box">
              <div class="inner">
                <?php
                if ($_SESSION['user_role'] == 'admin') {
                  $query = "SELECT * FROM users";
                  $result = mysqli_query($conn, $query);
                  if ($turf_total = mysqli_num_rows($result)) {
                    echo '<h3 class="card-text">' . $turf_total . '</h3>';
                  } else {
                    echo '<p class="card-text">No Data</p>';
                  }
                }
                ?>
                <p>Total Turf</p>
              </div>
              <div class="icon">
                <i class="fa-solid fa-money-bill"></i>
              </div>
              <a href="turf_menegment.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
        <?php   } ?>
         <!-- ./col -->
         <?php
        if ($_SESSION['user_role'] == 'user') {
        ?>
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box">
            <div class="inner">
            <?php
                if ($_SESSION['user_role'] == 'user') {
                  $query = "SELECT * FROM category";
                  $result = mysqli_query($conn, $query);
                  if ($category_total = mysqli_num_rows($result)) {
                    echo '<h3 class="card-text">' . $category_total . '</h3>';
                  } else {
                    echo '<p class="card-text">No Data</p>';
                  }
                }
                ?>
              <p>Total Category</p>
            </div>
            <div class="icon">
              <i class="fa-solid fa-location-dot"></i>
            </div>
            <a href="location.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <?php   } ?>
      
        <!-- ./col -->
        <?php
        if ($_SESSION['user_role'] == 'admin') {
        ?>
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box">
            <div class="inner">
            <?php
                if ($_SESSION['user_role'] == 'admin') {
                  $query = "SELECT * FROM city";
                  $result = mysqli_query($conn, $query);
                  if ($city_total = mysqli_num_rows($result)) {
                    echo '<h3 class="card-text">' . $city_total . '</h3>';
                  } else {
                    echo '<p class="card-text">No Data</p>';
                  }
                }
                ?>
              <p>Total City</p>
            </div>
            <div class="icon">
              <i class="fa-solid fa-location-dot"></i>
            </div>
            <a href="city.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <?php   } ?>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box">
            <div class="inner">
              <?php
              if ($_SESSION['user_role'] == 'admin') {
                $query = "SELECT * FROM booking";
                $result = mysqli_query($conn, $query);
                if ($booking_total = mysqli_num_rows($result)) {
                  echo '<h3 class="card-text">' . $booking_total . '</h3>';
                } else {
                  echo '<p class="card-text">No Data</p>';
                }
              } else if ($_SESSION['user_role'] == 'user') {
                $user = $_SESSION['user'];
                $user_id = $_SESSION['user']['user_id'];
                $query = "SELECT * FROM booking WHERE user_id='$user_id'";
                $result = mysqli_query($conn, $query);
                if ($booking_total = mysqli_num_rows($result)) {
                  echo '<h3 class="card-text">' . $booking_total . '</h3>';
                } else {
                  echo '<p class="card-text">No Data</p>';
                }
              }
              ?>

              <p>Total Booking</p>
            </div>
            <div class="icon">
              <i class="fa-solid fa-user-tag"></i>
            </div>
            <a href="booking.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box">
            <div class="inner">
              <?php
              if ($_SESSION['user_role'] == 'admin') {
                $query = "SELECT * FROM customer";
                $result = mysqli_query($conn, $query);
                if ($customer_total = mysqli_num_rows($result)) {
                  echo '<h3 class="card-text">' . $customer_total . '</h3>';
                } else {
                  echo '<p class="card-text">No Data</p>';
                }
              } else if ($_SESSION['user_role'] == 'user') {
                $user = $_SESSION['user'];
                $user_id = $_SESSION['user']['user_id'];
                $query = "SELECT * FROM customer WHERE user_id='$user_id'";
                $result = mysqli_query($conn, $query);
                if ($customer_total = mysqli_num_rows($result)) {
                  echo '<h3 class="card-text">' . $customer_total . '</h3>';
                } else {
                  echo '<p class="card-text">No Data</p>';
                }
              }
              ?>

              <p>Total Customer</p>
            </div>
            <div class="icon">
              <i class="fa-solid fa-users"></i>
            </div>
            <a href="customer.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>
      <!-- /.row -->

      <!-- /.row (main row) -->
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->



<?php
include('includes/footer.php');
?>