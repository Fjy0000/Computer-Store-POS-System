<?php
require ($_SERVER['DOCUMENT_ROOT'] . '/Computer-Store-POS-System/administration/dbconnect.php');
require 'staff_db.php';

if (isset($_GET['id'])) {
    $staffID = $_GET['id'];
    $sql2 = "SELECT * FROM staff WHERE staff_id='$staffID'";
    $result2 = mysqli_query($connect, $sql2);

    if (mysqli_num_rows($result2) > 0) {
        $currentStaff = mysqli_fetch_array($result2);
    }
}
?>
<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Staff Account Update Page</title>
        <!-- Bootstrap CSS -->
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
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card shadow-lg border-0 rounded-lg mt-5">
                        <div class="card-header">
                            <h4>Staff Account Update
                                <a href="http://localhost/Computer-Store-POS-System/administration/staff.php" class="btn btn-danger float-end">Back</a>
                            </h4>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <i class="bi bi-question-circle float-end" style="font-size: 18px" data-bs-toggle="popover" title="Requirement:" data-bs-content="<?php echo $f_Desc1 ?>"></i>
                            </div>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="card mb-4 mb-md-0">
                                            <div class="card-body">
                                                <h4 class="mb-4">Staff Personal Information</h4>
                                                <input type="hidden" name="id" value="<?php echo $currentStaff['staff_id']; ?>">
                                                <div class="mb-3">
                                                    <label>Staff Name</label><span style="color: #dc3545">&nbsp;&nbsp; *<?php echo $nameErr; ?></span>
                                                    <input type="text" name="name" class="form-control" value="<?php echo $currentStaff['staff_name']; ?>">
                                                </div>
                                                <div class="mb-3">
                                                    <label>Staff Email</label><span style="color: #dc3545">&nbsp;&nbsp; *<?php echo $emailErr; ?></span>
                                                    <input type="email" name="email" class="form-control" value="<?php echo $currentStaff['staff_email']; ?>">
                                                </div>
                                                <div class="mb-3">
                                                    <label>Staff Phone No</label><span style="color: #dc3545">&nbsp;&nbsp; *<?php echo $phoneErr; ?></span>
                                                    <input type="text" name="phone" class="form-control" value="<?php echo $currentStaff['staff_contactNo']; ?>">
                                                </div>
                                                <div class="mb-3">
                                                    <label>Staff IC</label><span style="color: #dc3545">&nbsp;&nbsp; *<?php echo $icErr; ?></span>
                                                    <input type="text" name="ic" class="form-control" value="<?php echo $currentStaff['staff_ic']; ?>">
                                                </div>
                                                <div class="mb-3">
                                                    <label>Staff Age</label><span style="color: #dc3545">&nbsp;&nbsp; *<?php echo $ageErr; ?></span>
                                                    <input type="text" name="age" class="form-control" value="<?php echo $currentStaff['staff_age']; ?>">
                                                </div>
                                                <div class="mb-3">
                                                    <label>Staff Position</label><span style="color: #dc3545">&nbsp;&nbsp; *<?php echo $positionErr; ?></span>
                                                    <select class="form-select" aria-label="position list" name="position" id="positions">
                                                        <option value="<?php echo $currentStaff['staff_position']; ?>"><?php echo $currentStaff['staff_position']; ?></option>
                                                        <option value="Human Resource Manager">Human Resource Manager</option>
                                                        <option value="Sales Manager">Sales Manager</option>
                                                        <option value="Business Manager">Business Manager</option>
                                                        <option value="Staff Supervisor">Staff Supervisor</option>
                                                        <option value="Employee">Employee</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="card mb-4 mb-md-0">
                                            <div class="card-body">
                                                <h4 class="mb-4">Staff Account Information</h4>
                                                <div class="mb-3">
                                                    <label>Username</label><span style="color: #dc3545">&nbsp;&nbsp; *<?php echo $userNameErr; ?></span>
                                                    <input type="text" name="username" class="form-control" value="<?php echo $currentStaff['staff_username']; ?>">
                                                </div>
                                                <div class="mb-3">
                                                    <label>Password</label><span style="color: #dc3545">&nbsp;&nbsp; *<?php echo $passwordErr; ?></span>
                                                    <div class="input-group mb-3">
                                                        <input type="password" name="password" id="password" class="form-control" value="<?php echo $currentStaff['staff_password']; ?>">
                                                        <span onclick="togglePasswordIcon1()">
                                                            <button type="button" id="pws1_eye1" class="bi bi-eye-slash-fill"></button>
                                                            <button type="button" id="pws1_eye2" class="bi bi-eye-fill"></button>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label>Confirm Password</label><span style="color: #dc3545">&nbsp;&nbsp; *<?php echo $cPasswordErr; ?></span>
                                                    <div class="input-group mb-3">
                                                        <input type="password" name="confirmPassword" id="confirmPassword" class="form-control" value="<?php echo $currentStaff['staff_password']; ?>">
                                                        <span onclick="togglePasswordIcon2()">
                                                            <button type="button" id="pws2_eye1" class="bi bi-eye-slash-fill" style=""></button>
                                                            <button type="button" id="pws2_eye2" class="bi bi-eye-fill" style="font-size: 20px"></button>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label>Password Recovery Key</label><span style="color: #dc3545">&nbsp;&nbsp; *<?php echo $keyErr; ?></span>
                                                    <div class="input-group mb-3">
                                                        <input type="text" name="recoveryKey" id="recoveryKey" class="form-control" value="<?php echo $currentStaff['staff_recoveryPasswordKey']; ?>">
                                                        <button type="button" class="bi bi-arrow-repeat" style="font-size: 20px" onclick="getKey()"></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-4 mb-0">
                                    <div class="d-grid">
                                        <button type="submit" class="btn btn-primary" name="update_staff">Update Staff Account</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            //Toggle Password Visibility
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

            //popover
            var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'));
            var popoverList = popoverTriggerList.map(function (t) {
                return new bootstrap.Popover(t);
            });

            //Get Random Recovery Key
            function getKey() {
                var chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                var result = "";

                for (var i = 0; i < 6; i++) {
                    result += chars.charAt(Math.floor(Math.random() * chars.length));
                }
                document.getElementById("recoveryKey").value = result;
            }
        </script>

    </body>
</html>
