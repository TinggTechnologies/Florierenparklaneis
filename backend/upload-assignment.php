<?php

$error = [];

if(isset($_POST['assignment-btn'])){

    $subject = trim($_POST['subject']);
    $subject = stripslashes($subject);
    $subject = htmlspecialchars($subject);

    $class = trim($_POST['class']);
    $class = stripslashes($class);
    $class = htmlspecialchars($class);

    $deadline = trim($_POST['deadline']);
    $deadline = stripslashes($deadline);
    $deadline = htmlspecialchars($deadline);

    if(empty($class) || empty($subject)){
        $error['file'] = "<div class='alert alert-danger'>No field should be empty</div>";
    }

    if(count($error) === 0){
        if(isset($_FILES['file'])){
        $file = $_FILES['file'];
        $fileName = $_FILES['file']['name']; 
        $fileTmp = $_FILES['file']['tmp_name'];
        $fileSize = $_FILES['file']['size'];
        $fileError = $_FILES['file']['error'];
        $fileType = $_FILES['file']['type'];
    
        $fileExt = explode('.', $_FILES['file']['name']);
        $fileActualExt = strtolower(end($fileExt));
        $allowed = array('pdf');
        if(in_array($fileActualExt, $allowed)){
            if($_FILES['file']['error'] === 0){
            if($_FILES['file']['size'] < 1000000000){
                $fileNameNew = time() . '.' . $fileActualExt;
                $fileDestination = 'uploads/'. $fileNameNew;
                if(move_uploaded_file($_FILES['file']['tmp_name'], $fileDestination)){
                    $staff_id = $_SESSION['staff'];
        $sql = "INSERT INTO assignment(staff_id, class, subject, assignment, deadline, date) VALUES(?,?,?,?,?,NOW())";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('sssss', $staff_id, $class, $subject, $fileDestination, $deadline);
        if($stmt->execute()){
            $_SESSION['assignment-class'] = $class;
            $_SESSION['assignment-subject'] = $subject;
            $admin_id = 'admin';
            $message = $_SESSION['staff_lastname'] . ' ' . $_SESSION['staff_firstname'] . " just uploaded an assignment to " . $_SESSION['staff_class'] . ' Class';
            $notification_sql = "INSERT INTO notification (unique_id, message, time) VALUES(?,?,NOW())";
            $notification_stmt = $conn->prepare($notification_sql);
            $notification_stmt->bind_param('ss', $admin_id, $message);
            if($notification_stmt->execute()){
            echo "<script>location.href = 'assignment-success.php';</script>";
        }
    } else{
        $error['file'] = "An error occurred, try again";
    
}               
                } else{
                    $error['file'] = "Not moved";
                }
            } else{
                $error['file'] = "Your file is too long";
            }}
            else{
                $error['file'] = "An error occured";
            }  }
            else{
                $error['file'] = "you cannot upload files of this file";
            }
        
    
        }    
        
    }

}

    

?>