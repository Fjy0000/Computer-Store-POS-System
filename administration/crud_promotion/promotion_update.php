<?php
require ($_SERVER['DOCUMENT_ROOT'] . '/Computer-Store-POS-System/administration/dbconnect.php');
require 'promotion_db.php';

if (isset($_GET['id'])) {
    $promoID = $_GET['id'];
    $sql2 = "SELECT * FROM promotion WHERE promo_id='$promoID'";
    $result2 = mysqli_query($connect, $sql2);

    if (mysqli_num_rows($result2) > 0) {
        $currentPromo = mysqli_fetch_array($result2);
    }
}
?>
<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>promotion update</title>
        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
    </head>
    <body class="bg-primary">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card shadow-lg border-0 rounded-lg mt-5">
                        <div class="card-header">
                            <h4>Promotion Update
                                <a href="http://localhost/Computer-Store-POS-System/administration/promotion.php" class="btn btn-primary float-end">Back</a>
                            </h4>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <i class="bi bi-question-circle float-end" style="font-size: 18px" data-bs-toggle="popover" title="Description:" data-bs-content="<?php echo $f_Desc2 ?>"></i>
                                <span style="color: #dc3545">&nbsp;&nbsp; * = Required</span>
                            </div>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                                <div class="row">
                                    <div class="card mb-4 mb-md-0">
                                        <div class="card-body">
                                            <div class="card-body">
                                                <input type="hidden" name="id" class="form-control" value="<?php echo $currentPromo['promo_id']; ?>">
                                                <div class="mb-3">
                                                    <label>Promotion's Title</label><span style="color: #dc3545">&nbsp;&nbsp; *</span>
                                                    <input type="text" name="title" class="form-control" value="<?php echo $currentPromo['title']; ?>">
                                                </div>
                                                <div class="mb-3">
                                                    <label>Description</label><span style="color: #dc3545">&nbsp;&nbsp; *</span>
                                                    <textarea name="description" class="form-control"> <?php echo $currentPromo['description']; ?></textarea>
                                                </div>
                                                <div class="mb-3">
                                                    <label>Promotion Code</label><span style="color: #dc3545">&nbsp;&nbsp; *</span>
                                                    <div class="input-group mb-3">
                                                        <input type="text" name="promoCode" id="promoCode" class="form-control" value="<?php echo $currentPromo['promo_code']; ?>">
                                                        <button type="button" class="bi bi-arrow-repeat" style="font-size: 20px" onclick="getCode()"></button>
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label>Discount Rate</label><span style="color: #dc3545">&nbsp;&nbsp; *</span>
                                                    <input type="text" name="discountRate" class="form-control" value="<?php echo $currentPromo['discount_rate']; ?>">
                                                </div>
                                                <div class="mb-3">
                                                    <label>Expiry Date</label><span style="color: #dc3545">&nbsp;&nbsp; *</span>
                                                    <input type="date" name="expiryDate" class="form-control" value="<?php echo $currentPromo['expiry_date']; ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-4 mb-0">
                                        <div class="d-grid">
                                            <button type="submit" class="btn btn-primary" name="update_promotion">Update Promotion</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            //popover
            var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'));
            var popoverList = popoverTriggerList.map(function (t) {
                return new bootstrap.Popover(t);
            });

            //Get Random Recovery Promotion Code
            function getCode() {
                var chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                var result = "";

                for (var i = 0; i < 6; i++) {
                    result += chars.charAt(Math.floor(Math.random() * chars.length));
                }
                document.getElementById("promoCode").value = result;
            }
        </script>
    </body>
</html>

