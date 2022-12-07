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
        $user_name = '';
        if ($row["from_user_id"] == $from_user_id) {
            $user_name = '<b class="text-success">You</b>';
        } else {
            $user_name = '<b class="text-danger">' . get_user_name($row['from_user_id'], $connect2) . '</b>';
        }
        $output .= '
  <li style="border-bottom:1px dotted #ccc">
   <p>' . $user_name . ' - ' . $row["chat_message"] . '
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