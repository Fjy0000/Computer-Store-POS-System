<?php

require ($_SERVER['DOCUMENT_ROOT'] . '/Computer-Store-POS-System/client/dbconnect_pdo.php');

session_start();

$staff_query = "SELECT * FROM staff ";


$statement1 = $connect2->prepare($staff_query);
$statement1->execute();
$result1 = $statement1->fetchAll();

$output = '
<table class="table">
 <tr>
  <td>Username</td>
  <td>Status</td>
  <td></td>
 </tr>
';

foreach ($result1 as $row1) {

    $status1 = ' ';
    $current_timestamp = date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s') . '-10 seconds'));

    $last_activity = get_user_last_activity($row1['staff_id'], $row1['staff_username'], $connect2);

    if ($last_activity > $current_timestamp) {
        $status1 = "<button type='button' class='btn-success'>Online</button>";
    } else {
        $status1 = "<button type='button' class='btn-secondary'>Offline</button>";
    }

    $output .= '
 <tr>
  <td>' . $row1['staff_username'] . '</td>
  <td>' . $status1 . '</td>
  <td><button type="button" class="btn btn-success btn-xs start_chat" data-touserid="' . $row1['staff_id'] . '" data-tousername="' . $row1['staff_username'] . '"><i class="bi bi-chat-dots" style="font-size: 20px;"></i></button></td>
</tr>
 ';
}

$output .= '</table>';
echo $output;
?>