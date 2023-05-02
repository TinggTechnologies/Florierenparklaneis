<?php

$error = array();

if(isset($_POST['bulk-btn'])){

    $user = trim($_POST['user']);
    $user = stripslashes($user);
    $user = htmlspecialchars($user);

    $message = trim($_POST['message']);
    $message = stripslashes($message);
    $message = htmlspecialchars($message);


    if(empty($user)){
        $error['user'] = "This field cannot be empty";
    }

    if(empty($message)){
        $error['message'] = "This field cannot be empty";
    } 

    

    if(count($error) === 0){
        $admin_id = $_SESSION['admin'];

            $sql = "INSERT INTO bulk_message (sender, receiver, message, date) VALUES('$admin_id', '$user', '$message', NOW())";
            $stmt = $conn->prepare($sql);
            if($stmt->execute()){

               if($user === "staff"){
                $user_sql = "SELECT * FROM staff";
               } else {
                $user_sql = "SELECT * FROM users";
               } 
               $user_stmt = $conn->prepare($user_sql);
               $user_stmt->execute();
               $user_result = $user_stmt->get_result();
               if($user_result->num_rows > 0){
                  while($user_row = $user_result->fetch_assoc()){

                    $from = "email@florierenparklaneis.com.ng";
                    $header = "Mime-Version: 1.0" . "\r\n";
                    $header .= "Content-Type: text/html; charset=utf-8" . "\r\n";
                    $header .= "From: " . $from;
                    $top = "Message from Florieren ParkLane School";
                    $email = $user_row['email'];
                    $body = '
                    <!DOCTYPE html>
                    <html lang="en">
                    <head>
                        <meta charset="UTF-8">
                        <meta http-equiv="X-UA-Compatible" content="IE=edge">
                        <meta name="viewport" content="width=device-width, initial-scale=1.0">
                        <!-- Favicons -->
                        <link href="https://www.florierenparklaneis.com.ng/index/assets/img/favicon.png" rel="icon">
                        <link href="https://www.florierenparklaneis.com.ng/index/assets/img/apple-touch-icon.png" rel="apple-touch-icon">
                        <!-- Google Fonts -->
                        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
                        <link href="https://www.florierenparklaneis.com.ng/index/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
                        <title>Message from Florieren ParkLane School</title>

                    </head>
                    <body style="font-size: 22px;">
                        <div class="container">
                            <div class="text-center my-3">
                            <img src="https://www.florierenparklaneis.com.ng/index/assets/img/florieren/logo.png" class="img-fluid" alt="">
                            </div>
    
                            <p>'.$message.'</p>

                            <p>Thank you for your time with us <br /><br /><br />
                            Florieren ParkLane International School
                        </p>

                        </div>
                        <script src="https://www.florierenparklaneis.com.ng/index/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
                    </body>
                    </html>
                    ';
                    mail($email, $top, $body, $header); 
                    }

                        }
                        }
                        
            $_SESSION['user'] = $user;
            $message = $_SESSION['admin_lastname'] . ' ' . $_SESSION['admin_firstname']." just sent you a message on your email box, check it out";
            if($user === "staff"){
                $student_id = "staff";
            } else {
                $student_id = "student";
            }
            $notification_sql = "INSERT INTO notification (unique_id, message, time) VALUES(?,?,NOW())";
            $notification_stmt = $conn->prepare($notification_sql);
            $notification_stmt->bind_param('ss', $student_id, $message);
            if($notification_stmt->execute()){
            echo "<script>location.href = 'bulk-success.php';</script>";
            }
    }    
    }




