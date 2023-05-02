<?php

$error = [];

if(isset($_POST['class-timetable-btn'])){

    $timetable = trim($_POST['timetable']);
    $timetable = stripslashes($timetable);
    $timetable = htmlspecialchars($timetable);


    if(empty($timetable)){
        $error['timetable'] = "This field cannot be empty";
    }

    if(count($error) === 0){
        $staff_id = $_SESSION['staff'];
        $class = $_SESSION['staff_class'];
        $sql = "INSERT INTO class_timetable(staff_id, class, timetable, date) VALUES(?,?,?,NOW())";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('sss', $staff_id, $class, $timetable);
        if($stmt->execute()){
            $sql_email = "SELECT * FROM users WHERE class=?";
            $stmt_email = $conn->prepare($sql_email);
            $stmt_email->bind_param('s', $class);
            if($stmt_email->execute()){
                $result = $stmt_email->get_result();
                if($result->num_rows > 0){
                    while($row = $result->fetch_assoc()){
                        $email = $row['email'];
                        $from = "email@florierenparklaneis.com.ng";
        $header = "Mime-Version: 1.0" . "\r\n";
        $header .= "Content-Type: text/html; charset=utf-8" . "\r\n";
        $header .= "From: " . $from;
        $top = "Florieren ParkLane";
        $body = '
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Document</title>
        </head>
        <body>
            <h2>Hi, <span style="color: green;">'.$fetch_data['lastname'].'</span></h2>
            <p style="font-size: 22px;">The time table of '.$class.' class has been updated, check the website for more information.
            </p>
            <p style="color: green">Mr Mike<br />
            School Administrator
            </p>
        </body>
        </html>
        ';
        mail($email, $top, $body, $header);

                    }
                }
            }
            
        }
        $_SESSION['timetable-class'] = $class;
        header("location: class-timetable-success.php");
            
           
        }
    }



?>