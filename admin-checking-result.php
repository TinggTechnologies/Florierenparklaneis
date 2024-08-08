
<?php
require "admin-header.php";
$total_score = 0;
$percentage = 0;
$remark = "";
?>
<?php
 
 $student_id = $_SESSION['student_id'];
 $sql = "SELECT * FROM users where student_id=?";
 $stmt = $conn->prepare($sql);
 $stmt->bind_param('s', $student_id);
 $stmt->execute();
 $result = $stmt->get_result();
 $fetch = $result->fetch_assoc();
?>
<link href='https://fonts.googleapis.com/css?family=Cinzel' rel='stylesheet'>
<section class="py-5 mb-5">
<div class="d-flex align-items-center justify-content-center pt-4">
<img src="./assets/img/florieren/logo.png" width="40px" height="40px" alt=""> <h1 class="ms-3" style="color: darkblue; font-size: 1.5rem;font-family: 'Cinzel';">Florieren ParkLane<br /><span class="text-black">International School</span></h1>
</div>
<div class="container pt-1 text-right">
    <p style="text-align: right;">1, Alhaji Nasiru Sikiru Street,
Hilltop Estate, Aboru, Lagos State. <br />
    COMPREHENSIVE ANALYSIS OF ASSESSMENT IN THE THREE DOMAINS COGNITIVE PHYSCO-MOTOR AND AFFECTIVE
</p>
<?php
$check_sql = "SELECT * FROM attendance WHERE student_id=?";
$check_stmt = $conn->prepare($check_sql);
$check_stmt->bind_param('s', $student_id);
$check_stmt->execute();
$check_get_result = $check_stmt->get_result();
if($check_get_result->num_rows > 0){
    $check_fetch = $check_get_result->fetch_assoc();
}
?>
<p style="text-align: right;">Term: <span class="text-success"><?= $_SESSION['term'] ?></span> <br />Session: <span class="text-success"><?php echo $_SESSION['session'] ?></span></p>

<p style="text-align: left;">Name: <span class="text-success"><?= $fetch['lastname']; ?> <?= $fetch['firstname']; ?></span><br />
Class: <span class="text-success"><?= $fetch['class']; ?></span><br />
No of Times School Opened: <span class="text-success"><?php 
if(isset($check_fetch['student_id'])){
    if($check_fetch['absent'] === '' || $check_fetch['present'] === '') {
        echo "<i class='bi bi-x-octagon-fill text-danger'></i>";
    } else{
echo $check_fetch['absent'] + $check_fetch['present'];
    }
} else {
    echo "<i class='bi bi-x-octagon-fill text-danger'></i>";
}
?></span><br />

No of Times Present: <span class="text-success"><?php 
if(isset($check_fetch['student_id'])){
    if($check_fetch['present'] === ''){
        echo "<i class='bi bi-x-octagon-fill text-danger'></i>";
    } else{
echo $check_fetch['present'];
    }
} else {
    echo "<i class='bi bi-x-octagon-fill text-danger'></i>";
}
?></span><br />
No of times Absent: <span class="text-success"><?php 
if(isset($check_fetch['student_id'])){
    if($check_fetch['absent'] === ''){
        echo "<i class='bi bi-x-octagon-fill text-danger'></i>";
    } else{
echo $check_fetch['absent'];
    }
} else {
    echo "<i class='bi bi-x-octagon-fill text-danger'></i>";
}
?> </span><br />
Year of Admission: <span class="text-success"><?= $fetch['year_of_admission']; ?></span><br />
</p>

