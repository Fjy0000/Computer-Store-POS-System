<?php

//Define empty error message
$currentStaff = $nameErr = $phoneErr = $emailErr = $icErr = $ageErr = $positionErr = $userNameErr = $passwordErr = $cPasswordErr = $keyErr = "";

//Define Description of function
$f_Desc1 = "This page is a staff account registration page, in here you can create and add a new one staff account.";

//Create Staff
if (isset($_POST['create_staff'])) {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $ic = $_POST['ic'];
    $age = $_POST['age'];
    $position = $_POST['position'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $cPassword = $_POST['confirmPassword'];
    $recoveryKey = $_POST['recoveryKey'];

    //session value to keep input value after vaildation get error message
    $_SESSION['staff_input_name'] = $name;
    $_SESSION['staff_input_email'] = $email;
    $_SESSION['staff_input_phone'] = $phone;
    $_SESSION['staff_input_ic'] = $ic;
    $_SESSION['staff_input_age'] = $age;
    $_SESSION['staff_input_username'] = $username;
    $_SESSION['staff_input_password'] = $password;
    $_SESSION['staff_input_cPassword'] = $cPassword;
    $_SESSION['staff_input_recoveryKey'] = $recoveryKey;

    if (empty($name)) {
        $nameErr = "Name field cannot be left blank";
    } elseif (!empty($name)) {
        if (strlen($name) < 4) {
            $nameErr = "Staff name must be real name";
        } else {
            if (!preg_match("/^[a-zA-Z ]*$/", $name)) {
                $nameErr = "Only letters and spaces are allowed";
            }
        }
    }
    if (empty($email)) {
        $emailErr = "Email field cannot be left blank";
    } elseif (!empty($email) && !preg_match("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^", $email)) {
        $emailErr = "Invalid email format";
    }
    if (empty($phone)) {
        $phoneErr = "Phone field cannot be left blank";
    } elseif (!empty($phone)) {
        if (strlen($phone) < 10 || strlen($phone) > 13) {
            $phoneErr = "Staff phone number must be real";
        } else {
            if (!preg_match("/^[0-9]*$/", $phone)) {
                $phoneErr = "Only numbers are allowed";
            }
        }
    }
    if (empty($ic)) {
        $icErr = "IC field cannot be left blank";
    } elseif (!empty($ic)) {
        if (strlen($ic) < 12) {
            $icErr = "Staff ic number must be real";
        } else {
            if (!preg_match("/^[0-9]*$/", $ic)) {
                $icErr = "Only numbers are allowed";
            }
        }
    }
    if (empty($age)) {
        $ageErr = "Age field cannot be left blank";
    } elseif (!empty($age) && !preg_match("/^[0-9]*$/", $age)) {
        $ageErr = "Only numbers are allowed";
    }
    if (empty($position)) {
        $positionErr = "Position field cannot be left blank";
    }
    if (empty($recoveryKey)) {
        $keyErr = "Recovery Key field cannot be left blank";
    }
    if (empty($username)) {
        $userNameErr = "Username field cannot be left blank";
    } elseif (!empty($username)) {
        if (strlen($username) < 4) {
            $userNameErr = "Account username require at least 5 letter";
        }
    }
    if (empty($password)) {
        $passwordErr = "Password field cannot be left blank";
    } elseif (!empty($password)) {
        if (strlen($password) < 5) {
            $passwordErr = "Password must be at least 5 characters";
        } else {
            if (!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[^A-Za-z0-9])/", $password)) {
                $passwordErr = "Password must at least 1 uppercase, 1 special characters, number and lowercase.";
            }
        }
    }
    if (empty($cPassword)) {
        $cPasswordErr = "Confirm Password field cannot be left blank";
    } elseif (!empty($cPassword) && strcmp($password, $cPassword) != 0) {
        $cPasswordErr = "Invalid confirm password must match with password";
    }

    if (empty($nameErr) && empty($emailErr) && empty($phoneErr) && empty($icErr) && empty($ageErr) && empty($positionErr) && empty($keyErr) && empty($userNameErr) && empty($passwordErr) && empty($cPasswordErr)) {

        $sql1 = "INSERT INTO staff (`staff_username`, `staff_password`, `staff_name`, `staff_ic`, `staff_age`, `staff_position`, "
                . "`staff_email`, `staff_contactNo`, `staff_recoveryPasswordKey`)"
                . "VALUES ('$username','$password','$name','$ic','$age','$position','$email','$phone','$recoveryKey')";

        $sql_run = mysqli_query($connect, $sql1);
        if ($sql_run) {

            $_SESSION['message'] = "Created Successfully.";
            header("Location:http://localhost/Computer-Store-POS-System/administration/staff.php");
            exit(0);
        } else {
            $_SESSION['error'] = "Create Fail ! ! System connect to database or query error.";
            header("Location:http://localhost/Computer-Store-POS-System/administration/staff.php");
            exit(0);
        }
    }
}


