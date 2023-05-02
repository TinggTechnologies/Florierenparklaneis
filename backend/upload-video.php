<?php

$error = [];

$staff_id = $_SESSION['staff'];

if(isset($_POST['video-btn'])){

    $course = trim($_POST['course']);
    $course = stripslashes($course);
    $course = htmlspecialchars($course);

    $class = trim($_POST['class']);
    $class = stripslashes($class);
    $class = htmlspecialchars($class);

    $video = trim($_POST['video']);
    $video = stripslashes($video);
    $video = htmlspecialchars($video);

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
        $sql = "INSERT INTO video (staff_id, course, class, link, date) VALUES(?,?,?,?, NOW())";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ssss', $staff_id, $course, $class, $video);
        if($stmt->execute()){
            $_SESSION['library_course'] = $course;
            $_SESSION['library_class'] = $class;
            $admin_id = "admin";
            $message = $_SESSION['staff_lastname'] . ' ' . $_SESSION['staff_firstname'] . " just uploaded " . $course . " YouTube link to " . $class . " class.";
            $notification_sql = "INSERT INTO notification (unique_id, message, time) VALUES(?,?,NOW())";
            $notification_stmt = $conn->prepare($notification_sql);
            $notification_stmt->bind_param('ss', $admin_id, $message);
            if($notification_stmt->execute()){
              echo '<script>location.href = "video-success.php";</script>';
            exit();
            }
        } else{
            echo "error";
        }
    }
    
}