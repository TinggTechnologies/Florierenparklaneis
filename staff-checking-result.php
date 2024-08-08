
<?php
require "result-header.php";
$total_score = 0;
$percentage = 0;
?>
<link href='https://fonts.googleapis.com/css?family=Cinzel' rel='stylesheet'>
<style>
    span{
        font-weight: 700;
    }
    body{
        background: #fff;
    }
    table{
        line-height: .9rem;
    }
</style>
<?php
 $student_id = $_SESSION['student_id'];
 $sql = "SELECT * FROM users where student_id=?";
 $stmt = $conn->prepare($sql);
 $stmt->bind_param('s', $student_id);
 $stmt->execute();
 $result = $stmt->get_result();
 $fetch = $result->fetch_assoc();
?>

<section class="pt-1 min-vh-100">
<div class="d-flex align-items-center justify-content-center pt-4">
<img src="./assets/img/florieren/logo.png" width="40px" height="40px" alt=""> <h1 class="ms-3" style="line-height: 1; font-weight: bold; color: darkblue; font-size: 2.2rem;font-family: 'Cinzel';">FLORIEREN PARKLANE<br /><span class="text-black" style="font-size: 1.7rem; padding-left: .8rem;">INTERNATIONAL COLLEGE</span></h1>
</div>
<div class="container pt-1 text-left">
    <p style="text-align: center;">1, Alhaji Nasiru Sikiru Street,
Hilltop Estate, Aboru, Lagos State. <br />
    COMPREHENSIVE ANALYSIS OF ASSESSMENT IN THE THREE DOMAINS COGNITIVE PHYSCO-MOTOR AND AFFECTIVE
</p>
<p style="text-align: right;">Term: <span class="text-primary"><?php echo $_SESSION['term'] ?></span> <br />Session: <span class="text-primary"><?php echo $_SESSION['session'] ?></span></p>
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
<div style="display: flex; justify-content: space-between;">
<div>
<p style="text-align: left;">Name: <span class="text-primary"><?php echo $fetch['lastname'] .' '. $fetch['firstname']; ?></span><br />
Class: <span class="text-primary"><?php echo $fetch['class']; ?></span><br />
No of Times School Opened: <span class="text-primary"><?php 
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

No of Times Present: <span class="text-primary"><?php 
if(isset($check_fetch['student_id'])){
    if($check_fetch['present'] === ''){
        echo "<i class='bi bi-x-octagon-fill text-danger'></i>";
    } else{
echo $check_fetch['present'];
    }
} else {
    echo "<i class='bi bi-x-octagon-fill text-danger'></i>";
}
?><a href="present.php?student_id=<?php echo $student_id; ?>"><i class="bi bi-brush text-danger">Edit</i></a><?php //echo $_SESSION['class']; ?></span><br />
No of times Absent: <span class="text-primary"><?php 
if(isset($check_fetch['student_id'])){
    if($check_fetch['absent'] === ''){
        echo "<i class='bi bi-x-octagon-fill text-danger'></i>";
    } else{
echo $check_fetch['absent'];
    }
} else {
    echo "<i class='bi bi-x-octagon-fill text-danger'></i>";
}
?> <a href="absent.php?student_id=<?php echo $student_id; ?>"><i class="bi bi-brush text-danger">Edit</i></a></span><br />
Year of Admission: <span class="text-primary"><?= $fetch['year_of_admission']; ?></span><br />

</p>
</div>
<div>
    <img style="height: 10rem;" src="./uploads/<?= $fetch['image']; ?>" />
</div>    
</div>
<table class="table table-responsive table-bordered">
    <tr>
        <th>SUBJECT</th>
        <th>C.A(40)</th>
        <th>REMARKS</th>
        <th>PERCENTAGE (%)</th>
        <th>GRADE</th>
        <th><i class="bi bi-columns-gap"></i></th>
    </tr>
    <?php
    $staff_id = $_SESSION['staff'];
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
    <td><a href="staff-update-result.php?unique_id='.$row['student_id'].'&student_course='.$row['course'].'&student_session='.$row['session'].'&student_term='.$row['term'].'&student_first_term_score='.$row['first_term_score'].'&student_second_term_score='.$row['second_term_score'].'"><i class="bi bi-pencil-square"></i></a></td>
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
$count = $result->num_rows;
while($row = $result->fetch_assoc()){
    ?>
    <?php
    $total_score = $row['test_score'] + $total_score; 
    $percentage = $row['percentage'] + $percentage;

}
$stmt->close();

$count_class = $_SESSION['staff_class'];
$sql = "SELECT * FROM users where class=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $count_class);
$stmt->execute();
$result = $stmt->get_result();
$no_of_class = $result->num_rows;

?>
<div class="container">
<h3 class="pt-2">Result Details</h3>
<p>Total Score: <span class="text-primary"><?php echo $total_score;  ?> / <?php echo $count * 40 ;  ?></span> <br />
Number in Class: <span class="text-primary"><?php echo $no_of_class;  ?></span> <br />
<?php $count_percentage = $percentage / $count; ?>
Percentage: <span class="text-primary"><?php echo floor($count_percentage);  ?>%</span> <br />
Class Teacher's Comment: <span class="text-primary"><?php 
if(isset($check_fetch['student_id'])){
    if($check_fetch['comment'] === ''){
        echo "<span class='text-danger'>No Comment</span>";
    } else{
echo $check_fetch['comment'];
    }
} else {
    echo "<i class='bi bi-x-octagon-fill text-danger'></i>";
}
?> <a href="teacher-comment.php?student_id=<?php echo $student_id; ?>"><i class="bi bi-brush text-danger">Edit</i></a></span><br />
Principal's Remark: <span class="text-primary"><?php 
if(isset($check_fetch['student_id'])){
    if($check_fetch['principal_comment'] === ''){
        echo "<span class='text-danger'>No Comment</span>";
    } else{
echo $check_fetch['principal_comment'];
    }
} else {
    echo "<i class='bi bi-x-octagon-fill text-danger'></i>";
}
?></span>

</p>
<button  class="btn btn-primary text-white" id="print">Print Result</button>
</div>

</div>
</section>
<script>
    const printBtn = document.querySelector('#print');
    printBtn.onclick = () =>{
        printBtn.style.display = 'none';
        print();
    }
    
</script>
<?php require "result-footer.php"; ?>