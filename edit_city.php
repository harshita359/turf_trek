<?php
require_once "db/config.php";
check_login();

include('includes/allfunction.php');

$id = null; // Initialize $id

if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($GLOBALS['conn'], $_GET['id']); // Sanitize the input
    $editdata = selectDataByColumn('city', 'city_id', $id);
}


if (isset($_POST['submit'])) {
    $data = array(
        // 'parent_id' => $_POST['parent_name'],
        'user_id' => $_SESSION['user']['user_id'],
        // 'location_name' => $_POST['location_name'],
        'city' => $_POST['city'],
        'state' => $_POST['state'],
        'code' => $_POST['code'],
        'country' => $_POST['country']

    );

    // Insert the new location data
    update($data, 'city', 'city_id', $id);

    // Redirect to categories page after submission
    header('Location: city.php');
    exit();
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
                    <h1 class="m-0 text-dark">Edit City</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Edit City</li>
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
                            <h3 class="card-title">Edit City</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form role="form" id="quickForm" method="post" action="">
                        <div class="card-body">
                                <div class="row">
                                    
                                    <!-- <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="location_name">Location Name</label>
                                            <input type="text" name="location_name" value="<?php echo isset($editdata['location_name']) ? htmlspecialchars($editdata['location_name']) : ''; ?>" class="form-control" id="location_name" placeholder="Enter Location Name">
                                        </div>
                                    </div> -->

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="city">City</label>
                                            <input type="text" name="city" value="<?php echo isset($editdata['city']) ? htmlspecialchars($editdata['city']) : ''; ?>" class="form-control" id="city" placeholder="Enter City">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="state">State</label>
                                            <input type="text" name="state" value="<?php echo isset($editdata['state']) ? htmlspecialchars($editdata['state']) : ''; ?>" class="form-control" id="state" placeholder="Enter State">
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="code">PIN Code</label>
                                            <input type="text" name="code" value="<?php echo isset($editdata['code']) ? htmlspecialchars($editdata['code']) : ''; ?>" class="form-control" id="code" placeholder="Enter ZIP Code">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="country">Country</label>
                                            <input type="text" name="country" value="<?php echo isset($editdata['country']) ? htmlspecialchars($editdata['country']) : ''; ?>" class="form-control" id="country" placeholder="Enter Country">
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