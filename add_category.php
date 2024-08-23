<?php
require_once "db/config.php";
check_login();

include('includes/allfunction.php');


$category_nameerr = $priceerr = '';
$category_name = $price = '';

if (isset($_POST['submit'])) {
    // Assign POST values to variables
    $category_name = $_POST['category_name'];
    $price = $_POST['price'];

    $errors = false;

    if (empty($category_name)) {
        $category_nameerr = " *Category Name is required";
        $errors = true;
    }
    if (empty($price)) {
        $priceerr = " *Price is required";
        $errors = true;
    }
   
    if (!$errors) {
        // Insert the new category data
        $data = array(
            'user_id' => $_SESSION['user']['user_id'],
            'category_name' => $category_name,
            'price' => $price
        );

        if (insert($data, 'category')) {
            $_SESSION['status'] = "Receipt created successfully";
            header("Location: turf_category.php");
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
                    <h1 class="m-0 text">Add Category</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Add Category</li>
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
                            <h3 class="card-title">Add Category</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form role="form" id="quickForm" method="post" action="">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="category_name">Category Name  <span class="error"><?php echo '  ' . $category_nameerr ?></span></label>
                                            <input type="text" name="category_name" class="form-control" id="category_name" value="<?php echo htmlspecialchars($category_name); ?>" placeholder="Enter Category Name">
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="price">Price  <span class="error"><?php echo '  ' . $priceerr ?></span></label>
                                            <input type="text" name="price" class="form-control" id="price" value="<?php echo htmlspecialchars($price); ?>" placeholder="Enter price per hour">
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