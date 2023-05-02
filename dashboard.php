
<?php require "main-header.php"; ?>


<div class="container mt-5 pt-4">

  <nav>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="dashboard.php"><i class="bi bi-house-door"></i></a></li>
        <li class="breadcrumb-item"><a href="#">School Feed</a></li>
                </ol>
  </nav>

</div>

  <main id="main" class="main mt-0 pt-0">

    <section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-12">
          <div>

          <?php
          $staff_id = $_SESSION['staff'];
          $sql = "SELECT * FROM staff WHERE unique_id=? AND admin_verify='1'";
          $stmt = $conn->prepare($sql);
          $stmt->bind_param('s', $staff_id);
          $stmt->execute();
          $result = $stmt->get_result();
          if($result->num_rows > 0){

           ?>
           <div class="row feed-wrapper">

</div>

           <?php

          }else{
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
                    <p class="card-text pt-3">Hi <span style="color: green;"><?php echo $row['lastname']; ?></span>, Florieren Park Lane International Schools welcomes you to this platform, it is no news that the world is going digital and we have also decided to join the trend and we employ every Staff to join us with this new development. <br />
                  <span class="text-danger">You can't access anything here until the admin verifies your account. We will send you an email immediately after your account has been verified. <br />
                  for the admin to know you are the one, click on the profile page and update your profile.
                </span>
                  </p>
                  <a href="profile.php" class="btn btn-success">Update Profile</a>
                 
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

  <?php require "main-footer.php"; ?>

  <script>
    $(document).ready(function(){
        fetch_user();

        setInterval(function(){
            fetch_user();
        }, 5000);

        function fetch_user(){
            $.ajax({
                url:"backend/fetch-staff-post.php",
                method: "POST",
                success: function(data){
                    $(".feed-wrapper").html(data);
                }
            });
        }
    });
   </script>