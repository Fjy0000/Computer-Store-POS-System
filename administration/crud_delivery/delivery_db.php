<?php

//Error Message
$id_error = $store_send_error = $delivery_status_error = "";

//Define Description of function
$f_Desc1 = "This function is manage delivery, in here you can control the customer order delivery status and assign the store to send the order. ";

//Assign Delivery
if (isset($_POST['assign_delivery'])) {

    $id = $_POST['order_id'];
    $store_send = $_POST['store_send'];
    $delivery_status = $_POST['delivery'];

    if (empty($id)) {
        $id_error = "Order ID field cannot empty";
    }
    if (empty($store_send)) {
        $store_send_error = "Store field cannot empty";
    }
    if (empty($delivery_status)) {
        $delivery_status_error = "Delivery status field cannot empty";
    }

    if (empty($id_error) && empty($store_send_error) && empty($delivery_status_error)) {
        $sql = "UPDATE orders SET store_send='$store_send',delivery_status='$delivery_status' WHERE id='$id' ";

        $sql_run = mysqli_query($connect, $sql);
        if ($sql_run) {
            $_SESSION['message'] = "Updated Successfully.";
            header("Location:http://localhost/Computer-Store-POS-System/administration/delivery.php");
            exit(0);
        } else {
            $_SESSION['error'] = "Update Fail ! ! System connect to database or query error.  ";
            header("Location:http://localhost/Computer-Store-POS-System/administration/delivery.php");
            exit(0);
        }
    } else {
        $_SESSION['error'] = "Assign Fail ! ! Reason: <br>"
                . "$id_error <br>"
                . "$store_send_error <br>"
                . "$delivery_status_error ";
        header("Location:http://localhost/Computer-Store-POS-System/administration/delivery.php");
        exit(0);
    }
}
?>