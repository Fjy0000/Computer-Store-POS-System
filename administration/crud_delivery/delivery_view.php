<?php
require ($_SERVER['DOCUMENT_ROOT'] . '/Computer-Store-POS-System/administration/dbconnect.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM orders WHERE id='$id'";
    $result = mysqli_query($connect, $sql);

    if (mysqli_num_rows($result) > 0) {
        $currentOrders = mysqli_fetch_array($result);
    }
}
?>
<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>View Order</title>
        <link href="http://localhost/Computer-Store-POS-System/administration/css/styles.css" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
        <!-- CSS only -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
        <!-- JavaScript Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
        <script src="http://localhost/Computer-Store-POS-System/administration/js/scripts.js"></script>
    </head>
    <body>
        <?php
        include ($_SERVER['DOCUMENT_ROOT'] . '/Computer-Store-POS-System/administration/static-nav/static-headnav.php');
        include ($_SERVER['DOCUMENT_ROOT'] . '/Computer-Store-POS-System/administration/static-nav/static-sidenav.php');
        ?>

        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Customer Order Details</h1>
                    <div class="card mb-4">
                        <div class="card-header bg-dark">
                            <a href="http://localhost/Computer-Store-POS-System/administration/delivery.php" class="btn btn-primary float-end">Back</a>
                        </div>
                        <section>
                            <div class="container">
                                <div class="row align-items-center">
                                    <div>
                                        <h5>Order ID</h5>
                                        <p><?php echo $currentOrders['id']; ?></p>
                                        <hr>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div>
                                                    <h5>Customer Name</h5>
                                                    <p><?php echo $currentOrders['name']; ?></p>
                                                </div>
                                                <div>
                                                    <h5>Customer Phone Number</h5>
                                                    <p><?php echo $currentOrders['number']; ?></p>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div>
                                                    <h5>Customer Email</h5>
                                                    <p><?php echo $currentOrders['email']; ?></p>
                                                </div>
                                                <div>
                                                    <h5>Paid Method</h5>
                                                    <p><?php echo $currentOrders['method']; ?></p>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <h5>Customer Address</h5>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div>
                                                    <h6>Flat</h6>
                                                    <p><?php echo $currentOrders['flat']; ?></p>
                                                </div>
                                                <div>
                                                    <h6>Street</h6>
                                                    <p><?php echo $currentOrders['street']; ?></p>
                                                </div>
                                                <div>
                                                    <h6>City</h6>
                                                    <p><?php echo $currentOrders['city']; ?></p>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div>
                                                    <h6>State</h6>
                                                    <p><?php echo $currentOrders['state']; ?></p>
                                                </div>
                                                <div>
                                                    <h6>Country</h6>
                                                    <p><?php echo $currentOrders['country']; ?></p>
                                                </div>
                                                <div>
                                                    <h6>Postal Code</h6>
                                                    <p><?php echo $currentOrders['postal_code']; ?></p>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div>
                                            <h5>Ordered Product</h5>
                                            <p><?php echo $currentOrders['total_product']; ?></p>
                                        </div>
                                        <div>
                                            <h5>Total Amount</h5>
                                            <p><?php echo $currentOrders['total_price']; ?></p>
                                        </div>
                                        <div>
                                            <h5>Delivery Mode</h5>
                                            <p><?php
                                                if (empty($currentOrders['delivery_mode'])) {
                                                    echo "null";
                                                } else {
                                                    echo $currentOrders['delivery_mode'];
                                                }
                                                ?></p>
                                        </div>
                                        <div>
                                            <h5>Store Send Product</h5>
                                            <p><?php
                                                if (empty($currentOrders['store_send'])) {
                                                    echo "null";
                                                } else {
                                                    echo $currentOrders['store_send'];
                                                }
                                                ?></p>
                                        </div>
                                        <div>
                                            <h5>Delivery Status</h5>
                                            <p><?php
                                                if (empty($currentOrders['delivery_status'])) {
                                                    echo 'null';
                                                } else {
                                                    echo $currentOrders['delivery_status'];
                                                }
                                                ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </main>
        </div>
    </body>
</html>
