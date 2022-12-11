<?php
require 'dbconnect.php';

$error1 = $error2 = $error3 = $error4 = "";

if (isset($_GET['id'])) {
    $s = "Received";
    $order_id = $_GET['id'];

    $show_order = "SELECT * FROM orders WHERE id='$order_id' ";
    $order_receive = mysqli_query($connect, $show_order);

    if (isset($_POST['confirm'])) {
        $id = $_POST['customer_order_id'];
        $query_update = "UPDATE orders SET delivery_status='$s' WHERE id='$id' ";
        $update = mysqli_query($connect, $query_update);

        if ($update) {
            $_SESSION['message'] = "Your order is record at received.";
        }
    }
} else {
    echo 'Thank you for your select our store.';
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

                                    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                                        <div class="card-body">
                                            <?php
                                            if (mysqli_num_rows($order_receive) == 1) {
                                                $row = mysqli_fetch_assoc($order_receive);
                                                ?>
                                                <div class="form-group mb-3">
                                                    <p><strong>Order ID</strong></p>
                                                    <p><?php echo $row['id']; ?></p>
                                                </div>
                                                <div class="form-group mb-3">
                                                    <p><strong>Customer Name</strong></p>
                                                    <p><?php echo $row['name']; ?></p>
                                                </div>
                                                <div class="form-group mb-3">
                                                    <p><strong>Customer Phone No</strong></p>
                                                    <p><?php echo $row['number']; ?></p>
                                                </div>
                                                <div class="form-group mb-3">
                                                    <p><strong>Product</strong></p>
                                                    <p><?php echo $row['total_product']; ?></p>
                                                </div>
                                                <div class="form-group mb-3">
                                                    <p><strong>Total Amount</strong></p>
                                                    <p><?php echo $row['total_price']; ?></p>
                                                </div>
                                                <?php
                                            }
                                            ?>
                                            <div class="card-footer">
                                                <input type="hidden" name="customer_order_id" class="form-control" value="<?php echo $row['id']; ?>">
                                                <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                                    <button type="submit" class="btn btn-primary" name="confirm">Confirm</button>
                                                </div>           
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <?php include 'static-nav/static-footer.html'; ?>
        </div>
        <?php include'static-include/footer.php'; ?>
