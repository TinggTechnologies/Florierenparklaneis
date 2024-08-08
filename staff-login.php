<?php
session_start();

if(isset($_SESSION['staff'])){
  header("location: dashboard.php");
}

require "backend/staff-login.php";

?>
<?php require "includes/header.php"; ?>
<style>
  i{
    color: green;
  }
  img{
    border-radius: 50%;
  }
  h5, p{
    color: white;
    opacity: 1;
  }
</style>

  <main class="staff-login">
    <div class="container">

      <section class="pt-0 section register min-vh-100 d-flex flex-column align-items-center justify-content-center">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

                  <div>
                    <div class="text-center">
                      <img src="./assets/img/florieren/logo.png" style="width: 60px;" alt="">
                    </div>
                    <h5 class="card-title text-center mt-3 pb-0 fs-4">Create an Account</h5>
                    <p class="text-center small">Login with Staff Id and Password</p>
                  </div>

                  <form class="row g-3" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                  <div class="text-center">
                        <?php
                        if(isset($error['staff_login'])){
                          echo $error['staff_login'];
                        }
                        ?>
                      </div>
                    <div class="col-12">
                      <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-person-fill"></i></span>
                      <input type="text" name="staff_id" class="form-control" id="staff_id" placeholder="Enter Staff Id" value="<?php if(isset($staff_id)){
                        echo $staff_id;
                      } ?>">
                    </div>

                      </div>
                    <div class="col-12">
                      <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-key-fill"></i></span>
                        <input type="password" name="password" class="form-control" id="password" placeholder="Enter Password">
                      </div>
                    </div>
                
                      <div class="col-12 text-end mt-3">
                      <p class="small">Forgotten Password? <a href="staff-forgot-password.php">Click here</a></p>
                    </div>

                    <div class="col-12 mt-0">
                      <button class="btn w-100 submit-btn rounded-5" style="background-color: green; color: #fff;" name="login-btn" type="submit">Login</button>
                    </div>
                    <div class="col-12 text-center">
                      <p class="small">No Account? <a href="register-staff.php">Sign Up</a></p>
                    </div>
                  </form>

            </div>
          </div>
        </div>

      </section>

    </div>
  </main><!-- End #main -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<?php require "includes/footer.php"; ?>