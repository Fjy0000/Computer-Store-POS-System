<?php

//Define empty error message
$currentProduct = $nameErr = $descriptionErr = $categoryErr = $priceErr = $s_idErr = $imageErr = $quantityErr = $t_productErr = $toErr = $fromErr = "";

//Define information of requirement
$questionStr = "1. All fields are required.";

//Add New Product
if (isset($_POST['create_product'])) {

    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = (double) $_POST['price'];
    $c_name = $_POST['c_name'];
    $quantity = $_POST['quantity'];

    $fileType = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
    $filename = $_FILES['image']['name'];
    $tempname = $_FILES['image']['tmp_name'];
    $folder = $_SERVER['DOCUMENT_ROOT'] . '/Computer-Store-POS-System/client/images/';

    $s_id = $_POST['s_id'];
    $sql1 = "SELECT * FROM store WHERE store_id='$s_id'";
    $result = mysqli_query($connect, $sql1);
    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $store_n = $row['name'];
        $store_type = $row['type'];
    }

    if ($_FILES['image']['size'] > 200000) {
        $imageErr =  "File is too large only allowed  size < 2MB.";
    }

    if ($fileType != "jpg" && $fileType != "png" && $fileType != "jpeg") {
        $imageErr = "Only JPG, JPEG & PNG files are allowed.";
    }

    if (empty($name)) {
        $nameErr = "Required.";
    } elseif (!empty($name) && strlen($name) < 5) {
        $nameErr = "Product name must be at least 5 letter.";
    }

    if (empty($description)) {
        $descriptionErr = "Required";
    }

    if (empty($price)) {
        $priceErr = "Required";
    }

    if (empty($c_name)) {
        $categoryErr = "Required";
    }

    if (empty($s_id)) {
        $s_idErr = "Required";
    }

    if (empty($quantity)) {
        $quantityErr = "Required";
    }
    if (empty($filename)) {
        $imageErr = "Required";
    }

    if (empty($nameErr) && empty($priceErr) && empty($categoryErr) && empty($s_idErr) && empty($imageErr) && empty($descriptionErr) && empty($imageErr)) {

        $sql2 = "INSERT INTO product(name, description, price, category_name, store_id, store_name, store_type, quantity, image) "
                . "VALUES ('$name','$description','$price','$c_name','$s_id','$store_n','$store_type','$quantity','$filename') ";

        move_uploaded_file($tempname, $folder . $filename);
        $sql_run = mysqli_query($connect, $sql2);

        if ($sql_run) {
            $_SESSION['message'] = "Created successfully.";
            header("Location:http://localhost/Computer-Store-POS-System/administration/stock_hq.php");
            exit(0);
        } else {
            $_SESSION['message'] = "Creating Failed.";
            header("Location:http://localhost/Computer-Store-POS-System/administration/stock_hq.php");
            exit(0);
        }
    }
}


//Update Product
if (isset($_POST['update_product'])) {

    $id = $_POST['id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = (double) $_POST['price'];
    $c_name = $_POST['c_name'];
    $quantity = $_POST['quantity'];

    $filename = $_FILES['image']['name'];
    $tempname = $_FILES['image']['tmp_name'];
    $folder = $_SERVER['DOCUMENT_ROOT'] . '/Computer-Store-POS-System/client/images/';

    $s_id = $_POST['s_id'];
    $sql1 = "SELECT * FROM store WHERE store_id='$s_id'";
    $result = mysqli_query($connect, $sql1);
    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $store_n = $row['name'];
        $store_type = $row['type'];
    }

    $sql3 = "UPDATE product SET name='$name',description='$description',price='$price',category_name='$c_name',"
            . "store_id='$s_id',store_name='$store_n',store_type='$store_type',quantity='$quantity',image='$filename' WHERE product_id='$id' ";

    move_uploaded_file($tempname, $folder . $filename);
    $sql_run = mysqli_query($connect, $sql3);
    if ($sql_run) {
        $_SESSION['message'] = "Updated successfully.";
        header("Location:http://localhost/Computer-Store-POS-System/administration/stock_hq.php");
        exit(0);
    } else {
        $_SESSION['message'] = "Updating Failed.";
        header("Location:http://localhost/Computer-Store-POS-System/administration/stock_hq.php");
        exit(0);
    }
}


//Delete Product
if (isset($_POST['delete_product'])) {

    $id = $_POST['delete_id'];

    $sql4 = "DELETE FROM product WHERE product_id='$id'";
    $sql_run = mysqli_query($connect, $sql4);

    if ($sql_run) {
        $_SESSION['message'] = "Deleted successfully.";
        header("Location:http://localhost/Computer-Store-POS-System/administration/stock_hq.php");
        exit(0);
    } else {
        $_SESSION['message'] = "Delete Failed.";
        header("Location:http://localhost/Computer-Store-POS-System/administration/stock_hq.php");
        exit(0);
    }
}

