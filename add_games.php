<?php
require_once "db/config.php";
check_login();
include('includes/allfunction.php');

$city_nameerr = $game_nameerr = '';
$city_name = '';
$selected_game = array();

if (isset($_POST['submit'])) {
    // Assign POST values to variables
    $city_id = $_POST['city_id'];
    $selected_game = isset($_POST['game_id']) ? $_POST['game_id'] : array();
    $errors = false;

    if (empty($city_id)) {
        $city_nameerr = " *City Name is required";
        $errors = true;
    }

    if (empty($selected_game)) {
        $game_nameerr = " *At least one game must be selected";
        $errors = true;
    }

    if (!$errors) {
        // Insert the selected games into the database
        foreach ($selected_game as $game_id) {
            $data = array(
                'user_id' => $_SESSION['user']['user_id'],
                'city_id' => $city_id,
                'game_id' => $game_id,
            );

            if (!insert($data, 'select_games')) {
                $_SESSION['status'] = "Failed to create games category";
                break; // Stop processing on the first failure
            }
        }

        if (!isset($_SESSION['status'])) {
            $_SESSION['status'] = "Games category created successfully";
        }
        header("Location: select_games.php");
        exit();
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
                    <h1 class="m-0 text">Add Games</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Add Games</li>
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
                            <h3 class="card-title">Add Games</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form role="form" id="quickForm" method="post" action="">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="city_id">City Name <span class="error"><?php echo $city_nameerr; ?></span></label>
                                            <select class="form-control" name="city_id">
                                                <option value="">Select City Name</option>
                                                <?php
                                                try {
                                                    $citydata = selectAllData('city');
                                                    if (!$citydata) {
                                                        throw new Exception("Error fetching City data");
                                                    }

                                                    $selectedcity = isset($_POST['city_id']) ? $_POST['city_id'] : '';

                                                    while ($city = mysqli_fetch_array($citydata)) {
                                                        echo '<option value="' . $city['city_id'] . '" ' . ($city['city_id'] == $selectedcity ? 'selected' : '') . '>';
                                                        echo $city['city'];
                                                        echo '</option>';
                                                    }
                                                } catch (Exception $e) {
                                                    echo '<option value="">Error loading Cities</option>';
                                                    error_log($e->getMessage()); // Log the error message
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="game_id">Select Games <span class="error"><?php echo $game_nameerr; ?></span></label><br>
                                            <?php
                                            try {
                                                $gamedata = selectAllData('games_category');
                                                if (!$gamedata) {
                                                    throw new Exception("Error fetching game data");
                                                }

                                                $selectedgame = isset($_POST['game_id']) ? $_POST['game_id'] : array();

                                                while ($game = mysqli_fetch_array($gamedata)) {
                                                    // echo '<div class="form-check">';
                                                    echo '<input type="checkbox" name="game_id[]" value="' . $game['game_id'] . '" ' . (in_array($game['category_name'], $selectedgame) ? 'checked' : '') . '>&nbsp&nbsp';
                                                    echo '<label class="form-check-label">' . $game['category_name'] . '</label><br>';
                                                    // echo '</div>';
                                                }
                                            } catch (Exception $e) {
                                                echo '<p>Error loading Games</p>';
                                                error_log($e->getMessage()); // Log the error message
                                            }
                                            ?>
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
