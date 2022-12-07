<?php

require ($_SERVER['DOCUMENT_ROOT'] . '/Computer-Store-POS-System/administration/dbconnect_pdo.php');

if (isset($_POST["message_id"])) {
    
    $message_id = $_POST['message_id'];
    $query = "UPDATE chat SET status = '2' WHERE chat_id ='$message_id' ";
    $statement = $connect2->prepare($query);
    $statement->execute();
}

