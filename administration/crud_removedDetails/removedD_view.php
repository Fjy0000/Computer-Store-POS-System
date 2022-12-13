<?php
require ($_SERVER['DOCUMENT_ROOT'] . '/Computer-Store-POS-System/administration/dbconnect.php');

if (isset($_GET['id'])) {
    $removedID = $_GET['id'];
    $sql = "SELECT * FROM removed_detail WHERE removed_id='$removedID'";
    $result = mysqli_query($connect, $sql);

    if (mysqli_num_rows($result) > 0) {
        $currentRemoveDetails = mysqli_fetch_array($result);
    }
}
?>
<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>View Remove Product Quantity</title>
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
                    <h1 class="mt-4">Remove Product's Quantity Details</h1>
                    <div class="card mb-4">
                        <div class="card-header bg-dark">
                            <button type="button" onclick="history.back()" class="btn btn-primary float-end">Back</button>
                        </div>
                        <section>
                            <div class="container">
                                <div class="row align-items-center">
                                    <div>
                                        <h5>Remove ID</h5>
                                        <p><?php echo $currentRemoveDetails['removed_id']; ?></p>
                                        <hr>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div>
                                                    <h5>Product ID</h5>
                                                    <p><?php echo $currentRemoveDetails['product_id']; ?></p>
                                                </div>
                                                <div>
                                                    <h5>Product Name</h5>
                                                    <p><?php echo $currentRemoveDetails['product_name']; ?></p>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div>
                                                    <h5>Store ID</h5>
                                                    <p><?php echo $currentRemoveDetails['store_id']; ?></p>
                                                </div>
                                                <div>
                                                    <h5>Store Name</h5>
                                                    <p><?php echo $currentRemoveDetails['store_name']; ?></p>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <h5>Reason</h5>
                                        <p><?php echo $currentRemoveDetails['reason']; ?></p>
                                        <hr>
                                        <div>
                                            <h5>Quantity</h5>
                                            <p><?php echo $currentRemoveDetails['quantity']; ?></p>
                                        </div>
                                        <div>
                                            <h5>Removed Date</h5>
                                            <p><?php echo $currentRemoveDetails['removed_date']; ?></p>
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
