<?php
require ($_SERVER['DOCUMENT_ROOT'] . '/Computer-Store-POS-System/administration/dbconnect.php');
require 'store_db.php';

if (isset($_GET['id'])) {
    $storeID = $_GET['id'];
    $sql2 = "SELECT * FROM store WHERE store_id='$storeID'";
    $result2 = mysqli_query($connect, $sql2);

    if (mysqli_num_rows($result2) > 0) {
        $currentStore = mysqli_fetch_array($result2);
    }
}
?>
<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>store update</title>
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
                            <h4>Store Update
                                 <button type="button" onclick="history.back()" class="btn btn-primary float-end">Back</button>
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
                                            <input type="hidden" name="id" class="form-control" value="<?php echo $currentStore['store_id']?>">
                                            <div class="mb-3">
                                                <label>Store Name</label><span style="color: #dc3545">&nbsp;&nbsp; *</span>
                                                <input type="text" name="name" class="form-control" value="<?php echo $currentStore['name']?>">
                                            </div>
                                            <div class="mb-3">
                                                <label>Store Type</label><span style="color: #dc3545">&nbsp;&nbsp; *</span>
                                                <select class="form-select" aria-label="storeType list" name="type" id="type">
                                                    <option selected value="<?php echo $currentStore['type']?>"><?php echo $currentStore['type']?></option>
                                                    <option value="Headquarters">Headquarters</option>
                                                    <option value="Branch">Branch</option>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label>Store Address</label><span style="color: #dc3545">&nbsp;&nbsp; *</span>
                                                <input type="text" name="address" class="form-control" value="<?php echo $currentStore['address']?>">
                                            </div>
                                            <div class="mb-3">
                                                <label>Store State</label><span style="color: #dc3545">&nbsp;&nbsp; *</span>
                                                <input type="text" name="state" class="form-control" value="<?php echo $currentStore['state']?>" >
                                            </div>
                                            <div class="mb-3">
                                                <label>Store Postal Code</label><span style="color: #dc3545">&nbsp;&nbsp; *</span>
                                                <input type="text" name="postalCode" class="form-control" value="<?php echo $currentStore['postal_code']?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-4 mb-0">
                                    <div class="d-grid">
                                        <button type="submit" class="btn btn-primary" name="update_store">Update Store Detail</button>
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
        </script>
    </body>
</html>
