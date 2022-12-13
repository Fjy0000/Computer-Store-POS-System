<?php
require ($_SERVER['DOCUMENT_ROOT'] . '/Computer-Store-POS-System/administration/dbconnect.php');

$star0 = $star1 = $star2 = $star3 = $star4 = $star5 = 0;
if (isset($_GET['id'])) {
    $productID = $_GET['id'];
    $sql1 = "SELECT * FROM product WHERE product_id='$productID'";
    $result1 = mysqli_query($connect, $sql1);

    $sql2 = "SELECT * FROM rating WHERE pid='$productID'";
    $result2 = mysqli_query($connect, $sql2);

    if (mysqli_num_rows($result2) > 0) {
        foreach ($result2 as $countRate) {
            if ($countRate['rate'] == 0) {
                $star0++;
            }
            if ($countRate['rate'] == 1) {
                $star1++;
            }
            if ($countRate['rate'] == 2) {
                $star2++;
            }
            if ($countRate['rate'] == 3) {
                $star3++;
            }
            if ($countRate['rate'] == 4) {
                $star4++;
            }
            if ($countRate['rate'] == 5) {
                $star5++;
            }
        }
    }
    if (mysqli_num_rows($result1) > 0) {
        $currentProduct = mysqli_fetch_array($result1);
    }
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>product view</title>
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
                    <h1 class="mt-4">Product's Detail</h1>
                    <div class="card mb-4">
                        <div class="card-header bg-dark">
                            <button type="button" onclick="history.back()" class="btn btn-primary float-end">Back</button>
                        </div>
                        <section class="section about-section gray-bg" id="about">
                            <div class="container">
                                <div class="row align-items-center flex-row-reverse">
                                    <div class="col-lg-6">
                                        <div class="about-text go-to">
                                            <h3>Product Name</h3>
                                            <h5><?php echo $currentProduct['name']; ?></h5>
                                            <hr>
                                            <h5>Description</h5>
                                            <p><?php echo $currentProduct['description']; ?></p>
                                            <hr>
                                            <div class="row about-list">
                                                <div class="col-md-6">
                                                    <div>
                                                        <label>Product ID</label>
                                                        <p><?php echo $currentProduct['product_id']; ?></p>
                                                    </div>
                                                    <div>
                                                        <label>Price (RM)</label>
                                                        <p>RM &nbsp; <?php echo $currentProduct['price']; ?></p>
                                                    </div>
                                                    <div>
                                                        <label>Quantity</label>
                                                        <p><?php echo $currentProduct['quantity']; ?></p>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div>
                                                        <label>Store Name</label>
                                                        <p><?php echo $currentProduct['store_name']; ?></p>
                                                    </div>
                                                    <div>
                                                        <label>Locate Store</label>
                                                        <p><?php echo $currentProduct['store_type']; ?></p>
                                                    </div>
                                                    <div>
                                                        <label>Category</label>
                                                        <p><?php echo $currentProduct['category_name']; ?></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="about-avatar">
                                            <img src="<?php echo '/Computer-Store-POS-System/client/images/' . $currentProduct['image']; ?> " width="521" height="521">
                                        </div>
                                    </div>
                                </div>
                                <div class="counter">
                                    <div class="row">
                                        <div class="col-6 col-lg-2">
                                            <div class="text-center">
                                                <h6 class="h2"><?php echo $star5; ?></h6>
                                                <p>5 Star</p>
                                            </div>
                                        </div>
                                        <div class="col-6 col-lg-2">
                                            <div class="text-center">
                                                <h6 class="h2"><?php echo $star4; ?></h6>
                                                <p>4 Star</p>
                                            </div>
                                        </div>
                                        <div class="col-6 col-lg-2">
                                            <div class="text-center">
                                                <h6 class="h2" ><?php echo $star3; ?></h6>
                                                <p>3 Star</p>
                                            </div>
                                        </div>
                                        <div class="col-6 col-lg-2">
                                            <div class="text-center">
                                                <h6 class="h2" ><?php echo $star2; ?></h6>
                                                <p>2 Star</p>
                                            </div>
                                        </div>
                                        <div class="col-6 col-lg-2">
                                            <div class="text-center">
                                                <h6 class="h2"><?php echo $star1; ?></h6>
                                                <p>1 Star</p>
                                            </div>
                                        </div>
                                        <div class="col-6 col-lg-2">
                                            <div class="text-center">
                                                <h6 class="h2"><?php echo $star0; ?></h6>
                                                <p>0 Star</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <i class="bi bi-table"></i>
                            Transfer Product Record
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Product Name</th>
                                        <th scope="col">From Store</th>
                                        <th scope="col">Qunatity</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $count_num = 0;
                                    $get_transfer_store = $currentProduct['store_name'];
                                    $get_transfer_product = $currentProduct['name'];
                                    $sql3 = "SELECT * FROM transfer_product WHERE to_store='$get_transfer_store' AND product_name='$get_transfer_product' ";
                                    $result3 = mysqli_query($connect, $sql3);
                                    if (mysqli_num_rows($result3) > 0) {
                                        foreach ($result3 as $transfer_records) {
                                            $count_num++;
                                            ?>
                                            <tr>
                                                <th scope="row"><?php echo $count_num; ?></th>
                                                <td><?php echo $transfer_records['product_name']; ?></td>
                                                <td><?php echo $transfer_records['from_store']; ?></td>
                                                <td><?php echo $transfer_records['quantity']; ?></td>
                                            </tr>
                                            <?php
                                        }
                                    } else {
                                        echo "<h5 class='text-primary'>No Record Found.....</h5>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </body>
</html>
