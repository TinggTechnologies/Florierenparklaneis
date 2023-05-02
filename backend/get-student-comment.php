<?php
session_start();

require "../database/connection.php";

if(isset($_GET['comment_id'])){
    $comment_id = $_GET['comment_id'];
 }
    
    $comment = $_POST['comment'];
    $comment_id = $_POST['comment_id'];
    $unique_id = $_SESSION['student'];

    $sql = "INSERT INTO comment(post_id, comment, unique_id,date) VALUES(?,?,?,NOW());";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('sss', $comment_id, $comment, $unique_id);
    $stmt->execute();


?>