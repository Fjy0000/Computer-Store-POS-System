<?php
require 'dbconnect.php';

$sql = "SELECT * FROM store";
$result = mysqli_query($connect, $sql);

if (!$result) {
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
            <h1 class="mt-4">Store Maintenance</h1>
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Store Table
                    <a href="crud_store/store_create.php" class="btn btn-primary float-end">Create</a>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Type</th>
                                <th>Address</th>
                                <th>State</th>
                                <th>Postal Code</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (mysqli_num_rows($result) > 0) {
                                foreach ($result as $store) {
                                    ?>
                                    <tr>
                                        <td><?php echo $store["store_id"]; ?></td>
                                        <td><?php echo $store["name"]; ?></td>
                                        <td><?php echo $store["type"]; ?></td>
                                        <td><?php echo $store["address"]; ?></td>
                                        <td><?php echo $store["state"]; ?></td>
                                        <td><?php echo $store["postal_code"]; ?></td>

                                        <td>
                                            <a class='btn btn-warning' href='crud_store/store_update.php?id=<?php echo $store["store_id"]; ?>'>Update</a>
                                            <form method="POST" action="info_store_main_page.php" class="d-inline">
                                                <input type="hidden" name="delete_id" value="<?php echo $store["store_id"]; ?>">
                                                <button type="submit" class="btn btn-danger" name="delete_store">Delete</button>
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
</body>
</html>