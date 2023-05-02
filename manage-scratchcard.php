
<?php
require "admin-header.php"; 
?>

<section class="py-5 mt-4">


<div class="row justify-content-center">

<div class="col-lg-4">
<div class="container">

<nav>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="admin-dashboard.php"><i class="bi bi-house-door"></i></a></li>
        <li class="breadcrumb-item"><a href="#">Manage School Fees <i class="bi bi-receipt-cutoff" style="font-size: 1.2rem;"></i></a></li>
                </ol>
  </nav>
  

  <?php
    //Pre School
    $pre_school = null;
    $sql2 = "SELECT * FROM scratch_card WHERE verified='1' AND class='Pre-School'";
    $stmt2 = $conn->prepare($sql2);
    $stmt2->execute();
    $result2 = $stmt2->get_result();
    if($result2->num_rows > 0){
        while($fees_row2 = $result2->fetch_assoc()){
       
        $pre_school += $fees_row2['transfer_amount'];  
    } }else {
      $pre_school = 0;
    }

      //Pre Nursery
      $pre_nursery = null;
      $sql2 = "SELECT * FROM scratch_card WHERE verified='1' AND class='Pre_Nursery'";
      $stmt2 = $conn->prepare($sql2);
      $stmt2->execute();
      $result2 = $stmt2->get_result();
      if($result2->num_rows > 0){
          while($fees_row2 = $result2->fetch_assoc()){
         
          $pre_nursery += $fees_row2['transfer_amount'];  
      } }else {
        $pre_nursery = 0;
      }

    //Nursery 1
    $nursery1 = null;
    $sql2 = "SELECT * FROM scratch_card WHERE verified='1' AND class='Nursery-1'";
    $stmt2 = $conn->prepare($sql2);
    $stmt2->execute();
    $result2 = $stmt2->get_result();
    if($result2->num_rows > 0){
        while($fees_row2 = $result2->fetch_assoc()){
       
        $nursery1 += $fees_row2['transfer_amount'];  
    } }else {
      $nursery1 = 0;
    }

      //Nursery 2
      $nursery2 = null;
      $sql2 = "SELECT * FROM scratch_card WHERE verified='1' AND class='Nursery-2'";
      $stmt2 = $conn->prepare($sql2);
      $stmt2->execute();
      $result2 = $stmt2->get_result();
      if($result2->num_rows > 0){
          while($fees_row2 = $result2->fetch_assoc()){
         
          $nursery2 += $fees_row2['transfer_amount'];  
      } }else {
        $nursery2 = 0;
      }

  //Primary 1
                $primary1 = null;
                $sql2 = "SELECT * FROM scratch_card WHERE verified='1' AND class='Primary-1'";
                $stmt2 = $conn->prepare($sql2);
                $stmt2->execute();
                $result2 = $stmt2->get_result();
                if($result2->num_rows > 0){
                    while($fees_row2 = $result2->fetch_assoc()){
                   
                    $primary1 += $fees_row2['transfer_amount'];  
                } }else {
                  $primary1 = 0;
                }
