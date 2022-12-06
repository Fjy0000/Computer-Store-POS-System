<?php

//Define empty error message
$currentRemoveDetails = $r_product_name_Err = $r_store_id_Err = $reasonErr = $r_quantity_Err = $checkError = "";

//Define information of requirement
$questionStr = "1. All fields are required.";

//Create Remove Quantity
if (isset($_POST['create_removeDetails'])) {

    $r_product_name = $_POST['r_product_name'];
    $r_store_id = $_POST['r_store_id'];
    $reason = $_POST['reason'];
    $r_quantity = $_POST['r_quantity'];
    $currentDate = date("d/m/Y");

    if (empty($r_product_name)) {
        $r_product_name_Err = "Required";
    }

    if (empty($r_store_id)) {
        $r_store_id_Err = "Required";
    }

    if (empty($reason)) {
        $reasonErr = "Required";
    }

    if (empty($r_quantity)) {
        $r_quantity_Err = "Required";
    }

    $get_sql_store = "SELECT * FROM product WHERE store_id = '$r_store_id' AND name = '$r_product_name' ";
    $result1 = mysqli_query($connect, $get_sql_store);
    if (mysqli_num_rows($result1) == 1) {
        $row1 = mysqli_fetch_assoc($result1);

        $current_quantity = $row1['quantity'];
        $final_quantity = $current_quantity - $r_quantity;

        $store_name = $row1['store_name'];
        $product_id = $row1['product_id'];
    }
    if (empty($store_name) && empty($product_id)) {
        $checkError = "This store no this product.";
    }

    if (empty($r_product_name_Err) && empty($r_quantity_Err) && empty($r_store_id_Err) && empty($reasonErr) && empty($checkError)) {

        $sql1 = "INSERT INTO removed_detail(product_id, store_id, product_name, store_name, reason, quantity, removed_date) "
                . "VALUES ('$product_id','$r_store_id','$r_product_name','$store_name','$reason','$r_quantity','$currentDate') ";

        $sql2 = "UPDATE product SET quantity='$final_quantity' WHERE name='$r_product_name' AND store_id='$r_store_id' ";

        $sql_run = mysqli_query($connect, $sql1);
        mysqli_query($connect, $sql2);
        if ($sql_run) {
            $_SESSION['message'] = "Remove Product Quantity Successfully.";
            header("Location:http://localhost/Computer-Store-POS-System/administration/remove_details.php");
            exit(0);
        } else {
            $_SESSION['message'] = "Remove Product Quantity Failed.";
            header("Location:http://localhost/Computer-Store-POS-System/administration/remove_details.php");
            exit(0);
        }
    }
}


//Delete Remove Quantity
if (isset($_POST['delete_removedDetails'])) {

    $id = $_POST['delete_id'];

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
    if ($sql_run) {
        $_SESSION['message'] = "Deleted successfully.";
        header("Location:http://localhost/Computer-Store-POS-System/administration/remove_details.php");
        exit(0);
    } else {
        $_SESSION['message'] = "Delete Failed.";
        header("Location:http://localhost/Computer-Store-POS-System/administration/remove_details.php");
        exit(0);
    }
}



    