<?php
require ($_SERVER['DOCUMENT_ROOT'] . '/Computer-Store-POS-System/administration/dbconnect.php');

//Delete Promotion
if (isset($_POST['id'])) {

    $id = $_POST['id'];
    $sql = "DELETE FROM promotion WHERE promo_id='$id'";
    $sql_run = mysqli_query($connect, $sql);
    $_SESSION['message'] = "This promotion ( ID : " . $id . " ) is delete successfully.";
}

