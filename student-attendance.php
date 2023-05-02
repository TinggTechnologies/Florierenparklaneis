<?php require "student-header.php"; 
require "backend/school-fees.php";
?>

<div class="row justify-content-center">

<!-- Left side columns -->
<div class="col-md-12">

<section class="signup py-5 mt-4">

<div class="container">
<nav>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="student-dashboard.php"><i class="bi bi-house-door"></i></a></li>
        <li class="breadcrumb-item"><a href="#">Attendance <i class="bi bi-receipt-cutoff" style="font-size: 1.2rem;"></i></a></li>
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
$first_counter = null;
$second_counter = null;
$third_counter = null;

$sql1 = "SELECT * FROM student_attendance WHERE student_id='$staff_id' AND term='first'";
$stmt1 = $conn->prepare($sql1);
$stmt1->execute();
$result1 = $stmt1->get_result();
if($result1->num_rows > 0){
   $first_counter = $result1->num_rows;
   
}
if($first_counter == 0){
  $first_counter = 0;
 }

 $sql1 = "SELECT * FROM student_attendance WHERE student_id='$staff_id' AND term='second'";
$stmt1 = $conn->prepare($sql1);
$stmt1->execute();
$result1 = $stmt1->get_result();
if($result1->num_rows > 0){
   $second_counter = $result1->num_rows;
   
}
if($second_counter == 0){
  $second_counter = 0;
 }

 $sql1 = "SELECT * FROM student_attendance WHERE student_id='$staff_id' AND term='third'";
$stmt1 = $conn->prepare($sql1);
$stmt1->execute();
$result1 = $stmt1->get_result();
if($result1->num_rows > 0){
   $third_counter = $result1->num_rows;
   
}
if($third_counter == 0){
  $third_counter = 0;
 }

 $session_sql = "SELECT * FROM set_session_tbl WHERE set_session_id='1'";
 $session_stmt = $conn->prepare($session_sql);
 $session_stmt->execute();
 $session_result = $session_stmt->get_result();
 if($session_result->num_rows > 0){
   $session_row = $session_result->fetch_assoc();
   $session = $session_row['set_session'];
 }
?>

                    <main id="main" class="main mt-0">

    <div class="pagetitle">
      <h1>Attendance Statistics</h1>
    </div><!-- End Page Title -->

    <p>Dear <span class="text-success"><?php echo $_SESSION['lastname']; ?></span>: <br /> you can check attendance chart for this Academic Session</p>

    <section class="section">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Attendance Chart [<?= $session; ?>]</h5>

              <!-- Line Chart -->
              <div id="lineChart"></div>

              <script>
                document.addEventListener("DOMContentLoaded", () => {
                  new ApexCharts(document.querySelector("#lineChart"), {
                    series: [{
                      name: "Attendance",
                      data: [<?= $first_counter; ?>, <?= $second_counter; ?>, <?= $third_counter; ?>]
                    }],
                    chart: {
                      height: 350,
                      type: 'line',
                      zoom: {
                        enabled: false
                      }
                    },
                    dataLabels: {
                      enabled: false
                    },
                    stroke: {
                      curve: 'straight'
                    },
                    grid: {
                      row: {
                        colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
                        opacity: 0.5
                      },
                    },
                    xaxis: {
                      categories: ['First Term', 'Second Term', 'Third Term'],
                    }
                  }).render();
                });
              </script>
              <!-- End Line Chart -->

            </div>
          </div>

    </section>
    


   <?php

            } else{
          ?>

            <!-- Sales Card -->
            <div class="row justify-content-center">
            <div class="col-md-6">
              <div class="card info-card sales-card">

                <div class="card-body">

                  <div class="row g-0">
                    <div class="col-md-4">
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