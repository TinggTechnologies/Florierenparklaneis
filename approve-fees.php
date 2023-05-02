
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
  

 
<div class="text-center py-2">
  <i class="bi bi-exclamation-circle text-success" style="font-size: 2.5rem;"></i>
</div>
<p class="text-center">Dear <span><span class="text-success"><?= $_SESSION['admin_lastname']; ?></span>, You can manage those who has paid for school fees.</span>.</p>

  <?php
  
        $error = [];
        $sql = "SELECT * FROM scratch_card WHERE verified='0'";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        if($result->num_rows > 0){
            echo '
            <table class="table table-responsive table-hover table-bordered">
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
                        <td><a href="manage-scratchcard-payment.php?unique_id='.$rows['student_id'].'&&fee_id=' .$rows['scratch_card_id'].' "><i style="font-size: 1.3rem;" class="bi bi-pencil-square"></i></a></td>
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
        
?>


</div>
            </div>

        </div>
</section>

<?php 
require "main-footer.php";  ?>