//Update Staff 
if (isset($_POST['update_staff'])) {

    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $ic = $_POST['ic'];
    $age = $_POST['age'];
    $position = $_POST['position'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $cPassword = $_POST['confirmPassword'];
    $recoveryKey = $_POST['recoveryKey'];

    if (empty($name)) {
        $nameErr = "Name field cannot be left blank";
    } elseif (!empty($name)) {
        if (strlen($name) < 4) {
            $nameErr = "Staff name must be real name";
        } else {
            if (!preg_match("/^[a-zA-Z ]*$/", $name)) {
                $nameErr = "Only letters and spaces are allowed";
            }
        }
    }
    if (empty($email)) {
        $emailErr = "Email field cannot be left blank";
    } elseif (!empty($email) && !preg_match("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^", $email)) {
        $emailErr = "Invalid email format";
    }
    if (empty($phone)) {
        $phoneErr = "Phone field cannot be left blank";
    } elseif (!empty($phone)) {
        if (strlen($phone) < 10 || strlen($phone) > 13) {
            $phoneErr = "Staff phone number must be real";
        } else {
            if (!preg_match("/^[0-9]*$/", $phone)) {
                $phoneErr = "Only numbers are allowed";
            }
        }
    }
    if (empty($ic)) {
        $icErr = "IC field cannot be left blank";
    } elseif (!empty($ic)) {
        if (strlen($ic) < 12) {
            $icErr = "Staff ic number must be real";
        } else {
            if (!preg_match("/^[0-9]*$/", $ic)) {
                $icErr = "Only numbers are allowed";
            }
        }
    }
    if (empty($age)) {
        $ageErr = "Age field cannot be left blank";
    } elseif (!empty($age) && !preg_match("/^[0-9]*$/", $age)) {
        $ageErr = "Only numbers are allowed";
    }
    if (empty($position)) {
        $positionErr = "Position field cannot be left blank";
    }
    if (empty($recoveryKey)) {
        $keyErr = "Recovery Key field cannot be left blank";
    }
    if (empty($username)) {
        $userNameErr = "Username field cannot be left blank";
    } elseif (!empty($username)) {
        if (strlen($username) < 4) {
            $userNameErr = "Account username require at least 5 letter";
        }
    }
    if (empty($password)) {
        $passwordErr = "Password field cannot be left blank";
    } elseif (!empty($password)) {
        if (strlen($password) < 5) {
            $passwordErr = "Password must be at least 5 characters";
        } else {
            if (!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[^A-Za-z0-9])/", $password)) {
                $passwordErr = "Password must at least 1 uppercase, 1 special characters, number and lowercase.";
            }
        }
    }
    if (empty($cPassword)) {
        $cPasswordErr = "Confirm Password field cannot be left blank";
    } elseif (!empty($cPassword) && strcmp($password, $cPassword) != 0) {
        $cPasswordErr = "Invalid confirm password must match with password";
    }

    if (empty($nameErr) && empty($emailErr) && empty($phoneErr) && empty($icErr) && empty($ageErr) && empty($positionErr) && empty($keyErr) && empty($userNameErr) && empty($passwordErr) && empty($cPasswordErr)) {

        $sql3 = "UPDATE staff SET staff_username='$username', staff_password='$password', "
                . "staff_name ='$name', staff_ic='$ic', staff_age='$age', staff_position='$position', "
                . "staff_email='$email', staff_contactNo='$phone', staff_recoveryPasswordKey='$recoveryKey' WHERE staff_id='$id'";

        $sql_run = mysqli_query($connect, $sql3);
        if ($sql_run) {
            $_SESSION['message'] = "Updated Successfully.";
            header("Location:http://localhost/Computer-Store-POS-System/administration/staff.php");
            exit(0);
        } else {
            $_SESSION['error'] = "Update Fail ! ! System connect to database or query error.";
            header("Location:http://localhost/Computer-Store-POS-System/administration/staff.php");
            exit(0);
        }
    } else {
        $_SESSION['error'] = "Update Fail ! Reason: <br>"
                . "$nameErr <br>"
                . "$emailErr <br>"
                . "$phoneErr <br>"
                . "$icErr <br>"
                . "$ageErr <br>"
                . "$positionErr <br>"
                . "$userNameErr <br>"
                . "$passwordErr <br>"
                . "$cPasswordErr <br>"
                . "$keyErr";
        header("Location:http://localhost/Computer-Store-POS-System/administration/staff.php");
        exit(0);
    }
}
?>