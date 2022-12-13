<?php
require 'dbconnect.php';
require 'crud_promotion/promotion_db.php';
$sql = "SELECT * FROM promotion";
$result = mysqli_query($connect, $sql);

if (!$result) {
    die("Invalid query:" . $connect->error);
}

//Remove session value of input field in promotion page
unset($_SESSION['promo_input_title'],
        $_SESSION['promo_input_description'],
        $_SESSION['promo_input_code'],
        $_SESSION['promo_input_expirydate'],
        $_SESSION['promo_input_discountrate']);

include 'static-include/header.php';
require 'static-nav/static-headnav.php';
require 'static-nav/static-sidenav.php';
?>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <?php include 'alertMessage.php'; ?>
            <h1 class="mt-4">Promotion Maintenance</h1>
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Promotion Table
                    <a href="crud_promotion/promotion_create.php" class="btn btn-primary float-end">Create</a>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Promotion Code</th>
                                <th>Discount Rate (%)</th>
                                <th>Expiry Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (mysqli_num_rows($result) > 0) {
                                foreach ($result as $promotion) {
                                    ?>
                                    <tr>
                                        <td><?php echo $promotion["promo_id"]; ?></td>
                                        <td><?php echo $promotion["title"]; ?></td>
                                        <td><?php echo $promotion["description"]; ?></td>
                                        <td><?php echo $promotion["promo_code"]; ?></td>
                                        <td><?php echo $promotion["discount_rate"]; ?></td>
                                        <td><?php echo $promotion["expiry_date"]; ?></td>
                                        <td>
                                            <a class='btn btn-warning' href='crud_promotion/promotion_update.php?id=<?php echo $promotion["promo_id"]; ?>'>Update</a>
                                            <button type="button" class="btn btn-danger delete_promotion" id="<?php echo $promotion["promo_id"]; ?>">Delete</button>
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
    //delete promotion confirmation
    $(document).on('click', '.delete_promotion', function () {
        var id = $(this).attr('id');
        if (confirm("Are you sure you want to delete this staff account ? ")) {
            $.ajax({
                url: "crud_promotion/promotion_delete.php",
                method: "POST",
                data: {id: id},
                success: function (data) {
                    location.reload(true);
                }
            })
        }
    });
</script>
</body>
</html>