//Primary2
                $primary2 = null;
                $sql2 = "SELECT * FROM scratch_card WHERE verified='1' AND class='Primary-2'";
                $stmt2 = $conn->prepare($sql2);
                $stmt2->execute();
                $result2 = $stmt2->get_result();
                if($result2->num_rows > 0){
                    while($fees_row2 = $result2->fetch_assoc()){
                   
                    $primary2 += $fees_row2['transfer_amount'];  
                } }else {
                  $primary2 = 0;
                }
              //Primary3
                $primary3 = null;
                $sql2 = "SELECT * FROM scratch_card WHERE verified='1' AND class='Primary-3'";
                $stmt2 = $conn->prepare($sql2);
                $stmt2->execute();
                $result2 = $stmt2->get_result();
                if($result2->num_rows > 0){
                    while($fees_row2 = $result2->fetch_assoc()){
                   
                    $primary3 += $fees_row2['transfer_amount'];  
                } }else {
                  $primary3 = 0;
                }
                //Primary4
                $primary4 = null;
                $sql2 = "SELECT * FROM scratch_card WHERE verified='1' AND class='Primary-4'";
                $stmt2 = $conn->prepare($sql2);
                $stmt2->execute();
                $result2 = $stmt2->get_result();
                if($result2->num_rows > 0){
                    while($fees_row2 = $result2->fetch_assoc()){
                   
                    $primary4 += $fees_row2['transfer_amount'];  
                } }else {
                  $primary4 = 0;
                }
                //Primary5
                $primary5 = null;
                $sql2 = "SELECT * FROM scratch_card WHERE verified='1' AND class='Primary-5'";
                $stmt2 = $conn->prepare($sql2);
                $stmt2->execute();
                $result2 = $stmt2->get_result();
                if($result2->num_rows > 0){
                    while($fees_row2 = $result2->fetch_assoc()){
                   
                    $primary5 += $fees_row2['transfer_amount'];  
                } }else {
                  $primary5 = 0;
                }

                 //Jss1
                 $jss1 = null;
                 $sql2 = "SELECT * FROM scratch_card WHERE verified='1' AND class='Jss-1'";
                 $stmt2 = $conn->prepare($sql2);
                 $stmt2->execute();
                 $result2 = $stmt2->get_result();
                 if($result2->num_rows > 0){
                     while($fees_row2 = $result2->fetch_assoc()){
                    
                     $jss1 += $fees_row2['transfer_amount'];  
                 } }else {
                   $jss1 = 0;
                 }

                  //Jss1
                  $jss2 = null;
                  $sql2 = "SELECT * FROM scratch_card WHERE verified='1' AND class='Jss-2'";
                  $stmt2 = $conn->prepare($sql2);
                  $stmt2->execute();
                  $result2 = $stmt2->get_result();
                  if($result2->num_rows > 0){
                      while($fees_row2 = $result2->fetch_assoc()){
                     
                      $jss2 += $fees_row2['transfer_amount'];  
                  } }else {
                    $jss2 = 0;
                  }

                   //Jss3
                 $jss3 = null;
                 $sql2 = "SELECT * FROM scratch_card WHERE verified='1' AND class='Jss-3'";
                 $stmt2 = $conn->prepare($sql2);
                 $stmt2->execute();
                 $result2 = $stmt2->get_result();
                 if($result2->num_rows > 0){
                     while($fees_row2 = $result2->fetch_assoc()){
                    
                     $jss3 += $fees_row2['transfer_amount'];  
                 } }else {
                   $jss3 = 0;
                 }

                  //ss1
                  $ss1 = null;
                  $sql2 = "SELECT * FROM scratch_card WHERE verified='1' AND class='Ss-1'";
                  $stmt2 = $conn->prepare($sql2);
                  $stmt2->execute();
                  $result2 = $stmt2->get_result();
                  if($result2->num_rows > 0){
                      while($fees_row2 = $result2->fetch_assoc()){
                     
                      $ss1 += $fees_row2['transfer_amount'];  
                  } }else {
                    $ss1 = 0;
                  }

                   //ss2
                 $jss2 = null;
                 $sql2 = "SELECT * FROM scratch_card WHERE verified='1' AND class='Ss-2'";
                 $stmt2 = $conn->prepare($sql2);
                 $stmt2->execute();
                 $result2 = $stmt2->get_result();
                 if($result2->num_rows > 0){
                     while($fees_row2 = $result2->fetch_assoc()){
                    
                     $ss2 += $fees_row2['transfer_amount'];  
                 } }else {
                   $ss2 = 0;
                 }
             
               //Jss1
               $ss3 = null;
               $sql2 = "SELECT * FROM scratch_card WHERE verified='1' AND class='Ss-3'";
               $stmt2 = $conn->prepare($sql2);
               $stmt2->execute();
               $result2 = $stmt2->get_result();
               if($result2->num_rows > 0){
                   while($fees_row2 = $result2->fetch_assoc()){
                  
                   $ss3 += $fees_row2['transfer_amount'];  
               } }else {
                 $ss3 = 0;
               }      
                      ?>
<div class="text-center py-2">
  <i class="bi bi-exclamation-circle text-success" style="font-size: 2.5rem;"></i>
</div>
<p class="text-center">Dear <span><span class="text-success"><?= $_SESSION['admin_lastname']; ?></span>, You can manage those who has paid for school fees.</span>.</p>

