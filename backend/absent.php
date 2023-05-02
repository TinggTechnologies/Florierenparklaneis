<?php

if (isset($_GET['student_id'])) {
    $student_id = $_GET['student_id'];
}

if(isset($_POST['absent-btn'])){

    $present = trim($_POST['present']);
    $present = stripslashes($present);
    $present = htmlspecialchars($present);

    $student_id = $_POST['student_id'];

    $present_sql = "UPDATE attendance SET absent=? WHERE student_id=?";
    $present_stmt = $conn->prepare($present_sql);
    $present_stmt->bind_param('ss', $present, $student_id);
    if($present_stmt->execute()){
        header("location: staff-checking-result.php");
    }


}