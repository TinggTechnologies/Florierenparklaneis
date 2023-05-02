
<?php 
require "admin-header.php";
require "backend/bulk-messaging.php";
?>

<div class="row justify-content-center">

<div class="col-lg-8">

<main id="main" class="main">
    
    <div class="mt-5">
      <h2 class="text-success">Bulk Messaging</h2>
      <p class="mb-5">You can send a bulk message to all the parents, staff or both.</p>
<form class="post-form" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data">
<select name="user" class="form-control mb-3">
  <option value="">Select User</option>
  <option value="staff">Staff</option>
  <option value="parent">Parent</option>
</select>
<div class="text-danger">
                <?php
                if(isset($error['user'])){
                  echo $error['user'];
                }
                ?>
              </div>

<textarea name="message" id="message" cols="30" rows="7" class="form-control my-3"></textarea>
<div class="text-danger">
                <?php
                if(isset($error['message'])){
                  echo $error['message'];
                }
                ?>
              </div>
<button type="submit" name="bulk-btn" class="form-control btn btn-success" style="border-radius: 15px;">SEND <i class="bi bi-send text-white"></i></button>
</form>
</div> 

            </main>
</div>
</div>

            <?php require "main-footer.php"; ?>