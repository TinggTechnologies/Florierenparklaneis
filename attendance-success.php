
<?php
require "main-header.php";
?>

<div class="row justify-content-center">
    <div class="col-lg-6">
    <section class="signup py-5 mt-5">
<div class="container">
<div class="text-center">
    <i class="bi bi-check-circle-fill text-success" style="font-size: 3.5rem;"></i>
    </div>
    <p class="text-center">You have successfully uploaded <span class="text-success"><?= $row['class']; ?></span> class <span class="text-success">attendance.</p>
    <a href="dashboard.php" class="bg-success text-white form-control text-center" style="border-radius: 15px;">Continue</a>
</div>
</section>  
    </div>
</div> 

<?php require "main-footer.php"; ?>