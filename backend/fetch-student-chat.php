<?php

session_start();
include "../database/connection.php";

if(isset($_SESSION['student'])){
    $student_id = $_SESSION['student'];
}
$output = '';

$sql = "SELECT * FROM staff WHERE admin_verify='1'";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();
if($result->num_rows > 0){
  while($get_row = $result->fetch_assoc()){
    $incoming_id = $get_row['unique_id'];
    $outgoing_id = $student_id;
    $sql2 = "SELECT * FROM messages WHERE (outgoing_id = '$outgoing_id' AND incoming_id='$incoming_id') OR (outgoing_id='$incoming_id' AND incoming_id='$outgoing_id') ORDER BY msg_id DESC ";
    $stmt2 = $conn->prepare($sql2);
    $stmt2->execute();
    $result2 =  $stmt2->get_result();
    if($result2->num_rows > 0){
      $row2 = $result2->fetch_assoc();
        $output = $row2['message'];
      } else {
        $output = "No message available";
      }
      (strlen($output) > 28) ? $msg = substr($output, 0, 28) . '....' : $msg = $output;

      $sql3 = "SELECT * FROM messages WHERE incoming_id='$outgoing_id' AND outgoing_id='$incoming_id' AND alert != '1' ORDER BY msg_id DESC";
      $stmt3 = $conn->prepare($sql3);
      $stmt3->execute();
      $result3 = $stmt3->get_result();
      $count3 = $result3->num_rows;
      if($count3 === 0){
        $count3 = "";
      }

echo 
'
<a href="student-chatting.php?student_id='.$get_row['unique_id'].'" class="text-black">
<div class="container d-flex align-items-center mb-2">
  <div class="left d-flex justify-content-center align-items-center">
      <img src="uploads/'.$get_row['image'].'" style="width: 50px; height: 50px; border-radius: 50%;" alt="">
      <div class="flex ms-3">
          <h4 class="mb-0">'.$get_row['lastname'].' '.$get_row['firstname'].'</h4>
          <p>'.$msg.'</p>
          <hr>
      </div>
  </div>
  <div>
      <span class="badge bg-success badge-number">'. $count3 .'</span>
  </div>
</div>
</a>

';
}
}

$my_id = $_SESSION['student'];
$sql = "SELECT * FROM users WHERE student_id != '$my_id' AND admin_verify='1'";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();
if($result->num_rows > 0){
  while($get_row = $result->fetch_assoc()){
    $incoming_id = $get_row['student_id'];
    $outgoing_id = $student_id;
    $sql2 = "SELECT * FROM messages WHERE (outgoing_id = '$outgoing_id' AND incoming_id='$incoming_id') OR (outgoing_id='$incoming_id' AND incoming_id='$outgoing_id')ORDER BY msg_id DESC";
    $stmt2 = $conn->prepare($sql2);
    $stmt2->execute();
    $result2 =  $stmt2->get_result();
    if($result2->num_rows > 0){
      $row2 = $result2->fetch_assoc();
        $output = $row2['message'];
      } else {
        $output = "No message available";
      }
      (strlen($output) > 28) ? $msg = substr($output, 0, 28) . '....' : $msg = $output;

      $sql3 = "SELECT * FROM messages WHERE incoming_id='$outgoing_id' AND outgoing_id='$incoming_id' AND alert != '1' ORDER BY msg_id DESC";
      $stmt3 = $conn->prepare($sql3);
      $stmt3->execute();
      $result3 = $stmt3->get_result();
      $count3 = $result3->num_rows;
      if($count3 === 0){
        $count3 = "";
      }

echo 
'
<a href="student-chatting.php?student_id='.$get_row['student_id'].'" class="text-black">
<div class="container d-flex align-items-center mb-2">
  <div class="left d-flex justify-content-center align-items-center">
      <img src="uploads/'.$get_row['image'].'" style="width: 50px; height: 50px; border-radius: 50%;" alt="">
      <div class="flex ms-3">
          <h4 class="mb-0">'.$get_row['lastname'].' '.$get_row['firstname'].'</h4>
          <p>'.$msg.'</p>
          <hr>
      </div>
  </div>
  <div>
      <span class="badge bg-success badge-number">'. $count3 .'</span>
  </div>
</div>
</a>
';
}}