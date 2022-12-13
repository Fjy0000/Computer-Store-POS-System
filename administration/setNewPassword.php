<?php
require ('dbconnect.php');
$keyError = $passError1 = $passError2 = "";

if (isset($_POST['confirmResetPassword'])) {

    $password1 = $_POST['newPassword'];
    $password2 = $_POST['newPassword2'];
    $key = $_POST['key'];

    if (empty($password1)) {
        $passError1 = "Please enter your new password.";
    } elseif (!empty($password1)) {
        if (strlen($password1) < 5) {
            $passError1 = "Password must be at least 5 characters";
        } else {
            if (!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[^A-Za-z0-9])/", $password1)) {
                $passError1 = "Password must at least 1 uppercase, 1 special characters, number and lowercase.";
            }
        }
    }
    if (empty($password2)) {
        $passError2 = "Please enter your new password.";
    } elseif (!empty($password2) && strcmp($password1, $password2) != 0) {
        $passError2 = "Please make sure your password match.";
    }
    if (empty($key)) {
        $keyError = "Please enter your password recovery key.";
    }

    if (empty($passError1) && empty($passError2) && empty($keyError)) {
        $sql = "SELECT * FROM staff WHERE staff_recoveryPasswordKey = '$key' ";
        $result = mysqli_query($connect, $sql);

        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            if ($row['staff_recoveryPasswordKey'] == $key) {

                $sql1 = "UPDATE staff SET staff_password='$password1' WHERE staff_recoveryPasswordKey ='$key' ";

                $sql_run = mysqli_query($connect, $sql1);
                if ($sql_run) {
                    $_SESSION['message'] = "Your Account Password reset successfully.";
                    header("Location:http://localhost/Computer-Store-POS-System/administration/login_staff.php");
                    exit(0);
                }
            }
        } else {
            echo '<script>alert("Invalid Password Recovery Key !")</script>';
        }
    }
}
?>

<!DOCTYPE html>

<html lang="en">
    <head>
        <title>set new password</title>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>

        <style>
            #pws1_eye1{
                font-size: 20px;
            }
            #pws1_eye2{
                display: none;
                font-size: 20px;
            }
            #pws2_eye1{
                font-size: 20px;
            }
            #pws2_eye2{
                display: none;
                font-size: 20px;
            }
        </style>
    </head>
    <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Set New Password</h3></div>
                                    <div class="card-body">
                                        <div class="small mb-3 text-muted">Password Recovery Key is already send to your email please check your email.</div>

                                        <form action="setNewPassword.php" method="POST">

                                            <label>New Password</label>  <span style="color: #dc3545">&nbsp;&nbsp; *<?php echo $passError1; ?></span>
                                            <div class="input-group mb-3">
                                                <input class="form-control" id="newPassword" type="password" name="newPassword"/>
                                                <span onclick="togglePasswordIcon1()">
                                                    <button type="button" id="pws1_eye1" class="bi bi-eye-slash-fill"></button>
                                                    <button type="button" id="pws1_eye2" class="bi bi-eye-fill"></button>
                                                </span>
                                            </div>

                                            <label>Confirm New Password</label><span style="color: #dc3545">&nbsp;&nbsp; *<?php echo $passError2; ?></span>
                                            <div class="input-group mb-3">
                                                <input class="form-control" id="newPassword2" type="password" name="newPassword2" />
                                                <span onclick="togglePasswordIcon2()">
                                                    <button type="button" id="pws2_eye1" class="bi bi-eye-slash-fill"></button>
                                                    <button type="button" id="pws2_eye2" class="bi bi-eye-fill"></button>
                                                </span>
                                            </div>

                                            <label>Password Recovery Key</label>  <span style="color: #dc3545">&nbsp;&nbsp; *<?php echo $keyError; ?></span>
                                            <input class="form-control" id="key" type="text" name="key"/>
                                            <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                                <button type="submit" class="btn btn-primary" name="confirmResetPassword">Confirm Reset Password</button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="card-footer text-center py-3">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <div id="layoutAuthentication_footer">
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Your Website 2022</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script>
            function togglePasswordIcon1() {
                var x1 = document.getElementById("newPassword");
                var y1 = document.getElementById("pws1_eye1");
                var z1 = document.getElementById("pws1_eye2");

                if (x1.type === "password") {
                    x1.type = "text";
                    y1.style.display = "none";
                    z1.style.display = "block";
                } else {
                    x1.type = "password";
                    z1.style.display = "none";
                    y1.style.display = "block";
                }
            }

            function togglePasswordIcon2() {
                var x2 = document.getElementById("newPassword2");
                var y2 = document.getElementById("pws2_eye1");
                var z2 = document.getElementById("pws2_eye2");

                if (x2.type === "password") {
                    x2.type = "text";
                    y2.style.display = "none";
                    z2.style.display = "block";
                } else {
                    x2.type = "password";
                    z2.style.display = "none";
                    y2.style.display = "block";
                }
            }
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
    </body>
</html>