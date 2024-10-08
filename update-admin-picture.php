
<?php
require "admin-header.php";
require "backend/admin-profile-picture.php";
?>

<section class="signup py-4 mt-5">
<div class="text-center">
    <i class="bi bi-card-image" style="font-size: 3rem;"></i>
</div>
<div class="container">
<form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data">
  
  <div class="mb-3 mt-3">
  <div class="text-center mt-2">
    <?php
if(isset($error['file'])){
  echo $error['file'];
}
?>
  </div>
    <label for="file">Upload Staff Picture</label>
    <input type="file" class="form-control" id="file" name="file">
  
  <button type="submit" class="btn btn-primary form-control bg-success mt-3" name="image-btn">Upload Image</button>
</form>

</div>
</section>

<?php require "main-footer.php"; ?>