//Transfer Product
if (isset($_POST['transfer_product'])) {

    $fromStoreId = $_POST['fromStoreId'];
    $toStoreId = $_POST['toStoreId'];
    $n_product = $_POST['product'];
    $transfer_num = $_POST['transferQuantity'];

    //get store information
    $sql1 = "SELECT * FROM store WHERE store_id='$fromStoreId' ";
    $sql2 = "SELECT * FROM store WHERE store_id='$toStoreId' ";

    //get product information
    $sql3 = "SELECT * FROM product WHERE store_id='$fromStoreId' AND name='$n_product' ";
    $sql4 = "SELECT * FROM product WHERE store_id='$toStoreId' AND name='$n_product' ";

    $result1 = mysqli_query($connect, $sql1);
    if (mysqli_num_rows($result1) == 1) {
        $row1 = mysqli_fetch_assoc($result1);
        $from_name = $row1['name'];
    }
    $result2 = mysqli_query($connect, $sql2);
    if (mysqli_num_rows($result2) == 1) {
        $row2 = mysqli_fetch_assoc($result2);
        $to_name = $row2['name'];

        //use to create new product.
        $to_type = $row2['type'];
    }
    $result3 = mysqli_query($connect, $sql3);
    if (mysqli_num_rows($result3) == 1) {
        $row3 = mysqli_fetch_assoc($result3);

        //use to create new product
        $from_description = $row3['description'];
        $from_price = $row3['price'];
        $from_cName = $row3['category_name'];
        $from_image = $row3['image'];

        $from_quantity = $row3['quantity'];
        $num_from = $from_quantity - $transfer_num;
    }
    $result4 = mysqli_query($connect, $sql4);
    if (mysqli_num_rows($result4) == 1) {
        $row4 = mysqli_fetch_assoc($result4);
        $to_quantity = $row4['quantity'];
        $num_to = $to_quantity + $transfer_num;
    }

    //input requirement
    if (empty($fromStoreId)) {
        $fromErr = "Required";
    }

    if (empty($toStoreId)) {
        $toErr = "Required";
    } elseif ($fromStoreId == $toStoreId) {
        $toErr = "Cannot select same store. ";
    }

    if (empty($n_product)) {
        $t_productErr = "Required";
    }

    if (empty($transfer_num)) {
        $quantityErr = "Required";
    }

    if (empty($t_productErr) && empty($toErr) && empty($fromErr) && empty($quantityErr)) {

        //save transfer product details 
        $sql5 = "INSERT INTO transfer_product (product_name, from_store, fromStore_id, to_store, toStore_id, quantity) "
                . "VALUES ('$n_product','$from_name','$fromStoreId','$to_name','$toStoreId',' $transfer_num') ";

        //update both side product quantity
        $to_sql = "UPDATE product SET quantity='$num_to' WHERE name='$n_product' AND store_id='$toStoreId' ";
        $from_sql = "UPDATE product SET quantity='$num_from' WHERE name='$n_product' AND store_id='$fromStoreId' ";

        //check product is no empty if empty create product details
        $check = "SELECT * FROM product WHERE name='$n_product' AND store_id='$toStoreId' ";
        $create_toStore_sql = "INSERT INTO product(name, description, price, category_name, store_id, store_name, store_type, quantity, image) "
                . "VALUES ('$n_product','$from_description','$from_price','$from_cName','$toStoreId','$to_name','$to_type','$transfer_num','$from_image') ";
        $check_run = mysqli_query($connect, $check);

        $sql_run = mysqli_query($connect, $sql5);
        mysqli_query($connect, $from_sql);
        if (mysqli_num_rows($check_run) == 0) {
            mysqli_query($connect, $create_toStore_sql);

            if ($sql_run) {
                $_SESSION['message'] = "Transfer successfully.";
                header("Location:http://localhost/Computer-Store-POS-System/administration/stock_hq.php");
                exit(0);
            } else {
                $_SESSION['message'] = "Transfer Failed.";
                header("Location:http://localhost/Computer-Store-POS-System/administration/stock_hq.php");
                exit(0);
            }
        } else {
            mysqli_query($connect, $to_sql);

            if ($sql_run) {
                $_SESSION['message'] = "Transfer successfully.";
                header("Location:http://localhost/Computer-Store-POS-System/administration/stock_hq.php");
                exit(0);
            } else {
                $_SESSION['message'] = "Transfer Failed.";
                header("Location:http://localhost/Computer-Store-POS-System/administration/stock_hq.php");
                exit(0);
            }
        }
    }
}
?>