<table class="table table-responsive">
    <tr>
    <th>Course</th>
        <th>C.A(40)</th>
        <th>Remarks</th>
        <th>Percentage</th>
        <th>Grade</th>
        <th><i class="bi bi-columns-gap"></i></th>
    </tr>
    <?php
    $admin_id = $_SESSION['admin'];
    $term = $_SESSION['term'];
    $session = $_SESSION['session'];

    $sql = "SELECT * FROM result where student_id=? AND term=? AND session=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('sss', $student_id, $term, $session);
    $stmt->execute();
    $result = $stmt->get_result();
    while($row = $result->fetch_assoc()){
        ?>
        <?php
    echo '
    <tr>
    <td>'. $row['course'] .'</td>
    <td>'. $row['test_score'] .'</td>
    <td>'. $row['cummulative'] .'</td>
    <td>'. floor($row['percentage']) .'</td>
    <td>'. $row['grade'] .'</td>
    <td><a href="admin-update-result2.php?unique_id='.$row['student_id'].'&student_course='.$row['course'].'&student_session='.$row['session'].'&student_term='.$row['term'].'&student_first_term_score='.$row['first_term_score'].'&student_second_term_score='.$row['second_term_score'].'&student_test_score='.$row['test_score'].'&student_exam_score='.$row['exam_score'].'"><i class="bi bi-pencil-square"></i></a><a href="admin-update-result2.php?unique_id='.$row['student_id'].'&student_course='.$row['course'].'&student_session='.$row['session'].'&student_term='.$row['term'].'&student_test_score='.$row['test_score'].'&student_exam_score='.$row['exam_score'].'"><i class="bi bi-archive text-danger"></i></a></td>
    </tr>
    ';
    }
    $stmt->close();

    ?>
</table>
<?php

$sql = "SELECT * FROM result where student_id=? AND term=? AND session=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('sss', $student_id, $term, $session);
$stmt->execute();
$result = $stmt->get_result();
$count = $result->num_rows;;
while($row = $result->fetch_assoc()){
    ?>
    <?php
    $total_score = $row['test_score'] + $total_score; 
    $percentage = $row['percentage'] + $percentage;
}

$stmt->close();

$class = $fetch['class'];
$sql = "SELECT * FROM users where class=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $class);
$stmt->execute();
$result = $stmt->get_result();
$no_of_class = $result->num_rows;

?>
<div class="container">
<h3 class="pt-2">Result Details</h3>
<p>Total Score: <span class="text-primary"><?php echo $total_score;  ?> / <?php echo $count * 40 ;  ?></span> <br />
Number in Class: <span class="text-primary"><?php echo $no_of_class;  ?></span> <br />
<?php $count_percentage = $percentage / $count; ?>
Percentage: <span class="text-success"><?php echo floor($count_percentage);  ?></span> <br />
Class Teacher's Comment: <span class="text-success"><?php 
if(isset($check_fetch['student_id'])){
    if($check_fetch['comment'] === ''){
        echo "<span class='text-danger'>No Comment</span>";
    } else{
echo $check_fetch['comment'];
    }
} else {
    echo "<i class='bi bi-x-octagon-fill text-danger'></i>";
}
?> </span><br />
Principal's Comment: <span class="text-success"><?php 
if(isset($check_fetch['student_id'])){
    if($check_fetch['principal_comment'] === ''){
        echo "<span class='text-danger'>No Principal Comment</span>";
    } else{
echo $check_fetch['principal_comment'];
    }
} else {
    echo "<i class='bi bi-x-octagon-fill text-danger'></i>";
}
?> <a href="principal-comment.php?student_id=<?php echo $student_id; ?>"><i class="bi bi-brush text-danger">Edit</i></a></span><br />
</p>

<?php
if(isset($_POST['approve-result'])){
    $sql = "UPDATE result SET approved='1' where student_id=? AND term=? AND session=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('sss', $student_id, $term, $session);
    if($stmt->execute()){
    $message = "Your result is ready for check for " . $term . " term and for " . $session . " Session";
     $notification_sql = "INSERT INTO notification (unique_id, message, time) VALUES(?,?,NOW())";
     $notification_stmt = $conn->prepare($notification_sql);
    $notification_stmt->bind_param('ss', $student_id, $message);
    if($notification_stmt->execute()){
        echo "<script>alert('The result has been approved');</script>";
    }
}
    
}
?>
<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
<button  class="btn btn-success text-white" name="approve-result">Approve Result</button>
</form>
<?php
/*if($ave_score >= 70){
    $grade = "A";
} elseif ($total_score >= 60 && $total_score < 70) {
    $grade = "B"; 
} elseif ($total_score >= 50 && $total_score < 60) {
    $grade = "C";
} elseif ($total_score >= 45 && $total_score < 50) {
    $grade = "D";
} elseif ($total_score >= 40 && $total_score < 45) {
    $grade = "E";
} elseif ($total_score < 40) {
    $grade = "F";
}*/
?>

</div>
</section>

<?php require "main-footer.php";
