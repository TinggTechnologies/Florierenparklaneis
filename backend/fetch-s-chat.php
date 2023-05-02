<?php

session_start();
include "../database/connection.php";

if(isset($_SESSION['student'])){ 
    $student_id = $_SESSION['student'];
}
$error = [];
$output = '';

$message = trim($_POST['message']);
$message = htmlspecialchars($message);
$message = stripslashes($message);

$incoming_id = $_POST['incoming_id'];

$outgoing_id =  $_POST['outgoing_id'];

$sql1 = "SELECT * FROM messages WHERE (outgoing_id = '$outgoing_id' AND incoming_id='$incoming_id') OR (outgoing_id='$incoming_id' AND incoming_id='$outgoing_id')";
$stmt1 = $conn->prepare($sql1);
$stmt1->execute();
$result = $stmt1->get_result();
if($result->num_rows > 0){
$sql3 = "UPDATE messages SET alert = '1' WHERE incoming_id='$outgoing_id' AND outgoing_id='$incoming_id' AND alert != '1'";
$stmt3 = $conn->prepare($sql3);
$stmt3->execute();
while($fetch = $result->fetch_assoc()){
if($fetch['outgoing_id'] === $outgoing_id){
    echo '
    <div class="chat outgoing">
<div class="details">
<p>'.$fetch['message'].'</p>
</div>
</div>
    ';
} else{
    echo '
    <div class="chat incoming">
<div class="details">
<p>'.$fetch['message'].'</p>
</div>
</div>
    ';
}
}
}
if($result->num_rows === 0){
echo "<div class='text-center mt-5 pt-5 fw-bold'>No Message</div>";
}