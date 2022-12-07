<?php
require ($_SERVER['DOCUMENT_ROOT'] . '/Computer-Store-POS-System/client/dbconnect_pdo.php');
session_start();

$login_details_id = $_SESSION['login_details_id'];

$query = "UPDATE login_details SET last_activity=now() WHERE login_details_id ='$login_details_id' ";

$statement=$connect2->prepare($query);
$statement->execute();