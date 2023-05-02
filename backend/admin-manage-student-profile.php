<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once './PHPMailer/src/Exception.php';
require_once './PHPMailer/src/PHPMailer.php';
require_once './PHPMailer/src/SMTP.php';
require "./database/connection.php";

if(isset($_GET['student_id'])){
    $student_id = $_GET['student_id'];
}
$sql = "SELECT * FROM users WHERE student_id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $student_id);
$stmt->execute();
$result = $stmt->get_result();
if($result->num_rows > 0){
    $fetch_data = $result->fetch_assoc();
    $email = $fetch_data['email'];
    $firstname = $fetch_data['firstname'];
    $lastname = $fetch_data['lastname'];
    $_SESSION['lastname'] = $fetch_data['lastname'];
    $_SESSION['firstname'] = $fetch_data['firstname'];
    $_SESSION['student_class'] = $fetch_data['class'];
}
?>

<?php

if(isset($_POST['admin-approve-student'])){
    $student_id = $_POST['student_id'];
    $sql = "UPDATE users SET admin_verify='1', updated=NOW() WHERE student_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $student_id);
    if($stmt->execute()){
        $mail = new PHPMailer(true);
        $mail->SMTPDebug = 0;
        $mail->isSMTP();
        $mail->Host = 'mail.florierenparklaneis.com.ng';
        $mail->SMTPAuth = true;
        $mail->Username = "greatkin";
        $mail->Password = "Joseph@21";
        $mail->SMTPSecure = "ssl";
        $mail->Port = 465;
    
        $mail->From = "info@florierenparklaneis.com.ng";
        $mail->FromName = "Florieren Parklane International School";
    
        $mail->addAddress($email, $lastname . " " . $firstname);
    
        $mail->isHTML(true);
    
        $mail->Subject = "Verify Email Address.";
        $mail->Body = '<!doctype html>
        <html lang="en-US">
    
        <head>
            <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
            <title>Verify Email Address</title>
            <meta name="description" content="Verify Email Address">
            <style type="text/css">
                a:hover {text-decoration: underline !important;}
            </style>
        </head>
    
        <body marginheight="0" topmargin="0" marginwidth="0" style="margin: 0px; background-color: #f2f3f8;" leftmargin="0">
            <!--100% body table-->
            <table cellspacing="0" border="0" cellpadding="0" width="100%" bgcolor="#f2f3f8"
                style="@import url(https://fonts.googleapis.com/css?family=Rubik:300,400,500,700|Open+Sans:300,400,600,700); font-family: Open Sans, sans-serif;">
                <tr>
                    <td>
                        <table style="background-color: #f2f3f8; max-width:670px;  margin:0 auto;" width="100%" border="0"
                            align="center" cellpadding="0" cellspacing="0">
                            <br>
                            <tr>
                                <td style="text-align:center;">
                                <a href="https://florierenparklaneis.com.ng" title="logo" target="_blank">
                                    <img width="100" src="https://www.florierenparklaneis.com.ng/assets/img/florieren/logo.png" title="logo" alt="logo">
                                </a>
                                </td>
                            </tr>
                            <tr>
                                <td style="height:20px;">&nbsp;</td>
                            </tr>
                            <tr>
                                <td>
                                    <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0"
                                        style="max-width:670px;background:#fff; border-radius:3px; text-align:center;-webkit-box-shadow:0 6px 18px 0 rgba(0,0,0,.06);-moz-box-shadow:0 6px 18px 0 rgba(0,0,0,.06);box-shadow:0 6px 18px 0 rgba(0,0,0,.06);">
                                        <tr>
                                            <td style="height:40px;">&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td style="padding:0 35px;">
                                                
                                                
        <h3>Hello '.$lastname.'!</h3><br>
        <p>if you are seeing this, then your account has been successfully verified by Florieren Park Lane International School. you can Login now and access all the functionalities. Your Student Id is '.$fetch_data['student_id'].' and you need it with your password to login to your account.</p>
        <br>
        <p style="color: green">Mr Mike<br />
        School Administrator
        </p>
                                            </p>
                                                
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="height:40px;">&nbsp;</td>
                                        </tr>
                                    </table>
                                </td>
                            <tr>
                                <td style="height:20px;">&nbsp;</td>
                            </tr>
                            <tr>
                            <td style="text-align:center;">
                                    <p style="font-size:14px; color:rgba(69, 80, 86, 0.7411764705882353); line-height:18px; margin:0 0 0;">&copy; <strong><span></span></strong></p>
                                </td>
                            </tr>
                            <br>
                        </table>
                    </td>
                </tr>
            </table>
            <!--/100% body table-->
        </body>
    
        </html>';
        $mail->AltBody = "";
        if($mail->send()){
            $message = "Your account has been verified";
            $notification_sql = "INSERT INTO notification (unique_id, message, time) VALUES(?,?,NOW())";
            $notification_stmt = $conn->prepare($notification_sql);
            $notification_stmt->bind_param('ss', $student_id, $message);
            if($notification_stmt->execute()){
        header("location: admin-verified.php");
        }
    
    }
}
}

?>