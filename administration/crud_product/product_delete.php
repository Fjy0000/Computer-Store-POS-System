<?php
require ($_SERVER['DOCUMENT_ROOT'] . '/Computer-Store-POS-System/administration/dbconnect.php');

//Delete Product
if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $sql = "DELETE FROM product WHERE product_id='$id'";
    $sql_run = mysqli_query($connect, $sql);
    $_SESSION['message'] = "This Product ( ID : " . $id . " ) is delete successfully.";
}

