<?php

//Define empty error message
$currentStore = $nameErr = $addressErr = $typeErr = $stateErr = $postalErr = "";

//Define Description of function
$f_Desc1 = "This page is the create store and in here you can create and add a new store.";
$f_Desc2 = "This page is the update store page and in here you can update a store details.";

//store create
if (isset($_POST['create_store'])) {

    $name = $_POST['name'];
    $type = $_POST['type'];
    $address = $_POST['address'];
    $state = $_POST['state'];
    $postalCode = $_POST['postalCode'];

    //session value to keep input value after vaildation get error message
    $_SESSION['store_input_name'] = $name;
    $_SESSION['store_input_type'] = $type;
    $_SESSION['store_input_address'] = $address;
    $_SESSION['store_input_state'] = $state;
    $_SESSION['store_input_postalCode'] = $postalCode;

    if (empty($name)) {
        $nameErr = "Name field cannot be left blank";
    } elseif (!empty($name) && strlen($name) < 4) {
        $nameErr = "Store name must at least 5 letter";
    }
    if (empty($type)) {
        $typeErr = "Store type field cannot be left blank";
    }
    if (empty($address)) {
        $addressErr = "Store address field cannot be left blank";
    } elseif (!empty($address) && strlen($address) < 11) {
        $addressErr = "Store Address must be real";
    }
    if (empty($state)) {
        $stateErr = "State field cannot be left blank";
    }
    if (empty($postalCode)) {
        $postalErr = "Postal code field cannot be left blank";
    }

    if (empty($nameErr) && empty($typeErr) && empty($addressErr) && empty($stateErr) && empty($postalErr)) {

        $sql1 = "INSERT INTO store(name, type, address, state, postal_code)"
                . " VALUES ('$name','$type','$address','$state','$postalCode')";

        $sql_run = mysqli_query($connect, $sql1);
        if ($sql_run) {
            $_SESSION['message'] = "Created Successfully.";
            header("Location:http://localhost/Computer-Store-POS-System/administration/store.php");
            exit(0);
        } else {
            $_SESSION['error'] = "Create Fail ! ! System connect to database or query error.";
            header("Location:http://localhost/Computer-Store-POS-System/administration/store.php");
            exit(0);
        }
    }
}

//store update
if (isset($_POST['update_store'])) {

    $id = $_POST['id'];
    $name = $_POST['name'];
    $type = $_POST['type'];
    $address = $_POST['address'];
    $state = $_POST['state'];
    $postalCode = $_POST['postalCode'];

    if (empty($name)) {
        $nameErr = "Name field cannot be left blank";
    } elseif (!empty($name) && strlen($name) < 4) {
        $nameErr = "Store name must at least 5 letter";
    }
    if (empty($type)) {
        $typeErr = "Store type field cannot be left blank";
    }
    if (empty($address)) {
        $addressErr = "Store address field cannot be left blank";
    } elseif (!empty($address) && strlen($address) < 11) {
        $addressErr = "Store Address must be real";
    }
    if (empty($state)) {
        $stateErr = "State field cannot be left blank";
    }
    if (empty($postalCode)) {
        $postalErr = "Postal code field cannot be left blank";
    }

    if (empty($nameErr) && empty($typeErr) && empty($addressErr) && empty($stateErr) && empty($postalErr)) {
        $sql3 = "UPDATE store SET name='$name',type='$type',"
                . "address='$address',state='$state',postal_code='$postalCode' WHERE store_id='$id'";

        $sql_run = mysqli_query($connect, $sql3);
        if ($sql_run) {
            $_SESSION['message'] = "Updated successfully.";
            header("Location:http://localhost/Computer-Store-POS-System/administration/store.php");
            exit(0);
        } else {
            $_SESSION['error'] = "Update Fail ! ! System connect to database or query error.";
            header("Location:http://localhost/Computer-Store-POS-System/administration/store.php");
            exit(0);
        }
    } else {
        $_SESSION['error'] = "Update Fail ! Reason:<br>"
                . "$nameErr<br>"
                . "$typeErr<br>"
                . "$addressErr<br>"
                . "$stateErr<br>"
                . "$postalErr";
        header("Location:http://localhost/Computer-Store-POS-System/administration/store.php");
        exit(0);
    }
}
?>