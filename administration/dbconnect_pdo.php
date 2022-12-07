<?php

//PDO (PHP Data Objects)
$connect2 = new PDO("mysql:host=localhost;dbname=fyp_database", "root", "");

$timezone = date_default_timezone_get();
date_default_timezone_set($timezone);

function get_user_last_activity($id, $username, $connect2) {

    $query = "SELECT * FROM login_details WHERE user_id = '$id' AND username='$username' ORDER BY last_activity DESC LIMIT 1 ";

    $statement = $connect2->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();

    foreach ($result as $row) {
        return $row['last_activity'];
    }
}

function get_user_chat_history($from_user_id, $to_user_id, $connect2) {

    $query = "SELECT * FROM `chat` WHERE from_user_id = '$from_user_id'"
            . "AND to_user_id = '$to_user_id'"
            . "OR from_user_id = '$to_user_id'"
            . "AND to_user_id = '$from_user_id'"
            . "ORDER BY timestamp DESC ";

    $statement = $connect2->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();
    $output = "<ul class='list-unstyled'>";

    foreach ($result as $row) {
        $user_name = "";
        $background = "";
        $message = "";

        if ($row["from_user_id"] == $from_user_id) {

            if ($row["status"] == '2') {
                $message = '<em> This message has been removed </em>';
                $user_name = '<b class="text-success">You</b>';
            } else {
                $message = $row['chat_message'];
                $user_name = '<button type="button" class="bi bi-x remove_message" id=" '. $row['chat_id'] .' "></button>&nbsp;<b class="text-success">You</b>';
            }
            $background = 'background-color:#ffe6e6;';
        } else {
            if ($row["status"] == '2') {
                $message = '<em> This message has been removed </em>';
            } else {
                $message = $row['chat_message'];
            }
            $user_name = '<b class="text-danger">' . get_user_name($row['from_user_id'], $connect2) . '</b>';
            $background = 'background-color:#ffffe6;';
        }

        $output .= '
  <li style="border-bottom:1px dotted #ccc;padding-top:8px; padding-left:8px; padding-right:8px;' . $background . '">
   <p>' . $user_name . ' - ' . $message . '
    <div align="right">
     - <small><em>' . $row['timestamp'] . '</em></small>
    </div>
   </p>
  </li>
  ';
    }
    $output .= '</ul>';
    return $output;
}

function get_user_name($user_id, $connect2) {
    $query = "SELECT staff_username FROM staff WHERE staff_id = '$user_id'";
    $statement = $connect2->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();
    foreach ($result as $row) {
        return $row['staff_username'];
    }
}

?>