<?php

session_start();
include "../database/connection.php";

if(isset($_SESSION['student'])){
    $student_id = $_SESSION['student'];
}
$output = '';

$staff_id = $_SESSION['student'];
$sql = "SELECT * FROM notification WHERE  unset != '1' AND (unique_id=? OR unique_id='student')";
$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $student_id);
$stmt->execute();
$result = $stmt->get_result();
$count = $result->num_rows;
if($count === 0){
  $count = "";
}
$output = '<form method="post">
          <button type="submit" class="nav-link nav-icon btn" name="student-notification">
            <i class="bi bi-bell"></i>
            <span class="badge bg-primary badge-number">'. $count.'</span>
            </button>
        </form>' ;

        echo $output;

