<?php

$error = [];
$grade = "";
$remark = "";

if(isset($_GET['student_id'])){
    $student_id = $_GET['student_id'];
}

if(isset($_POST['result-btn'])){
    
    $teacher_id = $_SESSION['staff'];

 
    $section = trim($_POST['session']);
    $section = stripslashes($section);
    $section = htmlspecialchars($section);

    $student_id = $_POST['student_id'];

    $term = trim($_POST['term']);
    $term = stripslashes($term);
    $term = htmlspecialchars($term);

    $course = trim($_POST['course']);
    $course = stripslashes($course);
    $course = htmlspecialchars($course);

    $test_score = trim($_POST['test_score']);
    $test_score = stripslashes($test_score);
    $test_score = htmlspecialchars($test_score);

    /* $exam_score = trim($_POST['exam_score']);
    $exam_score = stripslashes($exam_score);
    $exam_score = htmlspecialchars($exam_score); */

    if(empty($section) || empty($term) || empty($course) || empty($test_score)){
        $error['result'] = "<div class='alert alert-danger'>No field should be empty</div>";
    }

    $check_query = "SELECT * FROM result WHERE student_id=? AND course=? AND session=? AND term=?";
    $check_stmt = $conn->prepare($check_query);
    $check_stmt->bind_param('ssss', $student_id, $course, $section, $term);
    $check_stmt->execute();
    $check_result = $check_stmt->get_result();
    if($check_result->num_rows > 0){
        $rows = $check_result->fetch_assoc();
        $_SESSION['student_id'] = $rows['student_id'];
        $_SESSION['student_session'] = $section;
        $_SESSION['student_course'] = $course;
        $_SESSION['student_term'] = $term;
        $error['check'] = '<div class="pt-3">you have uploaded this users '.$course.' course for '.$term.' and '.$section.' session</div>';
    }

    if(count($error) === 0){
        $percentage = $test_score / 40 * 100;
        $approved = "0";

if($percentage >= 90){
    $grade = "A+";
    $remark = "Excellent";
} elseif ($percentage >= 80 && $percentage < 90) {
    $grade = "A";
    $remark = "Very Good";
} elseif ($percentage >= 70 && $percentage < 80) {
    $grade = "B";
    $remark = "Good";
} elseif ($percentage >= 60 && $percentage < 70) {
    $grade = "B";
    $remark = "Fairly Good";
} elseif ($percentage >= 50 && $percentage < 60) {
    $grade = "C";
    $remark = "Average";
} elseif ($percentage >= 40 && $percentage < 50) {
    $grade = "D";
    $remark = "Below Avg.";
} elseif ($percentage < 40) {
    $grade = "E";
    $remark = "Weak";
}



        $sql = "INSERT INTO result(teacher_id, student_id, course, session, term, test_score, cummulative, percentage, grade, date, approved) VALUES(?,?,?,?,?,?,?,?,?,NOW(),?)";
        $stmt = $conn->prepare($sql);
        $stmt -> bind_param('ssssssssss', $teacher_id, $student_id, $course,  $section, $term, $test_score, $remark, $percentage, $grade, $approved);
        if($stmt->execute()){
            $_SESSION['student_id'] = $student_id;
            $_SESSION['student_session'] = $section;
            $_SESSION['student_course'] = $course;
            $_SESSION['student_term'] = $term;
            echo "<script>location.href = 'upload-student-result-success.php';</script>";
            exit();
        } else{
            "error";
        }
        }
    } 
