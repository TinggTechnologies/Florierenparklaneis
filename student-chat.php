<?php require "student-header.php"; ?>

<div class="row justify-content-center">

<!-- Left side columns -->
<div class="col-lg-4">

<section class="signup py-5 mb-5">

<nav>
  <ol class="breadcrumb mt-4">
      <li class="breadcrumb-item"><a href="dashboard.php"><i class="bi bi-house-door"></i></a></li>
      <li class="breadcrumb-item"><a href="#">Select User <i class="bi bi-people" style="font-size: 1.2rem; color: green;"></i></a></li>
              </ol>
</nav>

<?php
          $student_id = $_SESSION['student'];
          $sql = "SELECT * FROM users WHERE student_id=? AND admin_verify='1'";
          $stmt = $conn->prepare($sql);
          $stmt->bind_param('s', $student_id);
          $stmt->execute();
          $result = $stmt->get_result();
          if($result->num_rows > 0){

            ?>

<div class="container mb-5">
    <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" class="d-flex">
        <input type="search" name="" id="" style="width: calc(100% - 40px);" placeholder="Search for a user" class="form-control">
        <button class="btn btn-success ms-1" name=""><i class="bi bi-send text-white"></i></button> 
    </form>
  </div>

  <div class="student-chat">

  </div>

  <?php
 
  } else {
?>
  

            <!-- Sales Card -->
            <div class="">
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

         
        </div><!-- End Right side columns -->


</div>
</section>


      </div>
      </div>


<?php require "main-footer.php"; ?>

<script>
    $(document).ready(function(){
        fetch_user();

        setInterval(function(){
            fetch_user();
        }, 5000);

        function fetch_user(){
            $.ajax({
                url:"backend/fetch-student-chat.php",
                method: "POST",
                success: function(data){
                    $(".student-chat").html(data);
                }
            });
        }
    });
   </script>