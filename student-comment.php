<?php require "student-header.php"; 
if(isset($_GET['comment_id'])){
  $comment_id = $_GET['comment_id'];
}
?>

<style>
    .bottom{
        position: fixed;
        bottom: 0;
        left: 0;
        right: 0;
        background-color: #fff;
    }
    .bottom{
        padding-bottom: 2rem;
    }
</style>


<div class="container mt-5 pt-4">

<nav>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="student-dashboard.php"><i class="bi bi-house-door"></i></a></li>
        <li class="breadcrumb-item"><a href="#">Reply Post</a></li>
                </ol>
  </nav>
</div>

<div class="container-fluid"> 

 <section class="section dashboard mt-4">
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-12">
          <div class="row comment-box">

  
        </div><!-- End Right side columns -->

      </div>
    </section>


  <form id="comment_form">
    <div class="form-group bottom">
        <div class="row justify-content-center">
            <div class="col-lg-6 d-flex justify-content-center align-items-center"> 
            <textarea name="comment" style="width: calc(100% - 100px);" id="comment" class="comment_btn p-2" placeholder="Enter Comment"></textarea>
            <input type="hidden" name="comment_id" id="comment_id" value="<?= $comment_id; ?>">
            <button class="btn btn-success ms-2 p-3" name="comment_btn" id="comment_btn"><i class="bi bi-send text-white"></i></button>
            </div>
        </div>
    </div>
  </form>

</div>

<?php require "comment-footer.php"; ?>

<script>
    $(document).ready(function(){

        var comment = $('#comment').val();
        var comment_id = $('#comment_id').val();
        var comment_btn = $('#comment_btn').val();

        fetch_student_chat();

        setInterval(function(){
            fetch_student_chat();
        }, 1000);

        function fetch_student_chat(){
            $.ajax({
                url: "backend/fetch-s-comment.php",
                type: "POST",
                data:
                {
                    comment: comment,
                    comment_id: comment_id,
                    comment_btn:comment_btn
                },
                success:function(data){
                    $('.comment-box').html(data);
                }
            });
        }

    $(document).on('click', '#comment_btn', function(e){
        e.preventDefault();

        var comment = $('#comment').val();
        var comment_id = $('#comment_id').val();
        var comment_btn = $('#comment_btn').val();

        if(comment == ""){
            Swal.fire(
            'Invalid',
            'Enter a comment',
            'error'
          )
            }
        else{
            $.ajax({
                url: 'backend/get-student-comment.php',
                type: 'post',
                data:
                {
                    comment: comment,
                    comment_id: comment_id,
                    comment_btn:comment_btn
                },
                success: function(data){
                    $('.comment-box').html(data);
                    
                }
            });
            $('#comment_form')[0].reset();
        }
    });
});                              
</script>