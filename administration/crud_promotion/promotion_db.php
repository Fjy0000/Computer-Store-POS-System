<?php

//Define empty error message
$currentPromo = $titleErr = $expiryDateErr = $descriptionErr = $promoCodeErr = $discountRateErr = $positionErr = $userNameErr = $passwordErr = $cPasswordErr = $keyErr = "";

//Define Description of function
$f_Desc1 = "This page is the create promotion page and in here you can create and add a new promotion.";
$f_Desc2 = "This page is the update promotion page and in here you can update a promotion details.";

//Create Promotion
if (isset($_POST['create_promotion'])) {

    $title = $_POST['title'];
    $description = $_POST['description'];
    $promoCode = $_POST['promoCode'];
    $expiryDate = $_POST['expiryDate'];
    $discountRate = $_POST['discountRate'];
    
     //session value to keep input value after vaildation get error message
    $_SESSION['promo_input_title'] = $title;
    $_SESSION['promo_input_description'] = $description;
    $_SESSION['promo_input_code'] = $promoCode;
    $_SESSION['promo_input_expirydate'] = $expiryDate;
    $_SESSION['promo_input_discountrate'] = $discountRate;

    if (empty($title)) {
        $titleErr = "Promotion Title field cannot be left blank";
    } elseif (!empty($title) && strlen($title) < 5) {
        $titleErr = "Promotion tilte must be at least 5 letter.";
    }
    if (empty($description)) {
        $descriptionErr = "Promotion description field cannot be left blank";
    }
    if (empty($promoCode)) {
        $promoCodeErr = "Promotion code field cannot be left blank";
    } elseif (!empty($promoCode) && strlen($promoCode) < 5) {
        $promoCodeErr = "Promotion Code require at least 5 letter.";
    }
    if (empty($expiryDate)) {
        $expiryDateErr = "Promotion expiry date field cannot be left blank";
    }
    if (empty($discountRate)) {
        $discountRateErr = "Promotion discount rate field cannot be left blank";
    }

    if (empty($titleErr) && empty($descriptionErr) && empty($promoCodeErr) && empty($expiryDateErr) && empty($discountRateErr)) {

        $sql1 = "INSERT INTO promotion(title, description, promo_code, expiry_date, discount_rate) "
                . "VALUES ('$title','$description','$promoCode','$expiryDate','$discountRate')";

        $sql_run = mysqli_query($connect, $sql1);
        if ($sql_run) {
            $_SESSION['message'] = "Created Successfully";
            header("Location:http://localhost/Computer-Store-POS-System/administration/promotion.php");
            exit(0);
        } else {
            $_SESSION['error'] = "Create Fail ! ! ";
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

     if (empty($title)) {
        $titleErr = "Promotion Title field cannot be left blank";
    } elseif (!empty($title) && strlen($title) < 5) {
        $titleErr = "Promotion tilte must be at least 5 letter.";
    }
    if (empty($description)) {
        $descriptionErr = "Promotion description field cannot be left blank";
    }
    if (empty($promoCode)) {
        $promoCodeErr = "Promotion code field cannot be left blank";
    } elseif (!empty($promoCode) && strlen($promoCode) < 5) {
        $promoCodeErr = "Promotion Code require at least 5 letter.";
    }
    if (empty($expiryDate)) {
        $expiryDateErr = "Promotion expiry date field cannot be left blank";
    }
    if (empty($discountRate)) {
        $discountRateErr = "Promotion discount rate field cannot be left blank";
    }

    if (empty($titleErr) && empty($descriptionErr) && empty($promoCodeErr) && empty($expiryDateErr) && empty($discountRateErr)) {

        $sql3 = "UPDATE promotion SET title='$title',description='$description',"
                . "promo_code='$promoCode',expiry_date='$expiryDate',discount_rate='$discountRate' WHERE promo_id='$id'";

        $sql_run = mysqli_query($connect, $sql3);
        if ($sql_run) {
            $_SESSION['message'] = "Updated Successfully";
            header("Location:http://localhost/Computer-Store-POS-System/administration/promotion.php");
            exit(0);
        } else {
            $_SESSION['error'] = "Update fail ! ! System connect to database or query error.";
            header("Location:http://localhost/Computer-Store-POS-System/administration/promotion.php");
            exit(0);
        }
    } else {
        $_SESSION['error'] = "Update Fail ! Reason: <br>"
                . "$titleErr <br>"
                . "$descriptionErr <br>"
                . "$promoCodeErr <br>"
                . "$expiryDateErr <br>"
                . "$discountRateErr";
        header("Location:http://localhost/Computer-Store-POS-System/administration/promotion.php");
        exit(0);
    }
}
?>
 