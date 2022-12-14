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
                <div class="card-header bg-dark text-white">
                    <i class="bi bi-table"></i>
                    Category Table
                    <button type="button" class="btn btn-primary m-md-2 float-end" data-bs-toggle="modal" data-bs-target="#categoryModal">Create</button>
                    <div class="modal fade" id="categoryModal" tabindex="-1" role="dialog" aria-labelledby="categoryModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header bg-dark">
                                    <h5 class="modal-title" id="categoryModalLabel">Category Create</h5>
                                    <span aria-hidden="true" data-bs-dismiss="modal" aria-label="Close"><i class="bi bi-x-lg"></i></span>
                                </div>
                                <div>
                                    <i class="bi bi-question-circle text-primary float-end" data-bs-toggle="popover" title="Description:" data-bs-content="<?php echo $f_Desc1; ?>"></i>
                                    <span style="color: #dc3545">&nbsp;&nbsp; * = Required</span>
                                </div>
                                <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                                    <div class="modal-body text-black">
                                        <div class="form-group">
                                            <label>Category Name</label><span style="color: #dc3545">&nbsp;&nbsp; *<?php echo $nameErr; ?></span>
                                            <input type="text" name="name" class="form-control" value="">
                                        </div>
                                        <div class="form-group">
                                            <label>Description</label><span style="color: #dc3545">&nbsp;&nbsp; *<?php echo $descriptionErr; ?></span>
                                            <textarea name="description" class="form-control"></textarea>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary" name="create_category">Confirm</button>
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
                                            <button type="button" class="btn btn-danger delete_category" id="<?php echo $category["category_id"]; ?>">Delete</button>
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
    //popover
    var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'));
    var popoverList = popoverTriggerList.map(function (t) {
        return new bootstrap.Popover(t);
    });

    //delete category confirmation
    $(document).on('click', '.delete_category', function () {
        var id = $(this).attr('id');
        if (confirm("Are you sure you want to delete this category ? ")) {
            $.ajax({
                url: "crud_category/category_delete.php",
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