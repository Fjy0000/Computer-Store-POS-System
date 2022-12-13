<?php
require 'dbconnect.php';
require 'crud_delivery/delivery_db.php';

$sql = "SELECT * FROM orders";
$sql1 = "SELECT * FROM store";

$result = mysqli_query($connect, $sql);
$result1 = mysqli_query($connect, $sql1);

if (!$result || !$result1) {
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
            <h1 class="mt-4">Sales Delivery Manage</h1>
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Delivery Table
                    <button type="button" class="btn btn-warning m-md-2 float-end" data-bs-toggle="modal" data-bs-target="#deliveryModal">Delivery Manage</button>
                    <!-- Delivery assign store to send modal -->
                    <div class="modal fade" id="deliveryModal" tabindex="-1" role="dialog" aria-labelledby="deliveryModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deliveryModalLabel">Delivery Manage</h5>
                                    <span aria-hidden="true" data-bs-dismiss="modal" aria-label="Close"><i class="bi bi-x-lg"></i></span>
                                </div>
                                <div>
                                    <i class="bi bi-question-circle float-end" data-bs-toggle="popover" title="Requirement:" data-bs-content="<?php echo $f_Desc1; ?>"></i>
                                </div>
                                <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                                    <div class="modal-body">
                                        <div class="form-group mb-3">
                                            <label>Order ID</label><span class="text-danger">&nbsp;&nbsp; * &nbsp;<?php echo $id_error; ?></span>
                                            <select class="form-select" aria-label="order list" name="order_id" id="order_id">
                                                <option selected value="">- Select Order ID -</option>
                                                <?php
                                                if (mysqli_num_rows($result) > 0) {
                                                    foreach ($result as $order) {
                                                        ?>
                                                        <option value="<?php echo $order['id']; ?>"><?php echo $order['id']; ?></option>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label>Store To Send</label><span class="text-danger">&nbsp;&nbsp; * &nbsp;<?php echo $store_send_error; ?></span>
                                            <select class="form-select" aria-label="store list" name="store_send" id="store_send">
                                                <option selected value="">- Select Store -</option>
                                                <?php
                                                if (mysqli_num_rows($result1) > 0) {
                                                    foreach ($result1 as $store) {
                                                        ?>
                                                        <option value="<?php echo $store['name']; ?>"><?php echo $store['name']; ?></option>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label>Delivery Status</label><span class="text-danger">&nbsp;&nbsp; * &nbsp;<?php echo $delivery_status_error; ?></span>
                                            <select class="form-select" aria-label="delivery list" name="delivery" id="delivery">
                                                <option selected value="">- Select Delivery Status -</option>
                                                <option value="Packaging">Packaging</option>
                                                <option value="Delivering">Delivering</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary" name="assign_delivery">Confirm</button>
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Customer Name</th>
                                <th>Customer Street</th>
                                <th>Customer City</th>
                                <th>Customer State</th>
                                <th>Delivery Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (mysqli_num_rows($result) > 0) {
                                foreach ($result as $delivery) {
                                    ?>
                                    <tr>
                                        <td><?php echo $delivery["id"]; ?></td>
                                        <td><?php echo $delivery["name"]; ?></td>
                                        <td><?php echo $delivery["street"]; ?></td>
                                        <td><?php echo $delivery["city"]; ?></td>
                                        <td><?php echo $delivery["state"]; ?></td>
                                        <td><?php echo $delivery["delivery_status"]; ?></td>
                                        <td>
                                            <a class='btn btn-info' href='crud_delivery/delivery_view.php?id=<?php echo $delivery["id"]; ?>'>View</a>
                                            <a class='btn btn-dark' href='generate_qrCode.php?id=<?php echo $delivery["id"]; ?>'><i class="bi bi-qr-code"></i></a>
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
</body>
</html>
<script>
    //popover
    var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'));
    var popoverList = popoverTriggerList.map(function (t) {
        return new bootstrap.Popover(t);
    });
</script>