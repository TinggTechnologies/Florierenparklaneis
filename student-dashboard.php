
<?php
require "student-header.php"; 
?>
<style>
  .active{
    display: none;
  }

</style>
<div class="container mt-5 pt-4">
<?php
$staff_id = $_SESSION['student'];
$birthday_sql = 'SELECT * FROM users WHERE student_id=?';
$birthday_stmt = $conn->prepare($birthday_sql);
$birthday_stmt->bind_param('s', $staff_id);
$birthday_stmt->execute();
$get_birthday_stmt_data = $birthday_stmt->get_result();
if($get_birthday_stmt_data->num_rows > 0){
  $birthday_row = $get_birthday_stmt_data->fetch_assoc();
}

date_default_timezone_set("Africa/Lagos");
$now = Date('Y-m-d');
$birth = substr($now, 5);

$student_birthday = substr($birthday_row['date_of_birth'], 5);
$student_email = $birthday_row['email'];
$fullname = $birthday_row['lastname'] . ' ' . $birthday_row['firstname'];


if($student_birthday === $birth){

  $from = "email@florierenparklaneis.com.ng";
  $header = "Mime-Version: 1.0" . "\r\n";
  $header .= "Content-Type: text/html; charset=utf-8" . "\r\n";
  $header .= "From: " . $from;
  $top = "Happy Birthday " . $fullname;
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
      <title>Birthday Wishes</title>

  </head>
  <body style="font-size: 22px;">
      <div class="container">
          <div class="text-center my-3">
          <img src="https://www.florierenparklaneis.com.ng/index/assets/img/florieren/logo.png" class="img-fluid" alt="">
          </div>
          <h2>Happy Birthday <span style="font-size: 25px; color: green;">'.$lastname.'</span></h2>
          <p>"Hope all your birthday wishes come true! its your special day - get out there and celebrate! wishing you the biggest slice of happy today. I hope your celebration gives you many happy memories! Our age is merely the number of years the world has been enjoying us!"</p>

          <p>Thank you for your time with us <br /><br /><br />
          Florieren Parklane International School
      </p>

      </div>
      <script src="https://www.florierenparklaneis.com.ng/index/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  </body>
  </html>
  ';
  mail($student_email, $top, $body, $header); 
}



?>


  <nav>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="student-dashboard.php"><i class="bi bi-house-door"></i></a></li>
        <li class="breadcrumb-item"><a href="#" style="font-size: 1.5rem;">Hi, <span class="text-success"><?= $_SESSION['lastname']; ?></span></a></li>
                </ol>

  </nav>

</div>

  <main id="main" class="main mt-0 pt-0">

    <section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-12">
          <div class="row">

          <?php
          $sql = "SELECT * FROM users WHERE student_id=? AND admin_verify='1'";
          $stmt = $conn->prepare($sql);
          $stmt->bind_param('s', $staff_id);
          $stmt->execute();
          $result = $stmt->get_result();
          if($result->num_rows > 0){
?>
<div class="feed-wrapper">

</div>
<?php
            }
          else{
          ?>

            <!-- Sales Card -->
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card sales-card">

                <div class="card-body">

                  <div class="row g-0">
                    <div class="col-lg-4">
                      <!-- Slides with controls -->
              <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                  <div class="carousel-item active">
                  <img  src="./assets/img/florieren/blog1.jpg" class="img-fluid rounded-start img-responsive mt-3" style="width: 100%;" alt="...">
                  </div>
                  <div class="carousel-item">
                  <img  src="./assets/img/florieren/blog3.jpg" class="img-fluid rounded-start img-responsive mt-3" style="width: 100%;" alt="...">
                  </div>
                  <div class="carousel-item">
                  <img  src="./assets/img/florieren/blog4.jpg" class="img-fluid rounded-start img-responsive mt-3" style="width: 100%;" alt="...">
                  </div>
                  <div class="carousel-item">
                  <img  src="./assets/img/florieren/event4.jpg" class="img-fluid rounded-start img-responsive mt-3" style="width: 100%;" alt="...">
                  </div>
                  <div class="carousel-item">
                  <img  src="./assets/img/florieren/event1.jpg" class="img-fluid rounded-start img-responsive mt-3" style="width: 100%;" alt="...">
                  </div>
                </div>

                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Next</span>
                </button>

              </div><!-- End Slides with controls -->
                    </div>
                    <p class="card-text pt-3">Hi <span style="color: green;"><?php echo $row['lastname']; ?></span>, Florieren Parklane International School welcomes you to this platform, it is no news that the world is going digital and we have also decided to join the trend and we employ every Parent to join us with this new development. <br />
                  <span class="text-danger">You can't access anything here until the admin verifies your account. We will send you an email immediately after your account has been verified. <br />
                  for the admin to know you are the one, click on the profile page and update your profile. Make sure the student picture, parent picture and all the biodata are uploaded.
                                </span>
                  </p>
                  <a href="student-profile.php" class="btn btn-success" style="border-radius: 15px;">Update Profile</a>
                 
                </div>
              </div>
            </div>
          </div><!-- End Card with an image on left -->

         <?php
        
        }?>

         
        </div><!-- End Right side columns -->

      </div>
    </section>

  </main><!-- End #main -->

  <?php
if(isset($_POST['like-btn'])){

  $sql = "INSERT INTO likes(post_id, date) VALUES(?,NOW())";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param('s', $comment_id);
  $stmt->execute();
}

?>

  <?php require "main-footer.php"; ?>

  <script>
    $(document).ready(function(){
        fetch_user();

        setInterval(function(){
            fetch_user();
        }, 5000);

        function fetch_user(){
            $.ajax({
                url:"backend/fetch-post.php",
                method: "POST",
                success: function(data){
                    $(".feed-wrapper").html(data);
                }
            });
        }
    });
   </script>