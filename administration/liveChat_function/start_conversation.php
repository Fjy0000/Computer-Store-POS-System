<?php
require ($_SERVER['DOCUMENT_ROOT'] . '/Computer-Store-POS-System/administration/dbconnect_pdo.php');
session_start();

$data = array(
    ':to_user_id'  => $_POST['to_user_id'], 
    ':from_user_id'  => $_SESSION['id'], 
    ':chat_message'  => $_POST['chat_message'], 
    ':status'   => '1');

$query = "INSERT INTO chat (to_user_id, from_user_id, chat_message, status) VALUES (:to_user_id, :from_user_id, :chat_message, :status)";
$statement = $connect2->prepare($query);
if($statement->execute($data))
{
 echo get_user_chat_history($_SESSION['id'], $_POST['to_user_id'], $connect2);
}

?>
