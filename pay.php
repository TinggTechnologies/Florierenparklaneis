<?php require "student-header.php"; 
require "backend/school-fees.php";
?>

<div class="row justify-content-center">

<!-- Left side columns -->
<div class="col-lg-4">

<section class="signup py-5 mt-4">

<div class="container">
<nav>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="student-dashboard.php"><i class="bi bi-house-door"></i></a></li>
        <li class="breadcrumb-item"><a href="#">Pay Fees <i class="bi bi-receipt-cutoff" style="font-size: 1.2rem;"></i></a></li>
                </ol>
  </nav>
  
  <?php
          $staff_id = $_SESSION['student'];
          $sql = "SELECT * FROM users WHERE student_id=? AND admin_verify='1'";
          $stmt = $conn->prepare($sql);
          $stmt->bind_param('s', $staff_id);
          $stmt->execute();
          $result = $stmt->get_result();
          if($result->num_rows > 0){
            ?>

              <?php
              $sql1 = "SELECT * FROM account";
              $stmt1 = $conn->prepare($sql1);
              $stmt1->execute();
              $result1 = $stmt1->get_result();
              if($result1->num_rows > 0){
                $row1 = $result1->fetch_assoc();
              }
              ?>

                   <div class="container text-center">
                <img src="./assets/img/florieren/smart2.png" style="height : 20rem;" class="img-fluid" alt="">
              </div>

              <div class="container pt-4">
                <a href="paystack.php" class="btn btn-success form-control" style="border-radius: 15px;">Pay Online</a>
                <a href="./school-fees.php" class="btn btn-success form-control mt-3" style="border-radius: 15px;">Upload Receipt</a>
              </div>

 
   <?php

            } else{
          ?>

            <!-- Sales Card -->
            <div class="row justify-content-center">
            <div class="col-md-12">
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
                  <span class="text-danger">You can't access anything here until the admin verifies your account. We will send you an email immediately after your account has been verified.</span>. 
                  </p>
                 
                </div>
              </div>
            </div>
          </div><!-- End Card with an image on left -->

         <?php
        
        }?>
</div>
</section>


<?php require "main-footer.php"; ?>