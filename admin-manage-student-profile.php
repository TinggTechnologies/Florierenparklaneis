<?php require "admin-header.php"; ?>


<main id="main" class="main">

<?php
if(isset($_GET['student_id'])){
  $student_id = $_GET['student_id'];
}
$sql = "SELECT * FROM users WHERE student_id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $student_id);
$stmt->execute();
$result = $stmt->get_result();
if($result->num_rows > 0){
  $row = $result->fetch_assoc();
}

if(isset($_POST['delete-user'])){
  $student_id = $_POST['student_id'];

  $sql = "DELETE FROM users WHERE student_id=?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param('s', $student_id);
  if($stmt->execute()){
    echo "<script>location.href = 'delete-student.php';</script>";
  }
}
?>

    <section class="section profile">
      <div class="row">
        <div class="col-xl-4">

          <div class="card">
            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

              <img src="uploads/<?php echo $row['image']; ?>" alt="Profile" class="rounded-circle">
              <h2 class="text-center"><?php echo $row['lastname'] .' '. $row['firstname']; ?></h2>
              <p><?php echo $row['student_id']; ?></p>
            </div>
          </div>

        </div>

        <div class="col-xl-8">

          <div class="card">
            <div class="card-body pt-3">
              <!-- Bordered Tabs -->
              <ul class="nav nav-tabs nav-tabs-bordered">

                <li class="nav-item">
                  <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Profile Overview</button>
                </li>
            
              </ul>
              <div class="tab-content pt-2">
                <h6>You can approve students here</h6>

                <div class="tab-pane fade show active profile-overview" id="profile-overview">
                  <h5 class="card-title">About</h5>
                  <p class="small fst-italic"><?php if(($row['about']) !== ""){
                      echo $row['about']; 
                    } else {
                      echo '<div class="text-danger">The user has not updated his/her profile</div>';
                    }?></p>

                  <h5 class="card-title">Profile Details</h5>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label ">Full Name</div>
                    <div class="col-lg-9 col-md-8"><?php echo $row['lastname'] .' '. $row['firstname']; ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Email</div>
                    <div class="col-lg-9 col-md-8"><?php echo $row['email']; ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Telephone</div>
                    <div class="col-lg-9 col-md-8"><?php echo $row['telephone']; ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Class</div>
                    <div class="col-lg-9 col-md-8"><?php echo $row['class']; ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Home Address</div>
                    <div class="col-lg-9 col-md-8"><?php if(($row['home_address']) !== "" ){
                      echo $row['home_address']; 
                    } else {
                      echo '<div class="text-danger">The user has not updated home address</div>';
                    }?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">State of Origin</div>
                    <div class="col-lg-9 col-md-8"><?php if(($row['state_of_origin']) !== ""){
                      echo $row['state_of_origin']; 
                    } else {
                      echo '<div class="text-danger">The user has not updated state of origin</div>';
                    }?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Date of Birth</div>
                    <div class="col-lg-9 col-md-8"><?php if(($row['date_of_birth']) !== ""){
                      echo $row['date_of_birth']; 
                    } else {
                      echo '<div class="text-danger">The user has not updated date of birth</div>';
                    }?></div>
                  </div>

                  <div class="row mb-3">
                      <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Parent Image</label>
                      <div class="col-md-8 col-lg-9">
                        <img src="uploads/<?php echo $row['parent_image']; ?>" style="width: 7rem; height: 5rem;" alt="Profile">
                      </div>
                    </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Father Names</div>
                    <div class="col-lg-9 col-md-8"><?php if(($row['father_name']) !== ""){
                      echo $row['father_name']; 
                    } else {
                      echo '<div class="text-danger">The user has not updated fathers name</div>';
                    }?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Mother Names </div>
                    <div class="col-lg-9 col-md-8"><?php if(($row['mother_name']) !== ""){
                      echo $row['mother_name']; 
                    } else {
                      echo '<div class="text-danger">The user has not updated mothers name</div>';
                    }?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Year Of Admission</div>
                    <div class="col-lg-9 col-md-8"><?php if(($row['year_of_admission']) !== ""){
                      echo $row['year_of_admission']; 
                    } else {
                      echo '<div class="text-danger">The user has not updated year of admission</div>';
                    }?></div>
                  </div>

                </div>

                <div class="row">
                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                    <div class="col-lg-9 col-md-8">
                        <input type="hidden" name="student_id" value="<?php echo $student_id; ?>">
                        <button type="submit" name="admin-approve-student" class="btn btn-success px-5 mb-3 mb-lg-0" style="border-radius: 15px;">Approve Student</button>
                        <button type="submit" name="delete-user" class="btn btn-danger px-5 mb-3" style="border-radius: 15px;">Delete Student</button>
                    </div>
                
                </form>
                </div>


<?php require "main-footer.php"; ?>