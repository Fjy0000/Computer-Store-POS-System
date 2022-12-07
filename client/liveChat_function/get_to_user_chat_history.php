<?php
require ($_SERVER['DOCUMENT_ROOT'] . '/Computer-Store-POS-System/client/dbconnect_pdo.php');
session_start();

echo get_user_chat_history($_SESSION['user_id'], $_POST['to_user_id'], $connect2);

