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
                    <?php include"crud_delivery/delivery_assign.php "; ?>

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
<?php include 'static-include/footer.php'; ?>
