<?php require "main-header.php"; ?>


<main id="main" class="main">
<?php
          $staff_id = $_SESSION['staff'];
          $sql = "SELECT * FROM staff WHERE unique_id=? AND admin_verify='1'";
          $stmt = $conn->prepare($sql);
          $stmt->bind_param('s', $staff_id);
          $stmt->execute();
          $result = $stmt->get_result();
          if($result->num_rows > 0){

            ?>

    <div class="pagetitle">
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
          <li class="breadcrumb-item">Timetable Editor</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">

        <div class="col-lg-6">

          <div class="card text-center">
            <div class="card-body">
            <div class="text-center py-3">
              <i class="bi bi-exclamation-circle text-success" style="font-size: 2.5rem;"></i>
              </div>
              <p>You can only edit the time table of <span class="text-success"><?= $row['class']; ?></span> cos we assume you are their class teacher.
              To edit class timetable, click on the large input and then click on the second icon</span>
            </p>

              <!-- TinyMCE Editor -->
              <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
              <textarea class="tinymce-editor" name="timetable">
            
            </textarea>
            <div class="text-danger">
                      <?php
                        if(isset($error['timetable'])){
                          echo $error['timetable'];
                        }
                        ?>
                      </div>

                      <div class="container">
                      <button class="btn btn-success text-white form-control my-3" name="class-timetable-btn" style="border-radius: 15px;">Upload TimeTable</button>
                      </div>
            
              </form>

            </div>
          </div>

          
<?php
            } else{
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
                    <p class="card-text pt-3">Hi <span style="color: green;"><?php echo $row['lastname']; ?></span>, Florieren Parklane International School welcomes you to this platform, it is no news that the world is going digital and we have also decided to join the trend and we employ every Staff to join us with this new development. <br />
                  <span class="text-danger">You can't access anything here until the admin verifies your account. We will send you an email immediately after your account has been verified.</span>. 
                  </p>
                 
                </div>
              </div>
            </div>
          </div><!-- End Card with an image on left -->
              <?php
            }
?>

        </div>
      </div>
    </section>

  </main><!-- End #main -->

<?php require "main-footer.php"; ?>