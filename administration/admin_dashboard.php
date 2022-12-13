<?php
require 'dbconnect.php';

$sql = "SELECT * FROM product ";
$result = mysqli_query($connect, $sql);
if (!$result) {
    die("Invalid query:" . $connect->error);
}

include 'static-include/header.php';
include 'static-nav/static-headnav.php';
include 'static-nav/static-sidenav.php';
?>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <?php include 'alertMessage.php'; ?>
            <h1 class="mt-4">Dashboard</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">HQ Dashboard</li>
            </ol>
            <div class="row">
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-primary text-white mb-4">
                        <div class="card-body">Staff Account Maintenance</div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="staff.php">View Details</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-primary text-white mb-4">
                        <div class="card-body">Stock Maintenance</div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="stock_hq.php">View Details</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-primary text-white mb-4">
                        <div class="card-body">Store Maintenance</div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="store.php">View Details</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-primary text-white mb-4">
                        <div class="card-body">Promotion Maintenance</div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="promotion.php">View Details</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mb-4">
                <div class="card-header">
                    <i class="bi bi-table"></i>
                    Inventory Table
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Product Name</th>
                                <th>Store Name</th>
                                <th>Category Name</th>
                                <th>Quantity</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (mysqli_num_rows($result) > 0) {
                                foreach ($result as $product) {
                                    ?>
                                    <tr>
                                        <td><?php echo $product["product_id"]; ?></td>
                                        <td><?php echo $product["name"]; ?></td>
                                        <td><?php echo $product["store_name"]; ?> </td>
                                        <td><?php echo $product["category_name"]; ?></td>
                                        <td><?php echo $product["quantity"]; ?></td>
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
    <?php include 'static-nav/static-footer.html'; ?>
</div>
<?php include 'static-include/footer.php'; ?>

