<?php
require 'dbconnect.php';
require 'fpdf185/fpdf.php';

$sql = "SELECT * FROM orders";
$query1 = "SELECT * FROM store";

$result = mysqli_query($connect, $sql);
$get1 = mysqli_query($connect, $query1);

if (!$result || !$get1) {
    die("Invalid query:" . $connect->error);
}

$sderror = $ederror = $storeErr = "";
$f_Desc1 = "Select the store to generate that store sold product is required";

if (isset($_POST['generate'])) {
    $store = $_POST['storeName'];
    $endDate = $_POST['endD'];
    $startDate = $_POST['startD'];
    $count = 0;
    $totalAmount = 0;

    if (empty($endDate)) {
        $ederror = "Required.";
    }
    if (empty($startDate)) {
        $sderror = "Required.";
    }
    if (empty($store)) {
        $storeErr = "Required.";
    }

    if (empty($storeErr) && empty($ederror) && empty($sderror)) {
        $sql = "SELECT * FROM orders WHERE store_send = '$store' ";
        $ordersList = mysqli_query($connect, $sql);

        $pdf = new FPDF();
        $pdf->AddPage();

        //pdf header
        $pdf->SetFont('Arial', 'BU', 20);
        $pdf->Cell(200, 10, 'Computer Store', 0, 1, 'C');
        $pdf->Cell(200, 10, 'Monthly Sales Report', 0, 1, 'C');

        $pdf->SetFont('Arial', '', 16);
        $pdf->Cell(200, 10, $store, 0, 1, 'C');

        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(64, 10, ' ', 0, 0, 'C');
        $pdf->Cell(20, 10, 'Date : ', 0, 0, 'C');
        $pdf->Cell(15, 10, $startDate, 0, 0, 'C');
        $pdf->Cell(15, 10, 'To', 0, 0, 'C');
        $pdf->Cell(15, 10, $endDate, 0, 0, 'C');
        $pdf->Line(10, 55, 200, 55);

        //pdf body
        $pdf->Ln(25);
        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(20, 5, 'No', 0, 0);
        $pdf->Cell(120, 5, 'Product (Sold)', 0, 0);
        $pdf->Cell(35, 5, 'Price (RM)', 0, 0, 'C');
        $pdf->Line(10, 70, 200, 70);

        if (mysqli_num_rows($ordersList) > 0) {
            foreach ($ordersList as $sold) {
                $totalAmount += (double) $sold['total_price'];
                $count += 1;
                $pdf->Ln(10);
                $pdf->Cell(20, 5, $count, 0, 0);
                $x = $pdf->GetX();
                $y = $pdf->GetY();
                $pdf->MultiCell(120, 5, $sold['total_product'], 0, 0);
                $pdf->SetXY($x + 115, $y);
                $pdf->Cell(35, 5, $sold['total_price'], 0, 0, 'C');
                $pdf->Ln(8);
            }
        }

        //pdf footer
        $pdf->Ln(80);
        $pdf->Cell(120, 5, ' ', 0, 0);
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(47, 5, 'Total Amount (Sold) :', 0, 0);
        $pdf->SetFont('Arial', 'B', 14);
        $pdf->Cell(10, 5, 'RM', 0, 0);
        $pdf->Cell(20, 5, $totalAmount, 0, 0);

        //print out pdf
        $pdf->Output();
    }
}

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
                                    <i class="bi bi-question-circle float-end" style="font-size: 18px" data-bs-toggle="popover" title="Requirement:" data-bs-content="<?php echo $f_Desc1 ?>"></i>
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
                                        <div class="mb-3">
                                            <label>Start Date</label><span style="color: #dc3545">&nbsp;&nbsp; *<?php echo $sderror; ?></span>
                                            <input type="date" name="startD" class="form-control">
                                        </div>
                                        <div class="mb-3">
                                            <label>End Date</label><span style="color: #dc3545">&nbsp;&nbsp; *<?php echo $ederror; ?></span>
                                            <input type="date" name="endD" class="form-control">
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
</body>
</html>
<script>
    //popover
    var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'));
    var popoverList = popoverTriggerList.map(function (t) {
        return new bootstrap.Popover(t);
    });
</script>

