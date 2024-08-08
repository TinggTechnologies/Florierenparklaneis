<?php
session_start();
require "../database/connection.php";
if(isset($_GET['comment_id'])){
    $comment_id = $_GET['comment_id'];
 }


$comment = $_POST['comment'];
$comment_id = $_POST['comment_id'];

$sql = "SELECT * FROM comment WHERE post_id='$comment_id'";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();
if($result->num_rows > 0){
  while($fetch = $result->fetch_assoc()){
    $user_id = $fetch['unique_id'];
    if(substr($user_id, 0, 3) === 'sta' || substr($user_id, 0, 1) === 'a'){
        $sql1 = "SELECT * FROM staff WHERE unique_id='$user_id'";
    }
    else{
        $sql1 = "SELECT * FROM users WHERE student_id='$user_id'";
    }
    $stmt1 = $conn->prepare($sql1);
        $stmt1->execute();
        $result1 = $stmt1->get_result();
        if($result1->num_rows > 0){
            $fetch_result = $result1->fetch_assoc();

echo '
<div class="row justify-content-center">

<div class="col-lg-4">
<div class="comment_area bg-white mb-2 pb-4">
    <div class="row ps-2">
        <div class="col-lg-12 d-flex pt-3 ">
            <img src="uploads/'.$fetch_result['image'].'" style="width: 40px; height: 40px; border-radius: 20px;" alt="">
            <div class="comment-text ms-3">
                <h5>'.$fetch_result['lastname']. ' ' . $fetch_result['firstname'] .'</h5>
                <p>'.$fetch['comment'].'</p>
                <small>'.$fetch['date'].'</small>
            </div>
        </div>
    </div>
</div>
</div>
</div>

';

} }} else {
    echo "<div class='text-center text-danger'>No message</div>";
}