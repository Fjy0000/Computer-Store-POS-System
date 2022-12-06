<?php
$keyError = $passError1 = $passError2 = "";
?>

<!DOCTYPE html>

<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
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
                                            <span style="color: #dc3545">&nbsp;&nbsp; *<?php echo $passError1; ?></span>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="newPassword" type="password" name="newPassword"/>
                                                <label for="newPassword">New Password</label>
                                                <span onclick="togglePasswordIcon1()">
                                                    <button type="button" id="pws1_eye1" class="bi bi-eye-slash-fill"></button>
                                                    <button type="button" id="pws1_eye2" class="bi bi-eye-fill"></button>
                                                </span>
                                            </div>
                                            <span style="color: #dc3545">&nbsp;&nbsp; *<?php echo $passError2; ?></span>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="newPassword2" type="password" name="newPassword2" />
                                                <label for="newPassword2">Confirm New Password</label>
                                                <span onclick="togglePasswordIcon2()">
                                                    <button type="button" id="pws2_eye2" class="bi bi-eye-slash-fill"></button>
                                                    <button type="button" id="pws2_eye2" class="bi bi-eye-fill"></button>
                                                </span>
                                            </div>
                                            <span style="color: #dc3545">&nbsp;&nbsp; *<?php echo $keyError; ?></span>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="key" type="text" name="key"/>
                                                <label for="key">Password Recovery Key</label>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                                <button type="submit" class="btn btn-primary" name="resetPassword">Confirm Reset Password</button>
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
                var x1 = document.getElementById("password");
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
                var x2 = document.getElementById("confirmPassword");
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