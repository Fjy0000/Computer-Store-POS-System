<?php
require 'dbconnect.php';

$error1 = $error2 = $error3 = $error4 = "";

if (isset($_POST['confirm'])) {

    $name = $_POST['inputName'];
    $phone = $_POST['inputPhone'];
    $email = $_POST['inputEmail'];
    $orderid = $_POST['inputOrderId'];
    $s = "Received";

    if (empty($name)) {
        $error3 = "Required";
    }
    if (empty($orderid)) {
        $error1 = "Required";
    }
    if (empty($email)) {
        $error2 = "Required";
    }
    if (empty($phone)) {
        $error4 = "Required";
    } elseif (!empty($phone)) {
        if (strlen($phone) < 10 || strlen($phone) > 13) {
            $error4 = "Staff phone number must be real";
        } else {
            if (!preg_match("/^[0-9]*$/", $phone)) {
                $error4 = "Only numbers are allowed";
            }
        }
    }

    if (empty($error1) && empty($error2) && empty($error3) && empty($error4)) {
        $query_get = "SELECT * FROM orders WHERE id='$orderid' AND email='$email' AND number='$phone' AND name='$name' ";
        $query_update = "UPDATE orders SET delivery_status='$s' WHERE id='$orderid' ";
        $check = mysqli_query($connect, $query_get);
        if (mysqli_num_rows($check) == 1) {
            $row = mysqli_fetch_assoc($check);
            if ($row['id'] == $orderid && $row['name'] == $name && $row['email'] == $email && $row['number'] == $phone) {
                $update = mysqli_query($connect, $query_update);
                if ($update) {
                    $_SESSION['message'] = "Your order is confirm received.";
                    header("Location:http://localhost/Computer-Store-POS-System/administration/customer_recevied_order.php");
                    exit(0);
                } else {
                    $_SESSION['message'] = "Failed.";
                    header("Location:http://localhost/Computer-Store-POS-System/administration/customer_recevied_order.php");
                    exit(0);
                }
            } else {
                $_SESSION['message'] = "Not Found Your Order ID";
                header("Location:http://localhost/Computer-Store-POS-System/administration/customer_recevied_order.php");
                exit(0);
            }
        }
    } else {
        $_SESSION['message'] = "Invalid input please try again !";
        header("Location:http://localhost/Computer-Store-POS-System/administration/customer_recevied_order.php");
        exit(0);
    }
}
?>
<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Customer - Confirm Recevied Order</title>
        <link href="http://localhost/Computer-Store-POS-System/administration/css/styles.css" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
        <!-- CSS only -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
        <!-- JavaScript Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
        <script src="http://localhost/Computer-Store-POS-System/administration/js/scripts.js"></script>
    </head>

    <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <?php include 'alertMessage.php'; ?>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Customer - Confirm Recevied Order</h3></div>
                                    <div class="card-body">

                                        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                                            <div class="form-group mb-3">
                                                <label>Order ID</label><span style="color: #dc3545">&nbsp;&nbsp; *<?php echo $error1; ?></span>
                                                <input class="form-control" name="inputOrderId" id="inputOrderId" type="text"/>
                                            </div>
                                            <div class="form-group mb-3">
                                                <label>Your Email</label><span style="color: #dc3545">&nbsp;&nbsp; *<?php echo $error2; ?></span>
                                                <input class="form-control" name="inputEmail" id="inputEmail" type="email"/>
                                            </div>
                                            <div class="form-group mb-3">
                                                <label>Your Name</label><span style="color: #dc3545">&nbsp;&nbsp; *<?php echo $error3; ?></span>
                                                <input class="form-control" name="inputName" id="inputName" type="text"/>
                                            </div>
                                            <div class="form-group mb-3">
                                                <label>Your Phone Number</label><span style="color: #dc3545">&nbsp;&nbsp; *<?php echo $error4; ?></span>
                                                <input class="form-control" name="inputPhone" id="inputPhone" type="text"/>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                                <button type="submit" class="btn btn-primary" name="confirm">Confirm</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <?php include 'static-nav/static-footer.html'; ?>
        </div>
        <?php include'static-include/footer.php'; ?>
