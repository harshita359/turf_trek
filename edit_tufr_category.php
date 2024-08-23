<?php
require_once "db/config.php";
check_login();

include('includes/allfunction.php');

$id = null; // Initialize $id

if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($GLOBALS['conn'], $_GET['id']); // Sanitize the input
    $editdata = selectDataByColumn('category', 'category_id', $id);
}

if (isset($_POST['submit'])) {
    $data = array(
        // 'parent_id' => $_POST['parent_name'],
        'user_id' => $_SESSION['user']['user_id'],
        'category_name' => $_POST['category_name'],
        'price' => $_POST['price']
    );

    // Insert the new category data
    update($data, 'category', 'category_id', $id);

    // Redirect to categories page after submission
    header('Location: turf_category.php');
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
                    <h1 class="m-0 text-dark">Edit category</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Edit category</li>
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
                            <h3 class="card-title">Edit category</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form role="form" id="quickForm" method="post" action="">
                        <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="category_name">Category Name</label>
                                            <input type="text" name="category_name" value="<?php echo isset($editdata['category_name']) ? htmlspecialchars($editdata['category_name']) : ''; ?>" class="form-control" id="category_name" placeholder="Enter Category Name">
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="price">Price</label>
                                            <input type="text" name="price" value="<?php echo isset($editdata['price']) ? htmlspecialchars($editdata['price']) : ''; ?>" class="form-control" id="price" placeholder="Enter price per hour">
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