<?php
require_once "db/config.php";
check_login();

include('includes/allfunction.php');

$turf_nameerr = $turf_iderr = $addresserr = $cityerr = $emailerr = $mobileerr = $passworderr = $user_roleerr = $post_imgerr = '';

$turf_name = $turf_id = $address = $city = $email = $mobile = $password = $user_role = $post_img = '';

// Check if a file was previously uploaded
if (isset($_SESSION['uploaded_image'])) {
    $post_img = $_SESSION['uploaded_image'];
}

if (isset($_POST['submit'])) {

    $filename = $_FILES['post_img']['name'];
    $tempname = $_FILES['post_img']['tmp_name'];

    if (!empty($filename)) {
        move_uploaded_file($tempname, 'upload/' . $filename);
        $_SESSION['uploaded_image'] = $filename; // Save the uploaded image to session
    } elseif (!empty($post_img)) {
        // If no new image is uploaded but there's a previously uploaded image in session
        $filename = $post_img;
    } else {
        $filename = null; // or handle the case where no file is uploaded
    }

    $turf_name = $_POST['turf_name'];
    $turf_id = $_POST['turf_id'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $password = $_POST['password'];
    $user_role = $_POST['user_role'];
    $post_img = $filename;

    $errors = false;

    if (empty($turf_name)) {
        $turf_nameerr = " *Turf Name is required";
        $errors = true;
    }
    if (empty($turf_id)) {
        $turf_iderr = " *Turf ID is required";
        $errors = true;
    }
    if (empty($address)) {
        $addresserr = " *Address is required";
        $errors = true;
    }
    if (empty($city)) {
        $cityerr = " *City is required";
        $errors = true;
    }
    if (empty($email)) {
        $emailerr = " *Email is required";
        $errors = true;
    }
    if (empty($mobile)) {
        $mobileerr = " *Mobile is required";
        $errors = true;
    }
    if (empty($password)) {
        $passworderr = " *Password is required";
        $errors = true;
    }
    if (empty($user_role)) {
        $user_roleerr = " *User Role is required";
        $errors = true;
    }
    if (empty($post_img)) {
        $post_imgerr = " *Image is required";
        $errors = true;
    }

    if (!$errors) {
        // Insert the new category data
        $data = array(
            'turf_name' => $turf_name,
            'turf_id' => $turf_id,
            'address' => $address,
            'city' => $city,
            'email' => $email,
            'mobile' => $mobile,
            'password' => $password,
            'user_role' => $user_role,
            'post_img' => $post_img
        );

        if (insert($data, 'users')) {
            $_SESSION['status'] = "Receipt created successfully";
            // Clear the uploaded image session variable on successful submission
            unset($_SESSION['uploaded_image']);
            header("Location: turf_menegment.php");
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
                    <h1 class="m-0 text">Add Turf</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Add Turf</li>
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
                            <h3 class="card-title">Add Turf</h3>
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
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="address">Address <span class="error"><?php echo '  ' . $addresserr ?></span></label>
                                            <input type="text" name="address" class="form-control" id="address" value="<?php echo htmlspecialchars($address); ?>"  placeholder="Enter Address">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="city">City <span class="error"><?php echo '  ' . $cityerr ?></span></label>
                                            <select class="form-control" name="city">
                                                <option value="">Select city</option>
                                                <?php
                                                try {
                                                    $citydata = selectAllData('city');
                                                    if (!$citydata) {
                                                        throw new Exception("Error fetching City data");
                                                    }

                                                    // Get the previously selected city
                                                    $selectedcity = isset($_POST['city']) ? $_POST['city'] : '';

                                                    while ($city = mysqli_fetch_array($citydata)) {
                                                ?>
                                                        <option value="<?php echo $city['city']; ?>" <?php echo ($city['city'] == $selectedcity) ? 'selected' : ''; ?>>
                                                            <?php echo $city['city']; ?>
                                                        </option>
                                                <?php
                                                    }
                                                } catch (Exception $e) {
                                                    echo '<option value="">Error loading Citys</option>';
                                                    error_log($e->getMessage()); // Log the error message
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="email">Email ID <span class="error"><?php echo '  ' . $emailerr ?></span></label>
                                            <input type="email" name="email" class="form-control" id="email" value="<?php echo htmlspecialchars($email); ?>"  placeholder="Enter Email ID">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="mobile">Mobile <span class="error"><?php echo '  ' . $mobileerr ?></span></label>
                                            <input type="text" name="mobile" class="form-control" id="mobile" value="<?php echo htmlspecialchars($mobile); ?>"  placeholder="Enter Mobile">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Upload Image <span class="error"><?php echo '  ' . $post_imgerr ?></span></label>
                                            <input type="file" name="post_img" class="form-control" id="exampleInputEmail1" value="<?php echo htmlspecialchars($post_img); ?>" >
                                            <?php if (!empty($post_img)): ?>
                                                <p>Current Image: <?php echo $post_img; ?></p>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="password">Password <span class="error"><?php echo '  ' . $passworderr ?></span></label>
                                            <input type="password" name="password" class="form-control" id="password" value="<?php echo htmlspecialchars($password); ?>"  placeholder="Enter Password">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="user_role">Role <span class="error"><?php echo '  ' . $user_roleerr ?></span></label>
                                            <select class="form-control" name="user_role" id="user_role">
                                                <option value="">Select User Role</option>
                                                <option value="user" <?php echo ($user_role == 'user') ? 'selected' : '' ?>>User</option>
                                                <option value="admin"  <?php echo ($user_role == 'admin') ? 'selected' : '' ?>>Admin</option>
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
