<?php 
//require "backend/register-staff.php";
if(isset($_SESSION['staff'])){
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

<div class="row justify-content-center">
            <div class="col-lg-4">

  <main>
    <div class="container pt-5">

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
                    <p class="text-center small">Staff should enter their Personal Details</p>
                  </div>

                  <form class="row g-3" method="POST" id="form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                  <div class="text-center" id="output">
                     
                      </div>
                    <div class="col-12">
                      <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-person-fill"></i></span>
                      <input type="text" name="firstname" class="form-control form_data" id="firstname" placeholder="Enter Firstname" value="<?php if(isset($firstname)){
                        echo $firstname;
                      } ?>">
                    </div>
                   
                      </div>
                    <div class="col-12">
                      <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-person-fill"></i></span>
                        <input type="text" name="lastname" class="form-control form_data" id="lastname" placeholder="Enter Lastname" value="<?php if(isset($lastname)){
                        echo $lastname;
                      } ?>">
                      </div>
                      <div class="text-danger">
                      <?php
                        if(isset($error['lastname'])){
                          echo $error['lastname'];
                        }
                        ?>
                      </div>
                    </div>

                    <div class="col-12">
                      <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-briefcase-fill"></i></span>
                        <input type="email" name="email" class="form-control form_data" id="email" placeholder="Enter Email Address" value="<?php if(isset($email)){
                        echo $email;
                      } ?>">
                      </div>
            
                    </div>

                    <div class="col-12">
                      <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-telephone-outbound-fill"></i></span>
                        <input type="tel" name="telephone" class="form-control form_data" id="telephone" placeholder="Enter Telephone" value="<?php if(isset($telephone)){
                        echo $telephone;
                      } ?>">
                      </div>
                     
                    </div>

                    <div class="col-12">
                      <div class="input-group">
                      <span class="input-group-text"><i class="bi bi-person-fill"></i></span>
                        <select name="class" id="class" class="form-control form_data">
                            <option value="<?php if(isset($class)){
                        echo $class;
                      }else{
                        echo "";
                      } ?>"><?php if(isset($class)){
                        echo $class;
                      }else{
                        echo "Class teacher of what class";
                      } ?></option>
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
                      </div>
                     

                    </div>

                    <div class="col-12">
                      <button class="btn w-100 submit_btn rounded-5" style="background-color: green; color: #fff;" name="submit_btn" id="submit_btn" type="submit">Continue</button>
                    </div>
                    <div class="col-12">
                      <p class="small">Already have an account? <a href="staff-login.php">Log in</a></p>
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
    //var password = $('#password').val();
    //var confirm_password = $('#confirm_password').val();
    var submit_btn = $('#submit_btn').val();
    var atpos = email.indexOf('@');
    var dotpos = email.lastIndexOf('.com');

    if(firstname == "" || lastname == "" || email == "" || telephone == "" || student_class == ""){
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
        } /* else if(password.length < 8 || !/\d/.test(password) || !/[a-z]/.test(password) || !/[A-Z]/.test(password) || !/[^a-zA-Z0-9]/.test(password)){
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
      url:'backend/register-staff.php',
      type:'POST',
      data:
      {
        firstname:firstname,
        lastname:lastname,
        email:email,
        telephone:telephone,
        class:student_class,
       // password: password,
        //confirm_password:confirm_password,
        submit_btn:submit_btn
      },
      success: function(response){
        $("#output").html(response);
        location.href = "staff-password.php";
      }
    });
    $("#form")[0].reset();
  }
  
   });
</script>

