<?php
require 'dbconnect.php';
require 'crud_staff/staff_db.php';

$sql = "SELECT * FROM staff";
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

            <h1 class="mt-4">Staff Account</h1>
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Staff Account Table
                    <a href="crud_staff/staff_register.php" class="btn btn-primary float-end">Register</a>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Staff Name</th>
                                <th>Position</th>
                                <th>Email</th>
                                <th>Phone</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (mysqli_num_rows($result) > 0) {
                                foreach ($result as $staff) {
                                    ?>
                                    <tr>
                                        <td><?php echo $staff["staff_id"]; ?></td>
                                        <td><?php echo $staff["staff_name"]; ?></td>
                                        <td><?php echo $staff["staff_position"]; ?></td>
                                        <td><?php echo $staff["staff_email"]; ?></td>
                                        <td><?php echo $staff["staff_contactNo"]; ?></td>
                                        <td>
                                            <a class='btn btn-info' href='crud_staff/staff_view.php?id=<?php echo $staff["staff_id"]; ?>'>View</a>
                                            <a class='btn btn-warning' href='crud_staff/staff_update.php?id=<?php echo $staff["staff_id"]; ?>'>Update</a>
                                            <form method="POST" action="staff.php" class='d-inline'>
                                                <input type="hidden" name="delete_id" value="<?php echo $staff["staff_id"]; ?>">
                                                <button type="submit" class="btn btn-danger" name="delete_staff">Delete</button>
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
