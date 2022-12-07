<?php

session_start();

//MySQLi (object-oriented) 
$serverName = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "fyp_database";
$connect = new mysqli($serverName, $dbUsername, $dbPassword, $dbName);
if ($connect->connect_error) {
    die("Connection Failed :" . $connect->connect_error);
}

?>