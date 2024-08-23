<?php
require_once "db/config.php";
check_login();

include('includes/allfunction.php');

$turf_nameerr = $turf_iderr = $customer_nameerr = $dateerr = $from_timeerr = $to_timeerr = $priceerr = $categoryerr = '';

$turf_name = $turf_id = $customer_name = $date = $from_time = $to_time = $price = $category = '';

if (isset($_POST['submit'])) {
    // Assign POST values to variables
    $turf_name = $_POST['turf_name'];
    $turf_id = $_POST['turf_id'];
    $customer_name = $_POST['customer_name'];
    $date = $_POST['date'];
    $from_time = $_POST['from_time'];
    $to_time = $_POST['to_time'];
    $category = $_POST['category'];
    $price = $_POST['price'];

    $errors = false;

    if (empty($turf_name)) {
        $turf_nameerr = " *Turf Name is required";
        $errors = true;
    }
    if (empty($turf_id)) {
        $turf_iderr = " *Turf ID is required";
        $errors = true;
    }
    if (empty($customer_name)) {
        $customer_nameerr = " *Customer Name is required";
        $errors = true;
    }
    if (empty($date)) {
        $dateerr = " *Date is required";
        $errors = true;
    }
    if (empty($from_time)) {
        $from_timeerr = " *From Time is required";
        $errors = true;
    }
    if (empty($to_time)) {
        $to_timeerr = " *To Time is required";
        $errors = true;
    }
    if (empty($category)) {
        $categoryerr = " *Category is required";
        $errors = true;
    }
    if (empty($price)) {
        $priceerr = " *Price is required";
        $errors = true;
    }
   
    // Validate the time difference
    if (!$errors) {
        $from_datetime = strtotime("$date $from_time");
        $to_datetime = strtotime("$date $to_time");
        
        if ($to_datetime - $from_datetime < 3600) { // 3600 seconds = 1 hour
            $from_timeerr = $to_timeerr = " *The time difference must be at least 1 hour";
            $errors = true;
        }
    }

    if (!$errors) {
        // Insert the new booking data
        $data = array(
            'user_id' => $_SESSION['user']['user_id'],
            'turf_name' => $turf_name, 
            'turf_id' => $turf_id,
            'customer_name' => $customer_name,
            'date' => $date,
            'from_time' => $from_time,
            'to_time' => $to_time,
            'category' => $category,
            'price' => $price
        );

        if (insert($data, 'booking')) {
            $_SESSION['status'] = "Booking created successfully";
            header("Location: booking.php");
            exit();
        } else {
            $_SESSION['status'] = "Failed to create booking";
        }
    }
}

include('includes/header.php');
include('includes/navbar.php');
include('includes/sidebar.php');
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text">Add Booking</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Add Booking</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- jquery validation -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Add Booking</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form role="form" id="quickForm" method="post" action="" enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="turf_name">Turf Name <span class="error"><?php echo '  ' . $turf_nameerr ?></span></label>
                                            <input type="text" name="turf_name" class="form-control" id="turf_name" value="<?php echo htmlspecialchars($turf_name); ?>"  placeholder="Enter Turf Name">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="turf_id">Turf ID <span class="error"><?php echo '  ' . $turf_iderr ?></span></label>
                                            <input type="text" name="turf_id" class="form-control" id="turf_id" value="<?php echo htmlspecialchars($turf_id); ?>"  placeholder="Enter Turf ID">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="customer_name">Customer Name <span class="error"><?php echo '  ' . $customer_nameerr ?></span></label>
                                            <input type="text" name="customer_name" class="form-control" id="customer_name" value="<?php echo htmlspecialchars($customer_name); ?>"  placeholder="Customer Name">
                                        </div>
                                    </div>
                      
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="date">Booking Date <span class="error"><?php echo '  ' . $dateerr ?></span></label>
                                            <input type="date" name="date" class="form-control" id="date" value="<?php echo htmlspecialchars($date); ?>"  placeholder="Enter Booking date">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="from_time">From Time <span class="error"><?php echo '  ' . $from_timeerr ?></span></label>
                                            <input type="time" name="from_time" class="form-control" id="from_time" value="<?php echo htmlspecialchars($from_time); ?>"  placeholder="Enter From Time">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="to_time">To Time <span class="error"><?php echo '  ' . $to_timeerr ?></span></label>
                                            <input type="time" name="to_time" class="form-control" id="to_time" value="<?php echo htmlspecialchars($to_time); ?>"  placeholder="Enter To Time">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="category">Category <span class="error"><?php echo '  ' . $categoryerr ?></span></label>
                                            <select class="form-control" name="category">
                                                <option value="">Select category</option>
                                                <?php
                                                try {
                                                    $categorydata = selectAllData('category');
                                                    if (!$categorydata) {
                                                        throw new Exception("Error fetching category data");
                                                    }

                                                    // Get the previously selected category
                                                    $selectedcategory = isset($_POST['category']) ? $_POST['category'] : '';

                                                    while ($category = mysqli_fetch_array($categorydata)) {
                                                ?>
                                                        <option value="<?php echo $category['category_name']; ?>" <?php echo ($category['category_name'] == $selectedcategory) ? 'selected' : ''; ?>>
                                                            <?php echo $category['category_name']; ?>
                                                        </option>
                                                <?php
                                                    }
                                                } catch (Exception $e) {
                                                    echo '<option value="">Error loading categories</option>';
                                                    error_log($e->getMessage()); // Log the error message
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="price">Price <span class="error"><?php echo '  ' . $priceerr ?></span></label>
                                            <input type="text" name="price" class="form-control" id="price" value="<?php echo htmlspecialchars($price); ?>"  placeholder="Enter price">
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
                <!--/.col (left) -->
                <!-- right column -->
                <div class="col-md-6">

                </div>
                <!--/.col (right) -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>

    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php
include('includes/footer.php');
include('includes/script.php');
?>
