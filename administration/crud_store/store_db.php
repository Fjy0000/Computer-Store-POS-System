<?php

//Define empty error message
$currentStore = $nameErr = $addressErr = $typeErr = $stateErr = $postalErr = "";

//Define information of requirement
$questionStr = "1. All fields are required.";

//Create Store
if (isset($_POST['create_store'])) {

    $name = $_POST['name'];
    $type = $_POST['type'];
    $address = $_POST['address'];
    $state = $_POST['state'];
    $postalCode = $_POST['postalCode'];

    if (empty($name)) {
        $nameErr = "Required";
    } elseif (!empty($name) && strlen($name) < 4) {
        $nameErr = "Store name must at least 5 letter";
    }

    if (empty($type)) {
        $typeErr = "Required";
    }

    if (empty($address)) {
        $addressErr = "Required";
    } elseif (!empty($address) && strlen($address) < 11) {
        $addressErr = "Store Address must be real";
    }

    if (empty($state)) {
        $stateErr = "Required";
    }

    if (empty($postalCode)) {
        $postalErr = "Required";
    }


    if (empty($nameErr) && empty($typeErr) && empty($addressErr) && empty($stateErr) && empty($postalErr)) {

        $sql1 = "INSERT INTO store(name, type, address, state, postal_code)"
                . " VALUES ('$name','$type','$address','$state','$postalCode')";

        $sql_run = mysqli_query($connect, $sql1);
        if ($sql_run) {
            $_SESSION['message'] = "Created successfully.";
            header("Location:http://localhost/Computer-Store-POS-System/administration/store.php");
            exit(0);
        } else {
            $_SESSION['message'] = "Creating Failed.";
            header("Location:http://localhost/Computer-Store-POS-System/administration/store.php");
            exit(0);
        }
    }
}


//Staff Update Create
if (isset($_POST['update_store'])) {

    $id = $_POST['id'];
    $name = $_POST['name'];
    $type = $_POST['type'];
    $address = $_POST['address'];
    $state = $_POST['state'];
    $postalCode = $_POST['postalCode'];

    $sql3 = "UPDATE store SET name='$name',type='$type',"
            . "address='$address',state='$state',postal_code='$postalCode' WHERE store_id='$id'";

    $sql_run = mysqli_query($connect, $sql3);
    if ($sql_run) {
        $_SESSION['message'] = "Updated successfully.";
        header("Location:http://localhost/Computer-Store-POS-System/administration/store.php");
        exit(0);
    } else {
        $_SESSION['message'] = "Updating Failed.";
        header("Location:http://localhost/Computer-Store-POS-System/administration/store.php");
        exit(0);
    }
}

//Delete Store
if (isset($_POST['delete_store'])) {

    $id = $_POST['delete_id'];

    $sql4 = "DELETE FROM store WHERE store_id='$id'";
    $sql_run = mysqli_query($connect, $sql4);
    if ($sql_run) {
        $_SESSION['message'] = "Deleted successfully.";
        header("Location:http://localhost/Computer-Store-POS-System/administration/store.php");
        exit(0);
    } else {
        $_SESSION['message'] = "Delete Failed.";
        header("Location:http://localhost/Computer-Store-POS-System/administration/store.php");
        exit(0);
    }
}
?>