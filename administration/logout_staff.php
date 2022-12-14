<?php

require ($_SERVER['DOCUMENT_ROOT'] . '/Computer-Store-POS-System/administration/dbconnect.php');

//logout clear session value
session_start();

$id = $_SESSION['id'];
$sql = "DELETE FROM login_details WHERE user_id='$id'";
$sql_run = mysqli_query($connect, $sql);

session_destroy();

header("Location:http://localhost/Computer-Store-POS-System/administration/login_staff.php");
exit(0);

