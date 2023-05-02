<?php
session_start();

if(!isset($_SESSION['csp'])){
  header("location: admin-login.php");
}

require_once "includes/header.php"; 
require "backend/change-a-password.php";
?>


  <main id="main" class="main container">

    <section class="section profile">
      <div class="row">
        <div class="col-xl-4">
        <div class="text-center">
                      <img src="./assets/img/florieren/logo.png" style="width: 60px;" alt="">
                    </div>
                    <h5 class="card-title text-center mt-4 pb-0 fs-4 jquery" style="color: green;">Create Password</h5>
                    <p class="text-center small">Parent should enter a strong password</p>
                  </div>

                   <!-- Change Password Form -->
                   <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                   <div class="text-center">
                      <?php
                      if(isset($error['password'])){
                          echo $error['password'];
                      }
                      ?>
                  </div>


<div class="row mb-3">
  <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">New Password</label>
  <div class="col-md-8 col-lg-9">
    <input name="newpassword" type="password" class="form-control" id="newPassword">

  </div>
</div>

<div class="row mb-3">
  <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Re-enter New Password</label>
  <div class="col-md-8 col-lg-9">
    <input name="renewpassword" type="password" class="form-control" id="renewPassword">

  </div>
</div>

<div class="text-center">
  <button type="submit" class="btn btn-success rounded-5 w-100" name="pass-btn">Change Password</button>
</div>
</form><!-- End Change Password Form -->

                </div>

              </div><!-- End Bordered Tabs -->

            </div>
          </div>

        </div>
      </div>
    </section>

  </main><!-- End #main -->

  <?php require "includes/footer.php"; ?>