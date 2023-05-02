<?php

$error = [];

$staff_id = $_SESSION['staff'];

if(isset($_GET['library_id'])){
    $library_id = $_GET['library_id'];
    }

if(isset($_POST['library-btn'])){

    $course = trim($_POST['course']);
    $course = stripslashes($course);
    $course = htmlspecialchars($course);

    $class = trim($_POST['class']);
    $class = stripslashes($class);
    $class = htmlspecialchars($class);

    $video = trim($_POST['video']);
    $video = stripslashes($video);
    $video = htmlspecialchars($video);

    $library_id = $_POST['library_id'];

    if(empty($course)){
        $error['course'] = "This field cannot be empty";
    }   

    if(empty($class)){
        $error['class'] = "This field cannot be empty";
    } 


    if(empty($video)){
        $error['video'] = "This field cannot be empty";
    } 
   
    if(count($error) === 0){
        $sql = "UPDATE video SET staff_id=?, course=?, class=?, link=?, updated=NOW() WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('sssss', $staff_id, $course, $class, $video, $library_id);
        if($stmt->execute()){
            $admin_id = "admin";
            $message = $_SESSION['staff_lastname'] . ' ' . $_SESSION['staff_firstname'] . " just updated " . $course . " course YouTube link to " . $class . ".";
            $notification_sql = "INSERT INTO notification (unique_id, message, time) VALUES(?,?,NOW())";
            $notification_stmt = $conn->prepare($notification_sql);
            $notification_stmt->bind_param('ss', $admin_id, $message);
            if($notification_stmt->execute()){
              echo '<script>location.href = "edit-video-success.php";</script>';
            exit();
            }
        } else{
            echo "error";
        }
    }
    
}