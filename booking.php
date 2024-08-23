<?php
require_once "db/config.php";
check_login();

include('includes/allfunction.php');

if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($GLOBALS['conn'], $_GET['id']); // Sanitize the input
    deletedata('booking', 'booking_id', $id);

    header('Location: booking.php');
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
                    <h1 class="m-0 text">Booking Listing</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Booking Listing</li>
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
                                        <th>Turf Name</th>
                                        <th>Turf ID</th>
                                        <th>Customer Name</th>
                                        <th>Date</th>
                                        <th>From Time</th>
                                        <th>To Time</th>
                                        <th>Category</th>
                                        <th>Price</th>
                                        <th>Booking</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $bookingdata = selectAllDatabooking('booking');
                                    $i = 1;
                                    while ($data = mysqli_fetch_array($bookingdata, MYSQLI_ASSOC)) {
                                        $time = date("Y-m-d H:i:s");
                                        $time1 = $data['date'] . ' ' . $data['to_time'];

                                    //   echo  $time;
                                    //   echo  $time1;

                                        // Original date in YYYY-MM-DD format
                                        $originalDate = $data["date"];

                                        // Convert the date to a new format
                                        $newDate = date("d/m/Y", strtotime($originalDate));
                                    ?>
                                        <tr>
                                            <td><?php echo $i; ?></td>
                                            <td><?php echo htmlspecialchars($data['turf_name']); ?></td>
                                            <td><?php echo htmlspecialchars($data['turf_id']); ?></td>
                                            <td><?php echo htmlspecialchars($data['customer_name']); ?></td>
                                            <td><?php echo htmlspecialchars($newDate); ?></td>
                                            <td><?php echo htmlspecialchars($data['from_time']); ?></td>
                                            <td><?php echo htmlspecialchars($data['to_time']); ?></td>
                                            <td><?php echo htmlspecialchars($data['category']); ?></td>
                                            <td><?php echo htmlspecialchars($data['price']); ?></td>
                                            <td><?php echo (strtotime($time) < strtotime($time1)) ? "Upcoming" : "Completed"; ?></td>
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