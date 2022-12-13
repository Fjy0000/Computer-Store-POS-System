<?php
require 'dbconnect.php';
require 'crud_product/product_db.php';
require 'exportExcel.php';

$sql = "SELECT * FROM product WHERE store_type='Headquarters' ";
$query1 = "SELECT * FROM store";
$query2 = "SELECT DISTINCT name FROM product ";

$result = mysqli_query($connect, $sql);
$get1 = mysqli_query($connect, $query1);
$get2 = mysqli_query($connect, $query2);

if (!$result || !$get1 || !$get2) {
    die("Invalid query:" . $connect->error);
}

//Remove session value of input field in create page
unset($_SESSION['product_input_name'],
        $_SESSION['product_input_description'],
        $_SESSION['product_input_price'],
        $_SESSION['product_input_quantity']
);

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
                    <!-- Transfer to modal  -->
                    <div class="modal fade" id="transferToModal" tabindex="-1" role="dialog" aria-labelledby="transferModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="transferModalLabel">Transfer To Another Store</h5>
                                    <span aria-hidden="true" data-bs-dismiss="modal" aria-label="Close"><i class="bi bi-x-lg"></i></span>
                                </div>
                                <div>
                                    <i class="bi bi-question-circle float-end" style="font-size: 18px" data-bs-toggle="popover" title="Description:" data-bs-content="<?php echo $f_Desc3; ?>"></i>
                                    <span style="color: #dc3545">&nbsp;&nbsp; * = Required</span>
                                </div>
                                <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                                    <div class="modal-body">
                                        <div class="form-group mb-3">
                                            <label>From</label><span style="color: #dc3545">&nbsp;&nbsp; *</span>
                                            <select class="form-select" aria-label="from store" name="fromStoreId" id="fromStoreId">
                                                <option selected value="">- Select Store -</option>
                                                <?php
                                                if (mysqli_num_rows($get1) > 0) {
                                                    foreach ($get1 as $fromStore) {
                                                        ?>
                                                        <option value="<?php echo $fromStore['store_id']; ?>"><?php echo $fromStore['name']; ?></option>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label>To</label><span style="color: #dc3545">&nbsp;&nbsp; *</span>
                                            <select class="form-select" aria-label="to store" name="toStoreId" id="toStoreId">
                                                <option selected value="">- Select Store -</option>
                                                <?php
                                                if (mysqli_num_rows($get1) > 0) {
                                                    foreach ($get1 as $toStore) {
                                                        ?>
                                                        <option value="<?php echo $toStore['store_id']; ?>"><?php echo $toStore['name']; ?></option>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label>Product Name</label><span style="color: #dc3545">&nbsp;&nbsp; *</span>
                                            <select class="form-select" aria-label="Product list" name="product" id="product">
                                                <option selected value="">- Select Product -</option>
                                                <?php
                                                if (mysqli_num_rows($get2) > 0) {
                                                    foreach ($get2 as $t_product) {
                                                        ?>
                                                        <option value="<?php echo $t_product['name']; ?>"><?php echo $t_product['name']; ?></option>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label>Quantity</label><span style="color: #dc3545">&nbsp;&nbsp; *</span>
                                            <input type="number" min="0" class="form-control" name="transferQuantity">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-danger" name="transfer_product">Confirm Transfer</button>
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="dropdown float-end">
                        <button type="button" class="btn btn-primary dropdown-toggle m-md-2" data-bs-toggle="dropdown">Export</button>
                        <form action="stock_hq.php" method="POST">
                            <div class="dropdown-menu">
                                <button type="submit" class="dropdown-item" name="generate_hq"><i class="bi bi-filetype-xlsx m-md-2"></i>Export Excel</button>
                            </div>
                        </form>
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
                                            <button type="button" class="btn btn-danger delete_product" id="<?php echo $product["product_id"]; ?>">Delete</button>
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
<script>
    //popover
    var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'));
    var popoverList = popoverTriggerList.map(function (t) {
        return new bootstrap.Popover(t);
    });

    //delete stock confirmation
    $(document).on('click', '.delete_product', function () {
        var id = $(this).attr('id');
        if (confirm("Are you sure you want to delete this product whole information ? ")) {
            $.ajax({
                url: "crud_product/product_delete.php",
                method: "POST",
                data: {id: id},
                success: function (data) {
                    location.reload(true);
                }
            })
        }
    });
</script>
</body>
</html>
