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
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Removed Detail Table

                    <button type="button" class="btn btn-danger m-md-2 float-end" data-bs-toggle="modal" data-bs-target="#removeModal">Remove Product Quantity</button>
                    <?php include"crud_removedDetails/removedD_create.php"; ?>

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
                                            <form method="POST" action="remove_details.php" class="d-inline">
                                                <input type="hidden" name="delete_id" value="<?php echo $removed["removed_id"]; ?>">
                                                <button type="submit" class="btn btn-danger" name="delete_removedDetails">Delete</button>
                                            </form>
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