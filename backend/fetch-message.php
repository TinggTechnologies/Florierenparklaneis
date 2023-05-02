<?php

session_start();
include "../database/connection.php";

if(isset($_SESSION['student'])){
    $student_id = $_SESSION['student'];
}
$output = '';

$sql2 = "SELECT * FROM messages WHERE incoming_id='$student_id' AND alert != '1'";
$stmt2 = $conn->prepare($sql2);
$stmt2->execute();
$result2 = $stmt2->get_result();
$count2 = $result2->num_rows;
if($count2 === 0){
  $count2 = "";
}
$output = '<a class="nav-link nav-icon" href="student-chat.php">
<i class="bi bi-chat-left-text"></i>
<span class="badge bg-success badge-number">'. $count2.'</span>
</a>' ;

        echo $output;

