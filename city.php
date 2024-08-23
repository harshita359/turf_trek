<?php
require_once "db/config.php";
check_login();

include('includes/allfunction.php');

if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($GLOBALS['conn'], $_GET['id']); // Sanitize the input
    deletedata('city', 'city_id', $id);

    header('Location: city.php');
    exit(); // Ensure the script stops executing after redirection
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
                    <h1 class="m-0 text-dark">City Listing</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">City Listing</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <!-- /.card-header -->
                        
                            <div class="card-body">

                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Sr.No</th>
                                            <!-- <th>Location Name</th> -->
                                            <th>City</th>
                                            <th>State</th>
                                            <th>PIN Code</th>
                                            <th>Country</th>
                                            <th>Edit</th>
                                            <th>Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $citydata = selectAllData('city');
                                        $i = 1;
                                        while ($data = mysqli_fetch_array($citydata, MYSQLI_ASSOC)) {
                                            
                                        ?>
                                            <tr>
                                                <td><?php echo $i; ?></td>
                                                <!-- <td><?php echo htmlspecialchars($data['city_name']); ?></td> -->
                                                <td><?php echo htmlspecialchars($data['city']); ?></td>
                                                <td><?php echo htmlspecialchars($data['state']); ?></td>
                                                <td><?php echo htmlspecialchars($data['code']); ?></td>
                                                <td><?php echo htmlspecialchars($data['country']); ?></td>
                                                <td><a href="edit_city.php?id=<?php echo $data['city_id']; ?>">Edit</a></td>
                                                <td><a href="city.php?id=<?php echo $data['city_id']; ?>" onclick="return confirm('Do you want to delet this data')"> Delete</a></td>
                                            </tr>
                                        <?php
                                            $i++;
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                       
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php
include('includes/footer.php');
include('includes/script.php');
?>