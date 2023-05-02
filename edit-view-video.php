<?php 
require "main-header.php";
require "backend/edit-video.php";
?>

<div class="row justify-content-center">
 <div class="col-lg-4">     

<div class="container mt-5 pt-4">
<nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="student-dashboard.php"><i class="bi bi-house-door"></i></a></li>
      <li class="breadcrumb-item"><a href="#">Edit Link</a></li>
                </ol>
  </nav>

</div>
<?php
          $staff_id = $_SESSION['staff'];
          if(isset($_GET['library_id'])){
          $library_id = $_GET['library_id'];
          }
          $sql = "SELECT * FROM staff WHERE unique_id=? AND admin_verify='1'";
          $stmt = $conn->prepare($sql);
          $stmt->bind_param('s', $staff_id);
          $stmt->execute();
          $result = $stmt->get_result();
          if($result->num_rows > 0){
            $get_row = $result->fetch_assoc();

            $sql = "SELECT * FROM video WHERE id='$library_id' ORDER BY id DESC";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->get_result();
            if($result->num_rows > 0){
              $fetch = $result->fetch_assoc();
            }
            ?>

<section class="section">
<div class="container pt-2">
<div class="text-center">
              <i class="bi bi-exclamation-circle text-success" style="font-size: 2.5rem;"></i>
              </div>
<p style="opacity: .8;" class="text-center"><span style="color: green;"><?= $row['lastname']; ?></span>, You can Edit YouTube Link for your students to have access to.</p>
<form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data">

<div class="mb-3 mt-3">
    <select name="course" id="course" class="form-control" >
        <option value="<?php
        if(isset($fetch['course'])){
         echo $fetch['course']; 
        }
         ?>"><?php
        if(isset($fetch['course'])){
         echo $fetch['course']; 
        }
         ?></option>
        <?php 
        $course_sql = "SELECT courses FROM course";
        $course_stmt = $conn->prepare($course_sql);
        $course_stmt->execute();
        $course_result = $course_stmt->get_result();
        if($course_result->num_rows > 0){
          while($course_row = $course_result->fetch_assoc()){
          echo '
          <option value='.$course_row['courses'].'>'.$course_row['courses'].'</option>
          ';
        }
      }
        ?>
    </select>
    <div class="text-danger">
    <?php
if(isset($error['course'])){
  echo $error['course'];
}
?>
    </div>
  </div>

<div class="mb-3 mt-3">
<select name="class" id="" class="form-control form_data">
<option value="<?php
        if(isset($fetch['class'])){
         echo $fetch['class']; 
        }
         ?>"><?php
        if(isset($fetch['class'])){
         echo $fetch['class']; 
        }
         ?></option>
                      <?php
                      $sql = "SELECT class FROM class";
                      $stmt = $conn->prepare($sql);
                      $stmt->execute();
                      $result = $stmt->get_result();
                      if($result->num_rows > 0){
                        while($row = $result->fetch_assoc()){
                          echo '
                          <option value='.$row['class'].'>'.$row['class'].'</option>
                          ';
                        }
                      }
                      ?>
                        </select>
                      
                      <div class="text-danger">
                      <?php
                        if(isset($error['class'])){
                          echo $error['class'];
                        }
                        ?>
                      </div>
  </div>

  <div class="mb-3 mt-3">
    <textarea name="video" id="" rows="7" class="form-control">
    <?php
      if(isset($fetch['link'])){
    echo $fetch['link'];
      }
    ?>
    </textarea>
    <div class="text-danger">
    <?php
if(isset($error['assignment'])){
  echo $error['assignment'];
}
?>
    </div>
  </div>

  <input type="hidden" name="library_id" value="<?= $library_id; ?>">

  <button type="submit" class="btn btn-success text-white form-control mb-5" name="library-btn" style="border-radius: 15px;">Upload Book</button>

</form>

</div>
</div>
<?php
} else{
  ?>

    <!-- Sales Card -->
    <div class="row justify-content-center">
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
                    <p class="card-text pt-3">Hi <span style="color: green;"><?php echo $row['lastname']; ?></span>, Florieren Park Lane International School welcomes you to this platform, it is no news that the world is going digital and we have also decided to join the trend and we employ every Staff to join us with this new development. <br />
                  <span class="text-danger">You can't access anything here until the admin verifies your account. We will send you an email immediately after your account has been verified.</span>. 
                  </p>
                 
                </div>
              </div>
            </div>
  </div><!-- End Card with an image on left -->

 <?php

}?>
</div>
</div>
</section>

<?php require "main-footer.php"; ?>

