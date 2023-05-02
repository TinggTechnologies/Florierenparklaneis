<?php

if (isset($_GET['student_id'])) {
    $student_id = $_GET['student_id'];
}

if(isset($_POST['teacher-comment-btn'])){

    $present = trim($_POST['present']);
    $present = stripslashes($present);
    $present = htmlspecialchars($present);

    $student_id = $_POST['student_id'];

    $present_sql = "UPDATE attendance SET principal_comment=? WHERE student_id=?";
    $present_stmt = $conn->prepare($present_sql);
    $present_stmt->bind_param('ss', $present, $student_id);
    if($present_stmt->execute()){
        echo "<script>location.href = 'admin-checking-result.php';</script>";
    }


}