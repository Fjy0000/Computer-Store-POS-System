<?php
require ('dbconnect.php');
require ('phpqrcode/qrlib.php');

$id = $_GET['id'];
$url = "";
$path = "images_qrcode/";
$qrcode = $path . time() . ".png";

if (isset($_POST['generate_qrCode'])) {
    $url = $_POST['qr_code'];
    QRcode::png($url, $qrcode, 'H', 4, 4);
    echo '<script>alert("Your QR code generated succussfully.");</script>';
}

include 'static-include/header.php';
require 'static-nav/static-headnav.php';
require 'static-nav/static-sidenav.php';
?>

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Generate QR Code </h1>
            <div class="card mb-4">
                <div class="card-header bg-dark">
                    <a href="http://localhost/Computer-Store-POS-System/administration/delivery.php" class="btn btn-primary float-end">Back</a>
                </div>
                <div class="container">
                    <div class="card-body">
                        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                            <div class="form-group mb-4">
                                <label>QR Code URL</label>
                                <input type="text" name="qr_code" id="qr_code" class="form-control" value="http://localhost/Computer-Store-POS-System/administration/customer_recevied_order.php?id=<?php echo $id; ?>" readonly="">
                            </div>
                            <div class='form-group mb-4'>
                                <button type="submit" class="btn btn-primary" name="generate_qrCode">Generate QR Code</button>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer">
                        <label>QR Code Image</label>
                        <div> <?php echo "<img src=' " . $qrcode . " '> "; ?></div>
                    </div> 
                </div>
            </div>
        </div>
    </main>
</div>
</body>
</html>
