<?php

//Define empty error message
$currentPromo = $titleErr = $expiryDateErr = $descriptionErr = $promoCodeErr = $discountRateErr = $positionErr = $userNameErr = $passwordErr = $cPasswordErr = $keyErr = "";

//Define information of requirement
$questionStr = "1. All fields are required.";

//Create Promotion
if (isset($_POST['create_promotion'])) {

    $title = $_POST['title'];
    $description = $_POST['description'];
    $promoCode = $_POST['promoCode'];
    $expiryDate = $_POST['expiryDate'];
    $discountRate = $_POST['discountRate'];

    if (empty($title)) {
        $titleErr = "Required.";
    } elseif (!empty($title) && strlen($title) < 5) {
        $titleErr = "Promotion tilte must be at least 5 letter.";
    }
    if (empty($description)) {
        $descriptionErr = "Required.";
    }
    if (empty($promoCode)) {
        $promoCodeErr = "Required.";
    } elseif (!empty($promoCode) && strlen($promoCode) < 5) {
        $userNameErr = "Promotion Code require at least 5 letter.";
    }

    if (empty($expiryDate)) {
        $expiryDateErr = "Required.";
    }

    if (empty($discountRate)) {
        $discountRateErr = "Required.";
    }

    if (empty($titleErr) && empty($descriptionErr) && empty($promoCodeErr) && empty($expiryDateErr) && empty($discountRateErr)) {

        $sql1 = "INSERT INTO promotion(title, description, promo_code, expiry_date, discount_rate) "
                . "VALUES ('$title','$description','$promoCode','$expiryDate','$discountRate')";

        $sql_run = mysqli_query($connect, $sql1);
        if ($sql_run) {
            $_SESSION['message'] = "Created successfully.";
            header("Location:http://localhost/Computer-Store-POS-System/administration/promotion.php");
            exit(0);
        } else {
            $_SESSION['message'] = "Creating Failed.";
            header("Location:http://localhost/Computer-Store-POS-System/administration/promotion.php");
            exit(0);
        }
    }
}


//Update Promotion
if (isset($_POST['update_promotion'])) {

    $id = $_POST['id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $promoCode = $_POST['promoCode'];
    $expiryDate = $_POST['expiryDate'];
    $discountRate = $_POST['discountRate'];

    $sql3 = "UPDATE promotion SET title='$title',description='$description',"
            . "promo_code='$promoCode',expiry_date='$expiryDate',discount_rate='$discountRate' WHERE promo_id='$id'";

    $sql_run = mysqli_query($connect, $sql3);
    if ($sql_run) {
        $_SESSION['message'] = "Updated successfully.";
        header("Location:http://localhost/Computer-Store-POS-System/administration/promotion.php");
        exit(0);
    } else {
        $_SESSION['message'] = "Updating Failed.";
        header("Location:http://localhost/Computer-Store-POS-System/administration/promotion.php");
        exit(0);
    }
}

//Delete Promotion
if (isset($_POST['delete_promotion'])) {

    $id = $_POST['delete_id'];

    $sql4 = "DELETE FROM promotion WHERE promo_id='$id'";
    $sql_run = mysqli_query($connect, $sql4);
    if ($sql_run) {
        $_SESSION['message'] = "Deleted successfully.";
        header("Location:http://localhost/Computer-Store-POS-System/administration/promotion.php");
        exit(0);
    } else {
        $_SESSION['message'] = "Delete Failed.";
        header("Location:http://localhost/Computer-Store-POS-System/administration/promotion.php");
        exit(0);
    }
}
?>
 