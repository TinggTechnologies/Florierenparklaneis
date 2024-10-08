<?php require "admin-header.php"; ?>


<main id="main" class="main">

    <section class="section profile">
      <div class="row">
        <div class="col-xl-4">

          <div class="card">
            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

              <img src="uploads/<?php echo $fetch_data['image']; ?>" alt="Profile" class="rounded-circle">
              <h2><?php echo $fetch_data['lastname'] .' '. $fetch_data['firstname']; ?></h2>
              <p><?php echo $fetch_data['unique_id']; ?></p>
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

                <div class="tab-pane fade show active profile-overview" id="profile-overview">
                  <h5 class="card-title">About</h5>
                  <p class="small fst-italic"><?php if(($fetch_data['about']) !== ""){
                      echo $fetch_data['about']; 
                    } else {
                      echo '<div class="text-danger">The user has not updated his/her profile</div>';
                    }?></p>

                  <h5 class="card-title">Profile Details</h5>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label ">Full Name</div>
                    <div class="col-lg-9 col-md-8"><?php echo $fetch_data['lastname'] .' '. $fetch_data['firstname']; ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Email</div>
                    <div class="col-lg-9 col-md-8"><?php echo $fetch_data['email']; ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Telephone</div>
                    <div class="col-lg-9 col-md-8"><?php echo $fetch_data['telephone']; ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Class</div>
                    <div class="col-lg-9 col-md-8"><?php echo $fetch_data['class']; ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Home Address</div>
                    <div class="col-lg-9 col-md-8"><?php if(($fetch_data['home_address']) !== "" ){
                      echo $fetch_data['home_address']; 
                    } else {
                      echo '<div class="text-danger">The user has not updated home address</div>';
                    }?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">State of Origin</div>
                    <div class="col-lg-9 col-md-8"><?php if(($fetch_data['state_of_origin']) !== ""){
                      echo $fetch_data['state_of_origin']; 
                    } else {
                      echo '<div class="text-danger">The user has not updated state of origin</div>';
                    }?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Date of Birth</div>
                    <div class="col-lg-9 col-md-8"><?php if(($fetch_data['date_of_birth']) !== ""){
                      echo $fetch_data['date_of_birth']; 
                    } else {
                      echo '<div class="text-danger">The user has not updated date of birth</div>';
                    }?></div>
                  </div>

                </div>

                <div class="row">
                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                    <div class="col-lg-3 col-md-4 label">Delete Staff</div>
                    <div class="col-lg-9 col-md-8">
                        <input type="hidden" name="staff_id" value="<?php echo $staff_id; ?>">
                        <button type="submit" name="delete-staff" class="btn btn-danger my-2 px-5" style="border-radius: 15px;">Delete Staff Record</button>
                    </div>
                
                </form>
                </div>


<?php require "main-footer.php"; ?>