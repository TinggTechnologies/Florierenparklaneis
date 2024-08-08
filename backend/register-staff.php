<?php
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once '../PHPMailer/src/Exception.php';
require_once '../PHPMailer/src/PHPMailer.php';
require_once '../PHPMailer/src/SMTP.php';
require "../database/connection.php";


if(isset($_POST['submit_btn'])){

    $firstname = trim($_POST['firstname']);
    $firstname = stripslashes($firstname);
    $firstname = htmlspecialchars($firstname);

    $lastname = trim($_POST['lastname']);
    $lastname = stripslashes($lastname);
    $lastname = htmlspecialchars($lastname);

    $email = trim($_POST['email']);
    $email = stripslashes($email);
    $email = htmlspecialchars($email);

    $telephone = trim($_POST['telephone']);
    $telephone = stripslashes($telephone);
    $telephone = htmlspecialchars($telephone);

    $class = $_POST['class'];

        $unique_id = 'staff/'. date('Y'). '/' . bin2hex(random_bytes(2));
        $verify_email = strtolower(bin2hex(random_bytes(4)));
        $verified = '0';
        
        $image = "image.png";
        $sql = "INSERT INTO staff (unique_id, firstname, lastname, email, telephone, class, image, admin_verify, email_verify, v_email, date) VALUES(?,?,?,?,?,?,?,?,?,?, NOW())";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ssssssssss', $unique_id, $firstname, $lastname, $email, $telephone, $class, $image, $verified, $verify_email, $verified);
        if($stmt->execute()){
            $_SESSION['staff'] = $unique_id;
            $_SESSION['staff_firstname'] = $firstname;
            $_SESSION['staff_lastname'] = $lastname;
            $_SESSION['staff_email'] = $email;
            $_SESSION['staff_telephone'] = $telephone;
            $_SESSION['staff_class'] = $class;
            $_SESSION['staff_verify_email'] = $verify_email;
            $_SESSION['staff_verify_staff'] = $verified;

            $admin_id = 'admin';
            $message = $_SESSION['staff_lastname'] . ' ' . $_SESSION['staff_firstname'] . ", registered with Florieren Parklane" . $_SESSION['staff_class'] . ' Class';
            $notification_sql = "INSERT INTO notification (unique_id, message, time) VALUES(?,?,NOW())";
            $notification_stmt = $conn->prepare($notification_sql);
            $notification_stmt->bind_param('ss', $admin_id, $message);
            if($notification_stmt->execute()){
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
                welcome to Florieren Parklane International School. we are really excited to have you to join our community! your Student Id is '.$unique_id.', you need it with your password to have access to your account.</em><br>
                <br>
                <p>please feel free to reach us on the contact below if you have any questions or if there is anything else we can help with(09048480552).</p>
                <br>
                                                    </p>
                                                        
                        <a href="#" style="background:#20e277;text-decoration:none !important; font-weight:500; margin-top:35px; color:#fff;text-transform:uppercase; font-size:14px;padding:10px 24px;display:inline-block;border-radius:50px;"> <span>Your six verification code is '.$verify_email.'</span></a>
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
                $mail->send();
        
        }} else{
            echo "<div class='alert alert-danger'>An error occured, try again</div>";
        }
}
    


