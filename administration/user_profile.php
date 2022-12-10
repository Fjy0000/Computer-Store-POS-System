<?php
require 'dbconnect.php';

if (isset($_GET['id'])) {
    $staff = $_GET['id'];
    $sql = "SELECT * FROM staff WHERE staff_id='$staff'";
    $result = mysqli_query($connect, $sql);

    if (mysqli_num_rows($result) > 0) {
        $currentStaff = mysqli_fetch_array($result);
    }
} else {
    echo 'Not Result.';
}
?>
<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Staff Profile </title>
        <link href="css/styles.css" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
        <!-- CSS only -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
        <!-- JavaScript Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
    </head>
    <body>
        <?php
        require 'static-nav/static-headnav.php';
        require 'static-nav/static-sidenav.php';
        ?>

        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">User's Profile</h1>
                    <div class="card mb-4">
                        <div class="card-header bg-dark">
                            <a href="admin_dashboard.php" class="btn btn-primary float-end">Back</a>
                        </div>
                    </div>
                    <section>
                        <div class="container">
                            <div class="row align-items-center">
                                <div>
                                    <h3>Staff Information</h3>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div>
                                                <h6>Staff ID</h6>
                                                <p><?php
                                                    if (empty($currentStaff['staff_id'])) {
                                                        echo "null";
                                                    } else {
                                                        echo $currentStaff['staff_id'];
                                                    }
                                                    ?></p>
                                            </div>
                                            <div>
                                                <h6>Username</h6>
                                                <p><?php
                                                    if (empty($currentStaff['staff_username'])) {
                                                        echo "null";
                                                    } else {
                                                        echo $currentStaff['staff_username'];
                                                    }
                                                    ?></p>
                                            </div>
                                            <div>
                                                <h6>Staff Email</h6>
                                                <p><?php
                                                    if (empty($currentStaff['staff_email'])) {
                                                        echo "null";
                                                    } else {
                                                        echo $currentStaff['staff_email'];
                                                    }
                                                    ?></p>
                                            </div>
                                            <div>
                                                <h6>Staff Position</h6>
                                                <p><?php
                                                    if (empty($currentStaff['staff_position'])) {
                                                        echo "null";
                                                    } else {
                                                        echo $currentStaff['staff_position'];
                                                    }
                                                    ?></p>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div>
                                                <h6>Staff Name</h6>
                                                <p><?php
                                                    if (empty($currentStaff['staff_name'])) {
                                                        echo "null";
                                                    } else {
                                                        echo $currentStaff['staff_name'];
                                                    }
                                                    ?></p>
                                            </div>
                                            <div>
                                                <h6>Staff Age</h6>
                                                <p><?php
                                                    if (empty($currentStaff['staff_age'])) {
                                                        echo "null";
                                                    } else {
                                                        echo $currentStaff['staff_age'];
                                                    }
                                                    ?></p>
                                            </div>
                                            <div>
                                                <h6>Phone Number</h6>
                                                <p><?php
                                                    if (empty($currentStaff['staff_contactNo'])) {
                                                        echo "null";
                                                    } else {
                                                        echo $currentStaff['staff_contactNo'];
                                                    }
                                                    ?></p>
                                            </div>
                                            <div>
                                                <h6>Staff IC</h6>
                                                <p><?php
                                                    if (empty($currentStaff['staff_ic'])) {
                                                        echo "null";
                                                    } else {
                                                        echo $currentStaff['staff_ic'];
                                                    }
                                                    ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </main>
        </div>
    </body>
</html>
