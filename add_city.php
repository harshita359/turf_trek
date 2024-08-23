<?php
require_once "db/config.php";
check_login();
include('includes/allfunction.php');

$cityerr = $stateerr = $codeerr = $countryerr = '';
$city = $state = $code = $country = '';

if (isset($_POST['submit'])) {
    // Assign POST values to variables
    // $location_name = $_POST['location_name'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $code = $_POST['code'];
    $country = $_POST['country'];

    $errors = false;

    // if (empty($location_name)) {
    //     $location_nameerr = " *Location Name is required";
    //     $errors = true;
    // }
    if (empty($city)) {
        $cityerr = " *City Name is required";
        $errors = true;
    }
    if (empty($state)) {
        $stateerr = " *State Name is required";
        $errors = true;
    }
    if (empty($code)) {
        $codeerr = " *PIN code is required";
        $errors = true;
    }
    if (empty($country)) {
        $countryerr = " *Country is required";
        $errors = true;
    }

    if (!$errors) {
        // Insert the new category data
        $data = array(
            'user_id' => $_SESSION['user']['user_id'],
            // 'location_name' => $location_name,
            'city' => $city,
            'state' => $state,
            'code' => $code,
            'country' => $country,
        );

        if (insert($data, 'city')) {
            $_SESSION['status'] = "Receipt created successfully";
            header("Location: city.php");
            exit();
        } else {
            $_SESSION['status'] = "Failed to create receipt";
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
                    <h1 class="m-0 text">Add City</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Add City</li>
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
                            <h3 class="card-title">Add City</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form role="form" id="quickForm" method="post" action="">
                            <div class="card-body">
                                <div class="row">
                                    <!-- <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="location_name">Location Name <span class="error"><?php echo '  ' . $location_nameerr ?></span></label>
                                            <input type="text" name="location_name" class="form-control" id="location_name" value="<?php echo htmlspecialchars($location_name); ?>" placeholder="Enter Location Name">
                                        </div>
                                    </div> -->

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="city">City <span class="error"><?php echo '  ' . $cityerr ?></span></label>
                                            <input type="text" name="city" class="form-control" id="city" value="<?php echo htmlspecialchars($city); ?>" placeholder="Enter City">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="state">State <span class="error"><?php echo '  ' . $stateerr ?></span></label>
                                            <input type="text" name="state" class="form-control" id="state" value="<?php echo htmlspecialchars($state); ?>" placeholder="Enter State">
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="code">PIN Code <span class="error"><?php echo '  ' . $codeerr ?></span></label>
                                            <input type="text" name="code" class="form-control" id="code" value="<?php echo htmlspecialchars($code); ?>" placeholder="Enter ZIP Code">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="country">Country <span class="error"><?php echo '  ' . $countryerr ?></span></label>
                                            <input type="text" name="country" class="form-control" id="country" value="<?php echo htmlspecialchars($country); ?>" placeholder="Enter Country">
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