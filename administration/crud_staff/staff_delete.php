<?php

require ($_SERVER['DOCUMENT_ROOT'] . '/Computer-Store-POS-System/administration/dbconnect.php');

//Delete Staff
if (isset($_POST['staff_id'])) {

    $id = $_POST['staff_id'];
    $sql = "DELETE FROM staff WHERE staff_id='$id' ";
    $sql_run = mysqli_query($connect, $sql);
     $_SESSION['message'] = "This Staff Account ( ID : "  .$id. " ) is delete successfully.";
}

