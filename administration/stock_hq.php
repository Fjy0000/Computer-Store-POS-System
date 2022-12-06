<?php
require 'dbconnect.php';
require 'crud_product/product_db.php';

$sql = "SELECT * FROM product WHERE store_type='Headquarter' ";
$query1 = "SELECT * FROM store";
$query2 = "SELECT DISTINCT name FROM product ";

$result = mysqli_query($connect, $sql);
$get1 = mysqli_query($connect, $query1);
$get2 = mysqli_query($connect, $query2);

if (!$result || !$get1 || !$get2) {
    die("Invalid query:" . $connect->error);
}


include 'static-include/header.php';
require 'static-nav/static-headnav.php';
require 'static-nav/static-sidenav.php';
?>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">

            <?php include 'alertMessage.php'; ?>

            <h1 class="mt-4">HQ Stock Manage</h1>
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    HQ Stock Table
                    <a href="crud_product/product_create.php" class="btn btn-primary float-end m-md-2">Add New Product</a>

                    <button type="button" class="btn btn-primary m-md-2 float-end" data-bs-toggle="modal" data-bs-target="#transferToModal">Transfer to<i class="bi bi-arrow-left-right  m-md-2"></i></button>
                    <?php include"crud_product/transferTo.php"; ?>

                    <div class="dropdown float-end">
                        <button type="button" class="btn btn-primary dropdown-toggle m-md-2" data-bs-toggle="dropdown">Export</button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="#"><i class="bi bi-filetype-xlsx m-md-2"></i>Export Excel</a>
                        </div>
                    </div>
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
                                        <td>
                                            <a class='btn btn-info' href="crud_product/product_view.php?id=<?php echo $product["product_id"]; ?>">View</a>
                                            <a class='btn btn-warning' href="crud_product/product_update.php?id=<?php echo $product["product_id"]; ?>">Update</a>
                                            <form method="POST" action="stock_hq.php" class="d-inline">
                                                <input type="hidden" name="delete_id" value="<?php echo $product["product_id"]; ?>">
                                                <button type="submit" class="btn btn-danger" name="delete_product">Delete</button>
                                            </form>
                                        </td>
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
<?php include 'static-include/footer.php'; ?>
