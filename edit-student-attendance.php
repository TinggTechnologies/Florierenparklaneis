<?php require "main-header.php"; ?>

<div class="container mt-5 pt-5">

<?php
          $staff_id = $_SESSION['staff'];
          $now = Date('Y-M-D');
          $sql = "SELECT * FROM student_attendance WHERE staff_id=? AND tick=?";
          $stmt = $conn->prepare($sql);
          $stmt->bind_param('ss', $staff_id, $now);
          $stmt->execute();
          $result = $stmt->get_result();
          if($result->num_rows > 0){
            $class = $row['class'];
            $sql = "SELECT * FROM users WHERE admin_verify='1' AND class='$class'";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->get_result();
            if($result->num_rows > 0){

            ?>

<table class="table table-bordered mt-5">
                <thead>
                  <tr>
                    <th scope="col">image</th>
                    <th scope="col">Lastname</th>
                    <th scope="col">Firstname</th>
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
                  </tr>

                <?php
              }
            ?>
           
                  
                </tbody>
              </table>

              <?php
          }}

          ?>
          </div>
          <?php require "main-footer.php"; ?>