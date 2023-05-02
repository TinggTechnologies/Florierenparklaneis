<?php require "admin-header.php"; ?>

<div class="container mt-5 pt-5">

<div class="row justify-content-center">

<div class="col-lg-4">
<nav>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="admin-dashboard.php"><i class="bi bi-house-door"></i></a></li>
        <li class="breadcrumb-item"><a href="#">Manage Students <i class="bi bi-people" style="font-size: 1.2rem; color: green;"></i></a></li>
                </ol>
  </nav>

  <div class="card text-center">
            <div class="card-body pt-3">
              <div class="text-center">
              <i class="bi bi-exclamation-circle text-success" style="font-size: 2.5rem;"></i>
              </div>
              <p>As the Admin you can manage all the records of all the students.</p>

              <div class="container">
      
              <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
              <select name="class" class="form-control form_data">
                            <option value="">Select Student Class</option>
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

                     <button type="submit" class="btn btn-success form-control mt-3" style="border-radius: 15px;" name="admin-view-student">Manage Class</button>
                     <div class="text-end py-3 pe-2">
                     <a href="total-students.php" class="text-danger">Check Students Analysis</a>
                     </div>
              </form>
                           
          </div>
          </div>
                    </div>

          

<?php 
                $error = [];
            if (isset($_POST['admin-view-student'])) {

              $class = $_POST['class'];

              if(empty($class)){
                $error['class'] = "<div class='text-center py-1 text-danger fs-5 fw-bold'>
                <i class='bi bi-x-circle text-danger' style='font-size: 2.5rem;'></i><br />Field Cannot be Empty</div>";
              }

              if(count($error) === 0){
                $sql = "SELECT * FROM users WHERE admin_verify='1' AND class='$class'";
                $stmt = $conn->prepare($sql);
                $stmt->execute();
                $result = $stmt->get_result();
                $count_student = $result->num_rows;
               if($count_student > 0){
                echo '
                <div class="text-center mb-3 fs-5">
                   total <span class="text-success fw-bold">'.$class.'</span> Students = <span class="text-success fw-bold">'.$count_student.'</span>
                </div>
                <table class="table table-bordered">
                <thead>
                  <tr>
                    <th scope="col">image</th>
                    <th scope="col">Lastname</th>
                    <th scope="col">Firstname</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                ';
              while($fetch = $result->fetch_assoc()){
                echo '
                <tr>
                    <td><img style="height: 70px; width: 70px;" src="uploads/'.$fetch['image'].'" class="img-fluid" /></td>
                    <td>'.$fetch['lastname'].'</td>
                    <td>'.$fetch['firstname'].'</td>
                    <td><a href="admin-view-student-profile.php?student_id='.$fetch['student_id'].'"><i class="bi bi-box-arrow-up fs-5" style="color: green;"></i></a></td>
                  </tr>
                ';
              }
              echo '
              </tbody>
              </table>
              ';
              
            }
  
               else{
                $error['class'] = "<div class='text-center py-1 text-danger fs-5 fw-bold'>
                <i class='bi bi-x-circle text-danger' style='font-size: 2.5rem;'></i><br />No Student Found</div>";
              }
            }
          }
        

?>


  <div class="text-danger text-center mb-3">
  <?php
                        if(isset($error['class'])){
                          echo $error['class'];
                        }
                        ?>
  </div>

</div>
  </div>


          

<?php require "main-footer.php"; ?>
