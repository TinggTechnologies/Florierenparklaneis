<?php require "main-header.php"; ?>


<div class="container mt-5 pt-5">
<?php

if(isset($_POST['attendance-btn'])){
    if(!empty($_POST['attendance'])){
    $value = $_POST['attendance'];
    $time = $_POST['date'];
    $staff_id = $row['unique_id'];
    $count = 1;

   foreach ($value as $values) {
     $tick = $values;

     $term_sql = "SELECT * FROM set_term_tbl WHERE set_term_id='1'";
     $term_stmt = $conn->prepare($term_sql);
     $term_stmt->execute();
     $term_result = $term_stmt->get_result();
     if($term_result->num_rows > 0){
       $term_row = $term_result->fetch_assoc();
       $term = $term_row['set_term'];
     }

     $session_sql = "SELECT * FROM set_session_tbl WHERE set_session_id='1'";
     $session_stmt = $conn->prepare($session_sql);
     $session_stmt->execute();
     $session_result = $session_stmt->get_result();
     if($session_result->num_rows > 0){
       $session_row = $session_result->fetch_assoc();
       $session = $session_row['set_session'];
     }
     
     $sql = "INSERT INTO student_attendance(student_id, tick, term, session, staff_id, date, count) VALUES(?,?,?,?,?, NOW(), ?)";
     $stmt = $conn->prepare($sql);
     $stmt->bind_param('ssssss', $tick, $time, $term, $session, $staff_id, $count);
     if($stmt->execute()){
      echo "<script>location.href = 'attendance-success.php';</script>";
     }
    }
    
   }
  
} 

?>

<?php
          $staff_id = $_SESSION['staff'];
          $sql = "SELECT * FROM staff WHERE unique_id=? AND admin_verify='1'";
          $stmt = $conn->prepare($sql);
          $stmt->bind_param('s', $staff_id);
          $stmt->execute();
          $result = $stmt->get_result();
          if($result->num_rows > 0){
           
            ?>
<div class="row justify-content-center">
 <div class="col-lg-4">
  <nav>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="dashboard.php"><i class="bi bi-house-door"></i></a></li>
        <li class="breadcrumb-item"><a href="#">Attendance <i class="bi bi-people" style="font-size: 1.2rem; color: green;"></i></a></li>
                </ol>
  </nav>

</div>    
</div>

 <div class="row justify-content-center">
 <div class="col-lg-4">           
              
                <?php 
                $error = [];
                $class = $row['class'];

                if(empty($time)){
                  $error['time'] = "<div class='text-center py-1 text-danger fs-5 fw-bold'>
                  <i class='bi bi-x-circle text-danger' style='font-size: 2.5rem;'></i><br />Time cannot be empty</div>";
                }

            $sql = "SELECT * FROM users WHERE admin_verify='1' AND class='$class'";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->get_result();
            if($result->num_rows > 0){
          
                ?>

                <div class="card text-center">
            <div class="card-body pt-3">
            <div class="text-center">
              <i class="bi bi-exclamation-circle text-success" style="font-size: 2.5rem;"></i>
              </div>
            
              <p class="pb-3">Select students in <span class="text-success fw-bold"><?= $row['class']; ?></span> that is present at the selected date.</p>
              <form action="attendance.php" method="post">
                <span class="text-success">Select Date</span>
                <input type="date" name="date" class="form-control">
                <div class="text-danger">
                      <?php
                    if(isset($error['time'])){
                      echo $error['time'];
                    }
                      ?>
                    </div>
                <table class="table table-bordered mt-3">
                <thead>
                  <tr>
                    <th scope="col">image</th>
                    <th scope="col">Lastname</th>
                    <th scope="col">Firstname</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                <?php
              while($fetch = $result->fetch_assoc()){
                ?>
                <tr>
                    <td><img style="height: 70px; width: 70px;" src="uploads/<?= $fetch['image']; ?>" class="img-fluid" /></td>
                    <td><?= $fetch['lastname']; ?></td>
                    <td><?= $fetch['firstname']; ?></td>
                    <td><input type="checkbox" name="attendance[]" value="<?= $fetch['student_id']; ?>" /></td>
                  </tr>

                <?php
              }
            ?>
           
                  
                </tbody>
              </table>
              <div class="text-center">
                <button class="btn btn-success mt-3 px-5" name="attendance-btn" style="border-radius: 15px;">Submit Attendance</button>
              </div>
              </form>

              <!-- End Bordered Table -->
              <?php 
             } else{
              $error['error'] = "<div class='text-center py-1 text-danger fs-5 fw-bold'>
              <i class='bi bi-x-circle text-danger' style='font-size: 2.5rem;'></i><br />No Student Found</div>";
              } 
?>
 </div><!-- End Card with an image on left -->
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
                    <p class="card-text pt-3">Hi <span style="color: green;"><?php echo $row['lastname']; ?></span>, Florieren Parklane International School welcomes you to this platform, it is no news that the world is going digital and we have also decided to join the trend and we employ every Parent to join us with this new development. <br />
                  <span class="text-danger">You can't access anything here until the admin verifies your account. We will send you an email immediately after your account has been verified.</span>. 
                  </p>
                 
</div>
</div>
                </div>
              </div>
            </div>
          </div><!-- End Card with an image on left -->
              <?php
            }
?>
<div class="text-danger text-center mb-3">
  <?php
                        if(isset($error['error'])){
                          echo $error['error'];
                        }                  ?>
                        </div>
  </div>


<?php require "main-footer.php"; ?>
