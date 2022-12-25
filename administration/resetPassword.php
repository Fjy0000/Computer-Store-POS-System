<?php
require ('dbconnect.php');

$errorEmail = "";

if (isset($_POST['resetPassword'])) {

    $email = $_POST['staffEmail'];

    $sql = "SELECT * FROM staff WHERE staff_email = '$email' ";
    $check = mysqli_query($connect, $sql);

    if (empty($email)) {
        $errorEmail = "Please enter your email.";
    } elseif (!empty($email) && !preg_match("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^", $email)) {
        $errorEmail = "Invalid email format";
    }

    if (empty($errorEmail)) {
        if (mysqli_num_rows($check) == 1) {
            $row = mysqli_fetch_assoc($check);
            if ($row['staff_email'] == $email) {

                $message = "You have requested to reset your Account password. Please copy this code : " 
                        . $row['staff_recoveryPasswordKey'] . 
                        ". And enter the code to change your password. Please be reminded that the code is valid for 24 hours.";
                $to = $email;
                $subject = "Staff Account - Password Recovery Key";
                $txt = $message;
                $headers = "From: ymark2122@gmail.com";

                mail($to, $subject, $txt, $headers);
                header("Location:http://localhost/Computer-Store-POS-System/administration/setNewPassword.php");
                exit(0);
            } else {
                echo '<script>alert("Invalid Email ! Please Try Again")</script>';
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Reset Password</title>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Password Recovery</h3></div>
                                    <div class="card-body">
                                        <div class="small mb-3 text-muted">Enter your email address and we will send you a link to reset your password.</div>
                                        <form action="resetPassword.php" method="POST">
                                            <span style="color: #dc3545">&nbsp;&nbsp; *<?php echo $errorEmail; ?></span>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="staffEmail" type="email" name="staffEmail" placeholder="name@example.com" />
                                                <label for="staffEmail">Email address</label>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                                <a class="small" href="login_staff.php">Return to login</a>
                                                <button type="submit" class="btn btn-primary" name="resetPassword">Reset Password</button>
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
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
    </body>
</html>
