<?php
require_once "student-header.php"; 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once './PHPMailer/src/Exception.php';
require_once './PHPMailer/src/PHPMailer.php';
require_once './PHPMailer/src/SMTP.php';

$error = [];
$email = $row['email'];
$firstname = $row['firstname'];
$lastname = $row['lastname'];
$verify_email = $row['email_verify'];
$student_id = $row['student_id'];

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
welcome to Florieren Parklane International School. we are really excited to have you to join our community! your Student Id is '.$student_id.', you need it with your password to have access to your account.</em><br>
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
if($mail->send()){


if(isset($_POST['verify-email'])){
  $verify_email = $_POST['code'];

  if(empty($verify_email)){
    $error['error'] = "<div class='alert alert-danger'>This field cannot be empty</div>";
  }

  if(count($error) == 0){
    $staff = $_SESSION['student'];
  $code = $row['email_verify'];
$sql = "SELECT * FROM users WHERE student_id=? LIMIT 1";
$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $staff);
$stmt->execute();
$result = $stmt->get_result();
if($result->num_rows > 0){
  $fetch = $result->fetch_assoc();
  
  if($fetch['email_verify'] === $verify_email){
    $sql1 = "UPDATE users SET v_email='1' WHERE student_id='$staff'";
    $stmt1 = $conn->prepare($sql1);
    if($stmt1->execute()){
    
              echo "<script>location.href = 'student-email-verified.php';</script>";
          } }else{
            $error['error'] = "<div class='alert alert-danger'>The code does not match</div>";
          }
        } else{
          $error['error'] = "<div class='alert alert-danger'>No user like that</div>";
        }
        }
      }
        
    }
?>

<main>

    <div class="container">
    <section class="section pt-5 mt-5">
      <div class="row d-flex flex-column align-items-center justify-content-center">
        <div class="col-lg-6">
        <div class="text-center">
        <i class="bi bi-envelope" style="font-size: 3rem; color: green;"></i>
        </div>
              <h2 class="card-title text-center pb-3" style="font-size: 1.5rem;">Verify Email</h2>
              <p class="text-center"><span style="color: green;"><?php  if(isset($_SESSION['lastname'])){
                echo $_SESSION['lastname'];
              } else{
                echo "Hello";
              } ?></span>, We just sent your authentication code via email to <?= substr($email, 0, 1); ?>*******@gmail.com<br />
            </p>
              <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
              <div class="text-center">
                <?php
                if(isset($error['error'])){
                  echo $error['error'];
                }
                ?>
              </div>
              <label for="code" class="mb-2">Device Verification Code</label>
              <input type="text" name="code" id="code" class="form-control" placeholder="Enter 8 digit Code">
              <input type="hidden" value="<?= $row['email_verify']; ?>">
              <button type="submit" class="btn w-100 mt-2 mb-5 mt-4" name="verify-email" style="background-color: green; color: #fff; border-radius: 15px;">Verify Email</button>
            </form>

        </div>

      </div>
    </section>
    </div>

  </main><!-- End #main -->

  <?php require "main-footer.php"; ?>