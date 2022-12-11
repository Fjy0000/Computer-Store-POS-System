<?php
require ($_SERVER['DOCUMENT_ROOT'] . '/Computer-Store-POS-System/administration/dbconnect.php');
require 'store_db.php';
?>
<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Create Store</title>
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
                            <h4>Store Create
                                <a href="http://localhost/Computer-Store-POS-System/administration/store.php" class="btn btn-danger float-end">Back</a>
                            </h4>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <i class="bi bi-question-circle float-end" style="font-size: 18px" data-bs-toggle="popover" title="Requirement:" data-bs-content="<?php echo $f_Desc1 ?>"></i>
                            </div>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                                <div class="row">
                                    <div class="card mb-4 mb-md-0">
                                        <div class="card-body">
                                            <div class="mb-3">
                                                <label>Store Name</label><span style="color: #dc3545">&nbsp;&nbsp; *<?php echo $nameErr; ?></span>
                                                <input type="text" name="name" class="form-control">
                                            </div>
                                            <div class="mb-3">
                                                <label>Store Type</label><span style="color: #dc3545">&nbsp;&nbsp; *<?php echo $typeErr; ?></span>
                                                <select class="form-select" aria-label="storeType list" name="type" id="type">
                                                    <option selected value=""> - Select Store Type - </option>
                                                    <option value="Headquarters">Headquarters</option>
                                                    <option value="Branch">Branch</option>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label>Store Address</label><span style="color: #dc3545">&nbsp;&nbsp; *<?php echo $addressErr; ?></span>
                                                <input type="text" name="address" class="form-control">
                                            </div>
                                            <div class="mb-3">
                                                <label>State</label><span style="color: #dc3545">&nbsp;&nbsp; *<?php echo $stateErr; ?></span>
                                                <input type="text" name="state" class="form-control">
                                            </div>
                                            <div class="mb-3">
                                                <label>Postal Code</label><span style="color: #dc3545">&nbsp;&nbsp; *<?php echo $postalErr; ?></span>
                                                <input type="text" name="postalCode" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-4 mb-0">
                                    <div class="d-grid">
                                        <button type="submit" class="btn btn-primary" name="create_store">Create New Store</button>
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
