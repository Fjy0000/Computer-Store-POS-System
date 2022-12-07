<?php
require ($_SERVER['DOCUMENT_ROOT'] . '/Computer-Store-POS-System/administration/dbconnect.php');

$staff_query = "SELECT * FROM staff WHERE staff_id != '" . $_SESSION['id'] . "' ";
$users_query = "SELECT * FROM user_form ";

$statement1 = $connect2->prepare($staff_query);
$statement2 = $connect2->prepare($users_query);
$statement1->execute();
$statement2->execute();
$result1 = $statement1->fetchAll();
$result2 = $statement2->fetchAll();

$output = '
<table class="table">
 <tr>
  <td>Username</td>
  <td>Status</td>
  <td></td>
 </tr>
';

foreach ($result1 as $row) {
    $output .= '
 <tr>
  <td>' . $row['staff_username'] . '</td>
  <td></td>
  <td><button type="button" class="btn btn-success btn-xs start_chat" data-touserid="' . $row['staff_id'] . '" data-tousername="' . $row['staff_username'] . '"><i class="bi bi-chat-dots" style="font-size: 20px;"></i></button></td>
</tr>
 ';
}

foreach ($result2 as $row2) {
    $output .= '
 <tr>
  <td>' . $row2['name'] . '</td>
  <td></td>
  <td><button type="button" class="btn btn-success btn-xs start_chat" data-touserid="' . $row2['id'] . '" data-tousername="' . $row2['name'] . '"><i class="bi bi-chat-dots" style="font-size: 20px;"></i></button></td>
 </tr>
 ';
}
$output .= '</table>';
echo $output;
?>