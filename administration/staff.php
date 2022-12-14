<?php
require 'dbconnect.php';
require 'crud_staff/staff_db.php';

$sql = "SELECT * FROM staff";
$result = mysqli_query($connect, $sql);

if (!$result) {
    die("Invalid query:" . $connect->error);
}

//Remove session value of input field in register page
unset($_SESSION['staff_input_name'],
        $_SESSION['staff_input_email'],
        $_SESSION['staff_input_phone'],
        $_SESSION['staff_input_ic'],
        $_SESSION['staff_input_age'],
        $_SESSION['staff_input_username'],
        $_SESSION['staff_input_password'],
        $_SESSION['staff_input_cPassword'],
        $_SESSION['staff_input_recoveryKey']);

include 'static-include/header.php';
require 'static-nav/static-headnav.php';
require 'static-nav/static-sidenav.php';
?>

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <?php include 'alertMessage.php'; ?>
            <h1 class="mt-4">Staff Account Manage</h1>
            <div class="card mb-4">
                <div class="card-header bg-dark text-white">
                    <i class="bi bi-table"></i>
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
                                            <button type="button" class="btn btn-danger delete_staff" id="<?php echo $staff["staff_id"]; ?>">Delete</button>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            } else {
                                echo "<h5 class='text-primary'>No Record.....</h5>";
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
    //delete staff account confirmation
    $(document).on('click', '.delete_staff', function () {
        var id = $(this).attr('id');
        if (confirm("Are you sure you want to delete this staff account ? ")) {
            $.ajax({
                url: "crud_staff/staff_delete.php",
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
