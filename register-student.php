<?php 

if(isset($_SESSION['student'])){
  header("location: dashboard.php");
}

require "database/connection.php";
require "includes/header.php"; 
?>
<style>
  i{
    color: green;
  }
</style>

  <main>
    <div class="container pt-5">

    <div class="row justify-content-center">
            <div class="col-lg-4">

      <section class="section register min-vh-98 d-flex flex-column align-items-center justify-content-center">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">
              </div> 

              <div>

                  <div>
                  <div class="text-center">
                      <img src="./assets/img/florieren/logo.png" style="width: 60px;" alt="">
                    </div>
                    <h5 class="card-title text-center mt-4 pb-0 fs-4 jquery" style="color: green;">Create an Account</h5>
                    <p class="text-center small">Parent should enter their Children Details</p>
                  </div>

                  <form class="row g-3" id="form">
                  <div class="text-center">
                    
                      </div>
                    <div class="col-12">
                      <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-person-fill"></i></span>
                      <input type="text" name="firstname" class="form-control form_data" id="firstname" placeholder="Student Firstname" >
                    </div>
                    
                      </div>
                    <div class="col-12">
                      <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-person-fill"></i></span>
                        <input type="text" name="lastname" class="form-control form_data" id="lastname" placeholder="Student Other Names">
                      </div>
              
                    </div>

                    <div class="col-12">
                      <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-briefcase-fill"></i></span>
                        <input type="email" name="email" class="form-control form_data" id="email" placeholder="Enter Email Address">
                      </div>
                      
                    </div>

                    <div class="col-12">
                      <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-telephone-outbound-fill"></i></span>
                        <input type="tel" name="telephone" class="form-control form_data" id="telephone" placeholder="Enter Telephone">
                      </div>
                      
                    </div>

                    <div class="col-12">
                      <div class="input-group">
                      <span class="input-group-text"><i class="bi bi-house-fill"></i></span>
                        <select name="class" id="class" class="form-control form_data">
                          <?php
                          $class_sql = "SELECT * FROM class";
                          $class_stmt = $conn->prepare($class_sql);
                          if($class_stmt->execute()){
                            $class_result = $class_stmt->get_result();
                            if($class_result->num_rows > 0){
                              while($class_row = $class_result->fetch_assoc()){?>
                              <option value="<?= $class_row['class']; ?>"><?= $class_row['class']; ?></option>
                              <?php

                              }
                            }
                          }
                          ?>
                    
                        </select>
                      </div>

                    </div>

                    <div class="col-12">
                      <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-key-fill"></i></span>
                        <input type="password" name="password" class="form-control form_data" id="password" placeholder="Enter Password">
                      </div>
                     
                    </div>

                    <div class="col-12">
                      <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-key-fill"></i></span>
                        <input type="password" name="confirm_password" class="form-control form_data" id="confirm_password" placeholder="Confirm Password">
                      </div>
                      
                    </div>

                    <div class="col-12">
                      <button class="btn w-100 submit_btn rounded-5" style="background-color: green; color: #fff;"  id="submit_btn" type="submit">Sign Up</button>
                    </div>
                    <div class="col-12">
                      <p class="small">Already have an account? <a href="student-login.php">Log in</a></p>
                    </div>
                  </form>

                </div>
              </div>

            </div>
          </div>

      </section>

    </div>
  </main><!-- End #main -->

</div>
</div>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  
<?php require "includes/footer.php"; ?>

<script>
 $(document).on('click', '#submit_btn', function(e){
    e.preventDefault();
  
    var firstname = $('#firstname').val();
    var lastname = $('#lastname').val();
    var email = $('#email').val();
    var telephone = $('#telephone').val();
    var student_class = $('#class').val();
    var password = $('#password').val();
    var confirm_password = $('#confirm_password').val();
    var submit_btn = $('#submit_btn').val();
    var atpos = email.indexOf('@');
    var dotpos = email.lastIndexOf('.com');

    if(firstname == "" || lastname == "" || email == "" || telephone == "" || student_class == "" || password == "" || confirm_password == ""){
      Swal.fire(
        'Invalid',
        'No Field Should be empty',
        'error'
      )
    }  else if(atpos < 1 || dotpos < atpos + 2 || dotpos + 2 >= email.length){
            Swal.fire(
            'Invalid',
            'Invalid Email',
            'error'
          )
        } else if(telephone.length !== 11){
            Swal.fire(
            'Invalid',
            'Invalid Telephone',
            'error'
          );
        }  else if(password.length < 8 || !/\d/.test(password) || !/[a-z]/.test(password) || !/[A-Z]/.test(password) || !/[^a-zA-Z0-9]/.test(password)){
            Swal.fire(
            'Invalid',
            'Password must be at least 8 characters and contain at least one lowercase letter, one uppercase letter, one digit and one special character',
            'error'
          )
            } else if(password !== confirm_password){
          Swal.fire(
            'Invalid',
            'Password does not match',
            'error'
          );
        }
  
    else{$.ajax({
      url:'backend/register-student.php',
      type:'POST',
      data:
      {
        firstname:firstname,
        lastname:lastname,
        email:email,
        telephone:telephone,
        class:student_class,
        password: password,
        confirm_password:confirm_password,
        submit_btn:submit_btn
      },
      success: function(response){
        $("#output").html(response);
        location.href = "welcome-student.php";
      }
    });
    $("#form")[0].reset();
  }
  
   });
</script>
