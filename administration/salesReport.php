<?php
require 'dbconnect.php';

$sql = "SELECT * FROM orders";
$query1 = "SELECT * FROM store";

$result = mysqli_query($connect, $sql);
$get1 = mysqli_query($connect, $query1);

if (!$result || !$get1) {
    die("Invalid query:" . $connect->error);
}

$storeErr = $productErr ="";
$questionStr = "Select the store to generate that store sold product is required";




include 'static-include/header.php';
require 'static-nav/static-headnav.php';
require 'static-nav/static-sidenav.php';
?>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">

            <?php include 'alertMessage.php'; ?>

            <h1 class="mt-4">Sales Report</h1>
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Order Table

                    <div class="dropdown float-end">
                        <button type="button" class="btn btn-primary dropdown-toggle m-md-2" data-bs-toggle="dropdown">Export</button>
                        <div class="dropdown-menu">
                            <button type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#reportModal"><i class="bi bi-filetype-pdf m-md-2"></i>PDF</button>
                        </div>
                    </div>
                    <div class="modal fade" id="reportModal" tabindex="-1" role="dialog" aria-labelledby="reportModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="reportModalLabel">Sales Report</h5>
                                    <span aria-hidden="true" data-bs-dismiss="modal" aria-label="Close"><i class="bi bi-x-lg"></i></span>
                                </div>
                                <div>
                                    <i class="bi bi-question-circle float-end" style="font-size: 18px" data-bs-toggle="popover" title="Requirement:" data-bs-content="<?php echo $questionStr ?>"></i>
                                </div>
                                <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                                    <div class="modal-body">
                                        <div class="form-group mb-3">
                                            <label>Store</label><span style="color: #dc3545">&nbsp;&nbsp; *<?php echo $storeErr; ?></span>
                                            <select class="form-select" aria-label="Store list" name="storeName" id="storeName">
                                                <option selected value="">- Select Store -</option>
                                                <?php
                                                if (mysqli_num_rows($get1) > 0) {
                                                    foreach ($get1 as $store) {
                                                        ?>
                                                        <option value="<?php echo $store['name']; ?>"><?php echo $store['name']; ?></option>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary" name="generate">Confirm Generate</button>
                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Order ID</th>
                                    <th>Product Name</th>
                                    <th>Store Name</th>
                                    <th>Total Price (RM)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (mysqli_num_rows($result) > 0) {
                                    foreach ($result as $order) {
                                        ?>
                                        <tr>
                                            <td><?php echo $order["id"]; ?></td>
                                            <td><?php echo $order["total_product"]; ?></td>
                                            <td><?php echo $order["store_send"]; ?> </td>
                                            <td><?php echo $order["total_price"]; ?></td>
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
</script>
<?php include 'static-include/footer.php'; ?>
