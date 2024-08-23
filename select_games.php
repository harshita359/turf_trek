<?php
require_once "db/config.php";
check_login();
include('includes/allfunction.php');

// Handle deletion of a game entry if 'id' is set in the GET request
if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']); // Sanitize the input
    deletedata('select_games', 'select_game_id', $id);

    header('Location: select_games.php');
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
                    <h1 class="m-0 text-dark">Games Listing</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Games Listing</li>
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
                        <?php
                        if ($_SESSION['user_role'] == 'user') {
                            $user_id = $_SESSION['user']['user_id'];
                        ?>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Sr.No</th>
                                            <th>City Name</th>
                                            <th>Games Name</th>
                                            <th>Edit</th>
                                            <th>Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        // Optimized query using JOIN to fetch city and game names in a single query
                                        $query = "
                                            SELECT sg.select_game_id, c.city, gc.category_name
                                            FROM select_games sg
                                            LEFT JOIN city c ON sg.city_id = c.city_id
                                            LEFT JOIN games_category gc ON sg.game_id = gc.game_id
                                            WHERE sg.user_id = '$user_id'
                                        ";

                                        $result = mysqli_query($conn, $query);

                                        if ($result && mysqli_num_rows($result) > 0) {
                                            $i = 1; // Initialize counter before loop
                                            while ($data = mysqli_fetch_assoc($result)) {
                                                // Assign default values if city or game names are missing
                                                $city_name = htmlspecialchars($data['city'] ?? 'Unknown City');
                                                $game_name = htmlspecialchars($data['category_name'] ?? 'Unknown Game');
                                                $select_game_id = htmlspecialchars($data['select_game_id']);
                                        ?>
                                                <tr>
                                                    <td><?php echo $i; ?></td>
                                                    <td><?php echo $city_name; ?></td>
                                                    <td><?php echo $game_name; ?></td>
                                                    <td><a href="edit_select_games.php?id=<?php echo $select_game_id; ?>">Edit</a></td>
                                                    <td>
                                                        <a href="select_games.php?id=<?php echo $select_game_id; ?>" onclick="return confirm('Do you want to delete this data?')">Delete</a>
                                                    </td>
                                                </tr>
                                        <?php
                                                $i++;
                                            }
                                        } else {
                                        ?>
                                            <tr>
                                                <td colspan="5" class="text-center">No Records Found</td>
                                            </tr>
                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php
                        } else {
                            // Handle cases where user role is not 'user'
                            echo '<div class="card-body"><p class="text-danger">Access denied. You do not have permission to view this page.</p></div>';
                        }
                        ?>
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
