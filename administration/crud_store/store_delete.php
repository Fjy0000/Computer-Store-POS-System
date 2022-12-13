<?php
require ($_SERVER['DOCUMENT_ROOT'] . '/Computer-Store-POS-System/administration/dbconnect.php');
//store delete
if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $sql = "DELETE FROM store WHERE store_id='$id'";
    $sql_run = mysqli_query($connect, $sql);
      $_SESSION['message'] = "This Store ( ID : " . $id . " ) is delete successfully.";
}
