<?php
require ($_SERVER['DOCUMENT_ROOT'] . '/Computer-Store-POS-System/administration/dbconnect.php');

//Delete Remove Quantity
if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $sql1 = "SELECT * FROM removed_detail WHERE removed_id = '$id' ";
    $result1 = mysqli_query($connect, $sql1);
    if (mysqli_num_rows($result1) == 1) {
        $row2 = mysqli_fetch_assoc($result1);
        $num = $row2['quantity'];
        $store = $row2['store_id'];
        $product = $row2['product_name'];
        $sql3 = "SELECT * FROM product WHERE name='$product' AND store_id='$store' ";
        $result2 = mysqli_query($connect, $sql3);
        if (mysqli_num_rows($result2) > 0) {
            $row3 = mysqli_fetch_assoc($result2);
            $get_quantity = $row3['quantity'];
        }
        $final_quantity = $get_quantity + $num;
    }
    $sql4 = "UPDATE product SET quantity='$final_quantity' WHERE name='$product' AND store_id='$store'  ";
    $sql2 = "DELETE FROM removed_detail WHERE removed_id='$id'";
    $sql_run = mysqli_query($connect, $sql2);
    mysqli_query($connect, $sql4);
   $_SESSION['message'] = "This Removed Product Quantity ( ID : " . $id . " ) is delete successfully.";
}