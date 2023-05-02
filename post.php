
<?php 
require "admin-header.php";
require "backend/post.php";
?>

<div class="row justify-content-center">

<div class="col-lg-8">

<main id="main" class="main">
    
    <div>
      <h2 class="text-success">Your Post</h2>
      <p class="mb-5">You can type your post here</p>
<form class="post-form" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data">
<select name="user" class="form-control mb-3">
  <option value="">Select User</option>
  <option value="staff">Staff</option>
  <option value="parent">Parent</option>
  <option value="both">Both</option>
</select>
<div class="text-danger">
                <?php
                if(isset($error['user'])){
                  echo $error['user'];
                }
                ?>
              </div>
<input type="file" name="file" id="file" class="form-control">
<div class="text-danger">
                <?php
                if(isset($error['file'])){
                  echo $error['file'];
                }
                ?>
              </div>
<textarea name="message" id="message" cols="30" rows="7" class="form-control my-5"></textarea>
<div class="text-danger">
                <?php
                if(isset($error['message'])){
                  echo $error['message'];
                }
                ?>
              </div>
<button type="submit" name="post-btn" class="form-control btn btn-success" style="border-radius: 25px;">POST <i class="bi bi-send text-white"></i></button>
</form>
</div> 

            </main>
</div>
</div>

            <?php require "main-footer.php"; ?>