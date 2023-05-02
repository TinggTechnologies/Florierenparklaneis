<?php
require "student-header.php";
?>

<div class="container mt-5 pt-5">

  <nav>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="student-dashboard.php"><i class="bi bi-house-door"></i></a></li>
        <li class="breadcrumb-item"><a href="#">Assignment</a></li>
                </ol>
  </nav>

</div>

<main id="main" class="main mt-0">

    <section class="section dashboard">
      <div class="row">

        <div class="col-lg-10">

          

            <?php
            $student_id = $row['student_id'];
             if(isset($_GET['assignment_id'])){
              $assignment_id = $_GET['assignment_id'];
             }
             $sql = "SELECT * FROM  assignment WHERE assignment_id='$assignment_id'";
             $stmt = $conn->prepare($sql);
             $stmt->execute();
             $result = $stmt->get_result();
             if($result->num_rows > 0){
               $get_data = $result->fetch_assoc();
               $staff_id = $get_data['staff_id'];
               $sql1 = "SELECT * FROM  staff WHERE unique_id='$staff_id'";
               $stmt1 = $conn->prepare($sql1);
             $stmt1->execute();
             $get = $stmt1->get_result();
             if($get->num_rows > 0){
               $data = $get->fetch_assoc();

             }

              
             }
             ?>

             <?php
             if(isset($_POST['submit-assignment-btn'])){

                $assignment_done = $_POST['assignment'];

                $assignment_id = $_POST['assignment_id'];

                $submit_sql = "INSERT INTO submit_assignment (assignment_id, student_id, assignment) VALUES('$assignment_id', '$student_id', '$assignment_done')";
                $submit_stmt = $conn->prepare($submit_sql);
                if($submit_stmt->execute()){
                    echo "<script>location.href = 'submit-assignment-success.php';</script>";
                }
             }
             ?>
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
            
            <div class="col-md-6">
              <div class="card info-card sales-card">

                <div class="filter">
                  <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">

                    <li><a class="dropdown-item" href="#"><i class="bi bi-person"></i>Profile</a></li>
                    <li><a class="dropdown-item" href="#"><i class="bi bi-send"></i>Message</a></li>
                    <li><a class="dropdown-item" href="#"><i class="bi bi-telephone-outbound"></i>Call</a></li>
                  </ul>
                </div>

                <div class="card-body">
                  <h5 class="card-title"><a class="nav-link nav-profile d-flex align-items-center pt-0" href="#" data-bs-toggle="dropdown">
                    <img style="height: 40px; width: 40px;" src="uploads/<?= $data['image']; ?>" alt="Profile" class="rounded-circle">
                    <span class="d-md-block ps-2"><?= $data['lastname'].' '. $data['firstname']; ?></span>
                  </a><!-- End Profile Iamge Icon --></h5>

                  <div class="row g-0 text-center">
                    <h3 class="card-title fw-bold pt-0"><i class="bi bi-card-heading fs-5"></i> <?= $get_data['subject']; ?></h3>
                    <p class="card-text pt-0">DeadLine: <?= $get_data['deadline']; ?></p>
                    <p class="card-text pt-0">Date Given: <?= $get_data['date']; ?></p>
                    <p class="card-text pt-0 text-danger">Note: once submitted cannot be updated.</p>
                    <hr>
                    <textarea class="tinymce-editor" name="assignment">
            
            </textarea>
            <input type="hidden" name="assignment_id" value="<?= $assignment_id; ?>">
                  <div class="row mt-3">
                    <div class="col-sm-12 d-flex align-items-center justify-content-between">
                      <button name="submit-assignment-btn" class="btn btn-success form-control" style="border-radius: 15px;">Submit Assignment</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          </form>



        </div>
      </div>
    </section>

  </main><!-- End #main -->

<?php
require "main-footer.php";
?>