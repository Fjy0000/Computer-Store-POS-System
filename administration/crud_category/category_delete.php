<?php
require ($_SERVER['DOCUMENT_ROOT'] . '/Computer-Store-POS-System/administration/dbconnect.php');

//Delete Category 
if (isset($_POST['id'])) {

    $id = $_POST['id'];
    $sql = "DELETE FROM category WHERE category_id='$id'";
    $sql_run = mysqli_query($connect, $sql);
     $_SESSION['message'] = "This Category ( ID : " . $id . " ) is delete successfully.";
}