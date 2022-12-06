<?php
require 'dbconnect.php';
require 'crud_category/category_db.php';


$sql = "SELECT * FROM category";
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

            <h1 class="mt-4">Category Maintenance</h1>
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Category Table
                    
                    <button type="button" class="btn btn-primary m-md-2 float-end" data-bs-toggle="modal" data-bs-target="#categoryModal">Create</button>
                    <?php include"crud_category/category_create.php"; ?>
                    
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Description</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (mysqli_num_rows($result) > 0) {
                                foreach ($result as $category) {
                                    ?>
                                    <tr>
                                        <td><?php echo $category["category_id"]; ?></td>
                                        <td><?php echo $category["category_name"]; ?></td>
                                        <td><?php echo $category["description"]; ?></td>

                                        <td>
                                            <a class='btn btn-warning' href='crud_category/category_update.php?id=<?php echo $category["category_id"]; ?>'>Update</a>
                                            <form method="POST" action="category.php" class="d-inline">
                                                <input type="hidden" name="delete_id" value="<?php echo $category["category_id"]; ?>">
                                                <button type="submit" class="btn btn-danger" name="delete_category">Delete</button>
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