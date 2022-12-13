<?php
require 'dbconnect.php';
require 'crud_removedDetails/removedD_db.php';

// Show removed quantity details
$sql = "SELECT * FROM removed_detail";

//Show store details and unqiue product
$query1 = "SELECT * FROM store";
$query2 = "SELECT DISTINCT name FROM product ";

$result = mysqli_query($connect, $sql);
$get1 = mysqli_query($connect, $query1);
$get2 = mysqli_query($connect, $query2);

if (!$result || !$get1 || !$get2) {
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
            <h1 class="mt-4">Removed Detail Manage</h1>
            <div class="card mb-4">
                <div class="card-header bg-dark text-white">
                    <i class="bi bi-table"></i>
                    Removed Detail Table
                    <button type="button" class="btn btn-danger m-md-2 float-end" data-bs-toggle="modal" data-bs-target="#removeModal">Remove Product Quantity</button>
                    <!-- remove product quantity modal -->
                    <div class="modal fade" id="removeModal" tabindex="-1" role="dialog" aria-labelledby="removeModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="removeModalLabel">Remove Product Quantity</h5>
                                    <span aria-hidden="true" data-bs-dismiss="modal" aria-label="Close"><i class="bi bi-x-lg"></i></span>
                                </div>
                                <div>
                                    <i class="bi bi-question-circle float-end" style="font-size: 18px" data-bs-toggle="popover" title="Description:" data-bs-content="<?php echo $f_Desc1 ?>"></i>
                                    <span style="color: #dc3545">&nbsp;&nbsp; * = Required</span>
                                </div>
                                <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                                    <div class="modal-body">
                                        <div class="form-group mb-3">
                                            <label>Store</label><span style="color: #dc3545">&nbsp;&nbsp; *</span>
                                            <select class="form-select" aria-label="store" name="r_store_id" id="r_store_id">
                                                <option selected value="">- Select Store -</option>
                                                <?php
                                                if (mysqli_num_rows($get1) > 0) {
                                                    foreach ($get1 as $get_store) {
                                                        ?>
                                                        <option value="<?php echo $get_store['store_id']; ?>"><?php echo $get_store['name']; ?></option>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label>Product</label><span style="color: #dc3545">&nbsp;&nbsp; *</span>
                                            <select class="form-select" aria-label="product" name="r_product_name" id="r_product_name">
                                                <option selected value="">- Select Product -</option>
                                                <?php
                                                if (mysqli_num_rows($get2) > 0) {
                                                    foreach ($get2 as $get_product) {
                                                        ?>
                                                        <option value="<?php echo $get_product['name']; ?>"><?php echo $get_product['name']; ?></option>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label>Reason</label><span style="color: #dc3545">&nbsp;&nbsp; *</span>
                                            <textarea class="form-control" name="reason"></textarea>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label>Quantity</label><span style="color: #dc3545">&nbsp;&nbsp; *</span>
                                            <input type="number" min="0" class="form-control" name="r_quantity">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-danger" name="create_removeDetails">Confirm Remove</button>
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
                                <th>ID</th>
                                <th>Product Name</th>
                                <th>Store Name</th>
                                <th>Quantity</th>
                                <th>Removed Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (mysqli_num_rows($result) > 0) {
                                foreach ($result as $removed) {
                                    ?>
                                    <tr>
                                        <td><?php echo $removed["removed_id"]; ?></td>
                                        <td><?php echo $removed["product_name"]; ?></td>
                                        <td><?php echo $removed["store_name"]; ?></td>
                                        <td><?php echo $removed["quantity"]; ?></td>
                                        <td><?php echo $removed["removed_date"]; ?></td>

                                        <td>
                                            <a class='btn btn-info' href='crud_removedDetails/removedD_view.php?id=<?php echo $removed["removed_id"]; ?>'>View</a>
                                            <button type="button" class="btn btn-danger delete_removedD" id="<?php echo $removed["removed_id"]; ?>">Delete</button>
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
    //delete removed details confirmation
    $(document).on('click', '.delete_removedD', function () {
        var id = $(this).attr('id');
        if (confirm("Are you sure you want to delete this Removed Details ? ")) {
            $.ajax({
                url: "crud_removedDetails/removedD_delete.php",
                method: "POST",
                data: {id: id},
                success: function (data) {
                    location.reload(true);
                }
            })
        }
    });
    //popover
    var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'));
    var popoverList = popoverTriggerList.map(function (t) {
        return new bootstrap.Popover(t);
    });
</script>
</body>
</html>