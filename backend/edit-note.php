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

    $library_id = $_POST['library_id'];

    if(empty($course)){
        $error['course'] = "This field cannot be empty";
    }   

    if(empty($class)){
        $error['class'] = "This field cannot be empty";
    } 


    if(isset($_FILES['file'])){
        $file = $_FILES['file'];
        $fileName = $_FILES['file']['name']; 
        $fileTmp = $_FILES['file']['tmp_name'];
        $fileSize = $_FILES['file']['size'];
        $fileError = $_FILES['file']['error'];
        $fileType = $_FILES['file']['type'];
    
        $fileExt = explode('.', $_FILES['file']['name']);
        $fileActualExt = strtolower(end($fileExt));
        $allowed = array('jpg', 'png','pdf');
        if(in_array($fileActualExt, $allowed)){
            if($_FILES['file']['error'] === 0){
            if($_FILES['file']['size'] < 2000000){
                $fileNameNew = time() . '.' . $fileActualExt;
                $fileDestination = 'uploads/'. $fileNameNew;
                if(move_uploaded_file($_FILES['file']['tmp_name'], $fileDestination)){
                $_SESSION['file'] = $fileNameNew;
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

   
    if(count($error) === 0){
        $sql = "UPDATE lesson_note SET staff_id=?, subject=?, class=?, lesson_note=?, updated=NOW() WHERE lesson_note_id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('sssss', $staff_id, $course, $class, $fileNameNew, $library_id);
        if($stmt->execute()){
              echo '<script>location.href = "edit-note-success.php";</script>';
            exit();
            }
        } else{
            echo "error";
        }
    
    
}