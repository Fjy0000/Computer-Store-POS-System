<?php

//Error Message
$id_error = $store_send_error = $delivery_status_error = "";

//Define information of requirement
$questionStr = "1. All fields are required.";

//Assign Delivery
if (isset($_POST['assign_delivery'])) {

    $id = $_POST['order_id'];
    $store_send = $_POST['store_send'];
    $delivery_status = $_POST['delivery'];

    if (empty($id)) {
        $id_error = "Required";
    }
    if (empty($store_send)) {
        $store_send_error = "Required";
    }
    if (empty($delivery_status)) {
        $delivery_status_error = "Required";
    }

    if (empty($id_error) && empty($store_send_error) && empty($delivery_status_error)) {
        $sql = "UPDATE orders SET store_send='$store_send',delivery_status='$delivery_status' WHERE id='$id' ";

        $sql_run = mysqli_query($connect, $sql);
        if ($sql_run) {
            $_SESSION['message'] = "Updated successfully.";
            header("Location:http://localhost/Computer-Store-POS-System/administration/delivery.php");
            exit(0);
        } else {
            $_SESSION['message'] = "Updating Failed.";
            header("Location:http://localhost/Computer-Store-POS-System/administration/delivery.php");
            exit(0);
        }
    } else {
        $_SESSION['message'] = "Assign Failed.";
        header("Location:http://localhost/Computer-Store-POS-System/administration/delivery.php");
        exit(0);
    }
}
?>