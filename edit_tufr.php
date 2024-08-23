<?php
require_once "db/config.php";
check_login();

include('includes/allfunction.php');

$id = null; // Initialize $id

if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($GLOBALS['conn'], $_GET['id']); // Sanitize the input
    $editdata = selectDataByColumn('users', 'user_id', $id);
}

if (isset($_POST['submit'])) {

    $filename = $_FILES['post_img']['name'];
    $tempname = $_FILES['post_img']['tmp_name'];

    if (!empty($filename)) {
        move_uploaded_file($tempname, 'upload/' . $filename);
    } else {
        // Check if old image exists and use it
        $filename = isset($_POST['oldimg']) ? $_POST['oldimg'] : null;
    }

    $data = array(
        'turf_name' => $_POST['turf_name'],
        'turf_id' => $_POST['turf_id'],
        'address' => $_POST['address'],
        'location' => $_POST['location'],
        'email' => $_POST['email'],
        'mobile' => $_POST['mobile'],
        'password' => $_POST['password'],
        'user_role' => $_POST['user_role'],
        'post_img' => $filename
    );

    // Update the user data
    $postid = update($data, 'users', 'user_id', $id);

    if ($postid) {
        // Redirect to turf management page after submission
        header('Location: turf_menegment.php');
        exit();
    } else {
        echo "Error: Unable to update data.";
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
                    <h1 class="m-0 text-dark">Edit Turf</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Edit Turf</li>
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
                            <h3 class="card-title">Edit Turf</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form role="form" id="quickForm" method="post" action="" enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="turf_name">Turf Name</label>
                                            <input type="text" name="turf_name" value="<?php echo isset($editdata['turf_name']) ? htmlspecialchars($editdata['turf_name']) : ''; ?>" class="form-control" id="turf_name" placeholder="Enter Turf Name">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="turf_id">Turf ID</label>
                                            <input type="text" name="turf_id" value="<?php echo isset($editdata['turf_id']) ? htmlspecialchars($editdata['turf_id']) : ''; ?>" class="form-control" id="turf_id" placeholder="Enter Turf ID">
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="address">Address</label>
                                            <input type="text" name="address" value="<?php echo isset($editdata['address']) ? htmlspecialchars($editdata['address']) : ''; ?>" class="form-control" id="address" placeholder="Enter Address">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="location">Location</label>
                                            <select class="form-control" name="location">
                                                <?php
                                                $locationdata = selectAllData('location');

                                                while ($locdata = mysqli_fetch_array($locationdata)) {
                                                    $selected = '';

                                                    if (isset($editdata['location']) && $editdata['location'] == $locdata['location_name']) {
                                                        $selected = 'selected';
                                                    }
                                                ?>
                                                    <option value="<?php echo htmlspecialchars($locdata['location_name']); ?>" <?php echo $selected; ?>><?php echo htmlspecialchars($locdata['location_name']); ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="email">Email ID</label>
                                            <input type="email" name="email" value="<?php echo isset($editdata['email']) ? htmlspecialchars($editdata['email']) : ''; ?>" class="form-control" id="email" placeholder="Enter Email ID">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="mobile">Mobile</label>
                                            <input type="text" name="mobile" value="<?php echo isset($editdata['mobile']) ? htmlspecialchars($editdata['mobile']) : ''; ?>" class="form-control" id="mobile" placeholder="Enter Mobile">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <?php if (isset($editdata['post_img']) && !empty($editdata['post_img'])) : ?>
                                                <input type="hidden" name="oldimg" value="<?php echo htmlspecialchars($editdata['post_img']); ?>">
                                                <img src="upload/<?php echo htmlspecialchars($editdata['post_img']); ?>" style="height: 50px;" alt="Current Image">
                                            <?php endif; ?>
                                            <label for="post_img">Upload Image</label>
                                            <input type="file" name="post_img" class="form-control" id="post_img">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="password">Password</label>
                                            <input type="password" name="password" value="<?php echo isset($editdata['password']) ? htmlspecialchars($editdata['password']) : ''; ?>" class="form-control" id="password" placeholder="Enter Password">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="user_role">Role</label>
                                            <select class="form-control" name="user_role" id="user_role">
                                                <option value="">Select User Role</option>
                                                <option value="user" <?php if (isset($editdata['user_role']) && $editdata['user_role'] == 'user') echo "selected"; ?>>user</option>
                                                <option value="admin" <?php if (isset($editdata['user_role']) && $editdata['user_role'] == 'admin') echo "selected"; ?>>admin</option>
                                            </select>
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
