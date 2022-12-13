<?php

//Define empty error message
$r_product_name_Err = $r_store_id_Err = $reasonErr = $r_quantity_Err = $checkError = "";

//Define Description of function
$f_Desc1 = "This modal is the remove product quantity, in here you can remove product quantity and create a remove record.";

//Create Remove Quantity
if (isset($_POST['create_removeDetails'])) {

    $r_product_name = $_POST['r_product_name'];
    $r_store_id = $_POST['r_store_id'];
    $reason = $_POST['reason'];
    $r_quantity = $_POST['r_quantity'];
    $currentDate = date("Y-m-d");

    if (empty($r_product_name)) {
        $r_product_name_Err = "Product field cannot be left blank";
    }
    if (empty($r_store_id)) {
        $r_store_id_Err = "Store field cannot be left blank";
    }
    if (empty($reason)) {
        $reasonErr = "Reason field cannot be left blank";
    }
    if (empty($r_quantity)) {
        $r_quantity_Err = "Remove quantity field cannot be left blank";
    }

    $get_sql_store = "SELECT * FROM product WHERE store_id = '$r_store_id' AND name = '$r_product_name' ";
    $result1 = mysqli_query($connect, $get_sql_store);
    if (mysqli_num_rows($result1) == 1) {
        $row1 = mysqli_fetch_assoc($result1);
        $current_quantity = $row1['quantity'];
        $final_quantity = (int)$current_quantity - (int)$r_quantity;
        $store_name = $row1['store_name'];
        $product_id = $row1['product_id'];
    }else{
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
            $_SESSION['error'] = "Remove Product Quantity Fail ! ! System connect to database or query error.";
            header("Location:http://localhost/Computer-Store-POS-System/administration/remove_details.php");
            exit(0);
        }
    } else {
        $_SESSION['error'] = "Remove Product Quantity Fail ! Reason: <br>"
                . "$r_product_name_Err<br>"
                . "$r_quantity_Err<br>"
                . "$r_store_id_Err<br>"
                . "$reasonErr<br>"
                . "$checkError";
        header("Location:http://localhost/Computer-Store-POS-System/administration/remove_details.php");
        exit(0);
    }
}
?>

