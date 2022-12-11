<?php
require ($_SERVER['DOCUMENT_ROOT'] . '/Computer-Store-POS-System/administration/dbconnect.php');
require 'product_db.php';

$sql1 = "SELECT * FROM category";
$sql2 = "SELECT * FROM store";
$result1 = mysqli_query($connect, $sql1);
$result2 = mysqli_query($connect, $sql2);
if (!$result1 || !$result2) {
    die("Invalid query:" . $connect->error);
}
?>
<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Product Create</title>
        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
    </head>
    <body class="bg-primary">

        <?php include ($_SERVER['DOCUMENT_ROOT'] . '/Computer-Store-POS-System/administration/alertMessage.php'); ?>

        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card shadow-lg border-0 rounded-lg mt-5">
                        <div class="card-header">
                            <h4>Create Product
                                <a href="http://localhost/Computer-Store-POS-System/administration/stock_hq.php" class="btn btn-danger float-end">Back</a>
                            </h4>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <i class="bi bi-question-circle float-end" style="font-size: 18px" data-bs-toggle="popover" title="Requirement:" data-bs-content="<?php echo $f_Desc1 ?>"></i>
                            </div>
                        </div>
                        <div class="card-body">
                            <form method="POST" enctype="multipart/form-data"  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                                <div class="row">
                                    <div class="card mb-4 mb-md-0">
                                        <div class="card-body">
                                            <div class="mb-3">
                                                <label>Product Name</label><span style="color: #dc3545">&nbsp;&nbsp; *<?php echo $nameErr; ?></span>
                                                <input type="text" name="name" class="form-control">
                                            </div>
                                            <div class="mb-3">
                                                <label>Description</label><span style="color: #dc3545">&nbsp;&nbsp; *<?php echo $descriptionErr; ?></span>
                                                <textarea name="description" class="form-control"></textarea>
                                            </div>
                                            <div class="mb-3">
                                                <label>Product Price (RM)</label><span style="color: #dc3545">&nbsp;&nbsp; *<?php echo $priceErr; ?></span>
                                                <input type="number" name="price" min="0" step="0.01" class="form-control">
                                            </div>
                                            <div class="mb-3">
                                                <label>Category</label><span style="color: #dc3545">&nbsp;&nbsp; *<?php echo $categoryErr; ?></span>
                                                <select class="form-select" aria-label="product list" name="c_name" id="c_name">
                                                    <option selected value=""> - Select Category - </option>
                                                    <?php
                                                    if (mysqli_num_rows($result1) > 0) {
                                                        foreach ($result1 as $category_n) {
                                                            ?>
                                                            <option value="<?php echo $category_n['category_name']; ?>"><?php echo $category_n['category_name']; ?></option>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            
                                            <div class="mb-3">
                                                <label>Store Name</label><span style="color: #dc3545">&nbsp;&nbsp; *<?php echo $s_idErr; ?></span>
                                                <select class="form-select" aria-label="store list" name="s_id" id="s_id">
                                                    <option selected value="">- Select Store -</option>
                                                    <?php
                                                    if (mysqli_num_rows($result2) > 0) {
                                                        foreach ($result2 as $store_n) {
                                                            ?>
                                                            <option value="<?php echo $store_n['store_id']; ?>"><?php echo $store_n['name']; ?></option>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            
                                            <div class="mb-3">
                                                <label>Quantity</label><span style="color: #dc3545">&nbsp;&nbsp; *<?php echo $quantityErr; ?></span>
                                                <input type="number" name="quantity" min="0" class="form-control">
                                            </div>
                                            <div class="mb-3">
                                                <label>Product Image</label><span style="color: #dc3545">&nbsp;&nbsp; *<?php echo $imageErr; ?></span>
                                                <input type="file" name="image" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-4 mb-0">
                                    <div class="d-grid">
                                        <button type="submit" class="btn btn-primary" name="create_product">Create Product</button>
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
