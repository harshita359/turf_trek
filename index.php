<?php
require_once "db/config.php";

include('includes/allfunction.php');

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE email = '$email' AND password='$password' LIMIT 1";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {

        $data = mysqli_fetch_assoc($result);


        //$_SERVER['ROLE'] = $data['user_role'];
        $_SESSION['IS_LOGIN'] = 'yes';
        // if ($data['user_role'] == 'admin') {
        //     $_SESSION['user_role'] = "admin";
        //     header("Location: home.php");
        // }
        // if ($data['user_role'] == 'user') {
        //     $_SESSION['user_role'] = "user";
        //     header("Location: home.php");
        // }
        $_SESSION['user_role'] = $data['user_role'];
        $_SESSION['user'] = $data;
        
        header("Location: deshbord.php");
    }else{
        header("Location: index.php");
    }
}

include('includes/header.php');

?>


<div class="wrapper">
    <main class="py-4">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="login-logo">
                        <a href=""><img src="assent/dist/img/logo.png" alt=""></a>
                    </div>
                    <div class="card">
                        <div class="card-header">Login :-</div>

                        <div class="card-body">
                            <div class="row mb-4 justify-content-center">
                                <img src="img/login_header.jpeg" alt="">
                            </div>
                            <form method="POST" action="">
                                <input type="hidden" name="_token" value="qrYth7wlpLQ7JNp4F8AJhbBNAJwT1VZXP9upib0b">
                                <div class="row mb-3">

                                    <div class="col-md-6 mx-auto">
                                        <label for="email" class="control-label">Email ID</label>
                                        <div class="input-group mb-3">
                                            <input type="email" class="form-control" name="email" placeholder="Email">
                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                    <span class="fas fa-envelope"></span>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="row mb-3">

                                    <div class="col-md-6 mx-auto">
                                        <label for="password" class="control-label">Password</label>
                                        <div class="input-group mb-3">
                                            <input type="password" name="password" class="form-control" placeholder="Password">
                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                    <span class="fas fa-lock"></span>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>


                                <div class="row mb-3">
                                    <div class="col-md-6 mx-auto">
                                        <button type="submit" class="btn btn-success text-light" name="submit">
                                            Login
                                        </button>

                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>

<?php

include('includes/script.php');
?>