<div class="col-lg-6">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Primary Class</h5>

              <!-- Bar Chart -->
              <canvas id="barChart" style="max-height: 400px;"></canvas>
              <script>
                document.addEventListener("DOMContentLoaded", () => {
                  new Chart(document.querySelector('#barChart'), {
                    type: 'bar',
                    data: {
                      labels: ['PRE-S', 'PRE-N', 'NUR-1', 'NUR-2', 'PRI-1', 'PRI-2', 'PRI-3', 'PRI-4', 'PRI-5'],
                      datasets: [{
                        label: 'Bar Chart',
                        data: [<?= $pre_school; ?>, <?= $pre_nursery; ?>, <?= $nursery1; ?>, <?= $nursery2; ?>, <?= $primary1; ?>, <?= $primary2; ?>, <?= $primary3; ?>, <?= $primary4; ?>, <?= $primary5; ?>],
                        backgroundColor: [
                          'rgba(255, 99, 132, 0.2)',
                          'rgba(255, 159, 64, 0.2)',
                          'rgba(255, 205, 86, 0.2)',
                          'rgba(75, 192, 192, 0.2)',
                          'rgba(54, 162, 235, 0.2)',
                          'rgba(153, 102, 255, 0.2)',
                          'rgba(201, 203, 207, 0.2)'
                        ],
                        borderColor: [
                          'rgb(255, 99, 132)',
                          'rgb(255, 159, 64)',
                          'rgb(255, 205, 86)',
                          'rgb(75, 192, 192)',
                          'rgb(54, 162, 235)',
                          'rgb(153, 102, 255)',
                          'rgb(201, 203, 207)'
                        ],
                        borderWidth: 1
                      }]
                    },
                    options: {
                      scales: {
                        y: {
                          beginAtZero: true
                        }
                      }
                    }
                  });
                });
              </script>
              <!-- End Bar CHart -->

            </div>
          </div>
        </div>

        <div class="col-lg-6">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Secondary Class</h5>

              <!-- Pie Chart -->
              <canvas id="pieChart" style="max-height: 400px;"></canvas>
              <script>
                document.addEventListener("DOMContentLoaded", () => {
                  new Chart(document.querySelector('#pieChart'), {
                    type: 'pie',
                    data: {
                      labels: [
                        'JSS1',
                        'JSS2',
                        'JSS3',
                        'SS1',
                        'SS2',
                        'SS3'
                      ],
                      datasets: [{
                        label: 'My First Dataset',
                        data: [<?= $jss1; ?>, <?= $jss2; ?>, <?= $jss3; ?>, <?= $ss1; ?>, <?= $ss2; ?>, <?= $ss3; ?>],
                        backgroundColor: [
                          'rgb(255, 99, 132)',
                          'rgb(255, 159, 64)',
                          'rgb(255, 205, 86)',
                          'rgb(54, 162, 235)',
                          'rgb(153, 102, 255)',
                          'rgb(201, 203, 207)'
                        ],
                        hoverOffset: 4
                      }]
                    }
                  });
                });
              </script>
              <!-- End Pie CHart -->

            </div>
          </div>
        </div>

       
  <?php
  /*
        $error = [];
        $sql = "SELECT * FROM scratch_card WHERE verified='0'";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        if($result->num_rows > 0){
            echo '
            <table class="table table-responsive table-hover">
                <tr>
                  <th>Image</th>
                  <th>Name</th>
                  <th>Action</th>
                </tr>
            ';
            while($rows = $result->fetch_assoc()){
                $student_id = $rows['student_id'];
                $sql1 = "SELECT * FROM users WHERE student_id=?";
                $stmt1 = $conn->prepare($sql1);
                $stmt1->bind_param('s', $student_id);
                $stmt1->execute();
                $result1 = $stmt1->get_result();
                if($result1->num_rows > 0){
                    $fetch = $result1->fetch_assoc();
                echo
                '
                <tr>
                        <td><img style="width: 50px; height: 50px;" src="uploads/'. $fetch['image'].'"></td>    
                        <td>'. $fetch['lastname']  . ' ' .  $fetch['firstname'] .'</td>
                        <td><a href="manage-scratchcard-payment.php?unique_id='.$rows['student_id'].'"><i style="font-size: 1.3rem;" class="bi bi-pencil-square"></i></a></td>
                    </tr>
                ';
            }}
            echo '
            </table>
           
            ';
            
       } else{
            echo "<div class='text-center py-1 text-danger fs-5 fw-bold'>
            <i class='bi bi-x-circle text-danger' style='font-size: 2.5rem;'></i><br />No New Payment</div>";
        }
        */
?>

<div class="btns">
  <a href="manage-money.php" class="btn btn-success form-control" style="border-radius: 15px;">Manage Payment</a>
  <a href="approve-fees.php" class="btn btn-success form-control mt-3" style="border-radius: 15px;">Approve Payment</a>
      </div>

</div>
            </div>

        </div>
</section>

<?php 
require "main-footer.php";  ?>