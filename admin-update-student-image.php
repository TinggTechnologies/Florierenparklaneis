
<?php
require "admin-header.php";
require "backend/admin-update-student-image.php";

if(isset($_GET['student_id'])){
    $student_id = $_GET['student_id'];
  }
?>


<section class="signup py-4 mt-5">

<div class="row justify-content-center">

<div class="col-lg-4">

<div class="text-center">
    <i class="bi bi-card-image" style="font-size: 3rem;"></i>
</div>
<div class="container">
<form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data">
  
  <div class="mb-3 mt-3">
    <label for="file">Upload Student Picture</label>
    <input type="file" class="form-control" id="file" name="file">
    <div class="text-danger">
    <?php
if(isset($error['file'])){
  echo $error['file'];
}
?>
  </div>
  <input type="hidden" name="student_id" value="<?= $student_id; ?>">
  <button type="submit" class="btn btn-primary form-control bg-success mt-3" name="image-btn" style="border-radius: 15px;">Upload Image</button>
</form>

</div>

</div>

</div>

</section>

<?php require "main-footer.php"; ?>