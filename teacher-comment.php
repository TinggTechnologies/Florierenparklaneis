<?php require "main-header.php"; ?>

<?php
if (isset($_GET['student_id'])) {
    $student_id = $_GET['student_id'];
}

$check_sql = "SELECT student_id FROM attendance WHERE student_id=?";
$check_stmt = $conn->prepare($check_sql);
$check_stmt->bind_param('s', $student_id);
$check_stmt->execute();
$check_get_result = $check_stmt->get_result();
if($check_get_result->num_rows === 0){
    $insert_sql = "INSERT INTO attendance (student_id) VALUES(?)";
    $insert_stmt = $conn->prepare($insert_sql);
    $insert_stmt->bind_param('s', $student_id);
    $insert_stmt->execute();
} 

?>

<main>
    <div class="container">

      <section class="mt-5 section register d-flex flex-column align-items-center justify-content-center">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

                  <div class="mt-5">

                    <h5 class="card-title text-center mt-3 pb-0 fs-4">Update Attendance</h5>
                    <p class="text-center small">Enter Teachers Comment here</p>
                  </div>

                  <form class="row g-3" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">

                    <div class="col-12">
                      <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-person-fill"></i></span>
                      <input type="text" name="present" class="form-control" id="staff_id" value="<?php if(isset($present)){
                        echo $present;
                      } ?>">
                    </div>
                    <div class="text-danger">
                        <?php
                        if(isset($error['present'])){
                          echo $error['present'];
                        }
                        ?>
                      </div>


                      </div>

                    <div class="col-12 mt-3 mb-5">
                        <input type="hidden" name="student_id" value="<?= $student_id; ?>">
                      <button class="btn w-100 submit-btn" style="background-color: green; color: #fff;" name="teacher-comment-btn" type="submit">Update</button>
                    </div>

                  </form>

            </div>
          </div>
        </div>

      </section>

    </div>
  </main><!-- End #main -->



<?php require "main-footer.php"; ?>