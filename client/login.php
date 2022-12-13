<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
include 'config.php';
require 'dbconnect_pdo.php';
session_start();

if (isset($_POST['submit'])) {

    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass = mysqli_real_escape_string($conn, md5($_POST['password']));

    $select = mysqli_query($conn, "SELECT * FROM `user_form` WHERE email = '$email' AND password = '$pass'") or die('query failed');

    if (mysqli_num_rows($select) > 0) {
        $row = mysqli_fetch_assoc($select);
        $_SESSION['user_id'] = $row['id'];

        //PDO mode - add users login details for use to represent the account online/offline in live chat
        $i = $row['id'];
        $userN = $row['name'];
        $sub_sql = "INSERT INTO login_details(user_id, username) VALUES ('$i','$userN')";
        //PDO
        $statement = $connect2->prepare($sub_sql);
        $statement->execute();
        $_SESSION['login_details_id'] = $connect2->lastInsertId();

        header('location:home.php');
    } else {
        $message[] = 'incorrect email or password!';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>login</title>

        <!-- custom css file link  -->
        <link rel="stylesheet" href="css/main.css">

    </head>
    <body>

        <div class="form-container">

            <form action="" method="post" enctype="multipart/form-data">
                <h3>login now</h3>
                <?php
                if (isset($message)) {
                    foreach ($message as $message) {
                        echo '<div class="message">' . $message . '</div>';
                    }
                }
                ?>
                <input type="email" name="email" placeholder="enter email" class="box" required>
                <input type="password" name="password" placeholder="enter password" class="box" required>
                <input type="submit" name="submit" value="login now" class="btn">
                <p>don't have an account? <a href="register.php">Register Now</a></p>
            </form>

        </div>

    </body>
</html>