<?php

require "student-header.php";
$total_score = 0;
$percentage = 0;
?>


<section class="signup py-4">
<h1 class="text-center pt-5 text-success">Florieren Park Lane</h1>
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
<p style="text-align: right;">Term: <span class="text-success"><?php echo $_SESSION['term'] ?></span> <br />Session: <span class="text-success"><?php echo $_SESSION['session'] ?></span></p>

<p style="text-align: left;">Name: <span class="text-success"><?= $_SESSION['lastname']; ?> <?= $_SESSION['firstname']; ?></span><br />
Class: <span class="text-success"><?php echo $_SESSION['class']; ?></span><br />
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
Year of Admission: <span class="text-success"><?= $row['year_of_admission']; ?></span><br />
</p>

</p>

<table class="table table-responsive">
    <tr>
        <th>Course</th>
        <th>IST Term Scores(100)</th>
        <th>2ND Term Scores(100)</th>
        <th>C.A(40)</th>
        <th>Exam(60)</th>
        <th>Total(100)</th>
        <th>Cummulative</th>
        <th>Percentage</th>
        <th>Grade</th>
    </tr>
    <?php
    $student_id = $_SESSION['student'];
    $term = $_SESSION['term'];
    $session = $_SESSION['session'];

    $sql = "SELECT * FROM result where student_id=? AND term=? AND session=? AND approved='1'";
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
    <td>'. $row['first_term_score'] .'</td>
    <td>'. $row['second_term_score'] .'</td>
    <td>'. $row['test_score'] .'</td>
    <td>'. $row['exam_score'] .'</td>
    <td>'. $row['total_score'] .'</td>
    <td>'. $row['cummulative'] .'</td>
    <td>'. floor($row['percentage']) .'</td>
    <td>'. $row['grade'] .'</td>
    </tr>
    ';
    }
    $stmt->close();

    ?>
</table>
<?php

$sql = "SELECT * FROM result where student_id=? AND term=? AND session=? AND approved='1'";
$stmt = $conn->prepare($sql);
$stmt->bind_param('sss', $student_id, $term, $session);
$stmt->execute();
$result = $stmt->get_result();
$count = $result->num_rows;
while($row = $result->fetch_assoc()){
    ?>
    <?php
    $total_score = $row['total_score'] + $total_score; 
    $percentage = $row['percentage'] + $percentage;

}

$stmt->close();

$count_class = $_SESSION['class'];
$sql = "SELECT * FROM users where class=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $count_class);
$stmt->execute();
$result = $stmt->get_result();
$no_of_class = $result->num_rows;

?>
<div class="container">
<h3 class="pt-2">Result Details</h3>
<p>Total Score: <span class="text-success"><?php echo $total_score;  ?></span> <br />
Number in Class: <span class="text-success"><?php echo $no_of_class;  ?></span> <br />
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
?> </span><br />
</p>


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
