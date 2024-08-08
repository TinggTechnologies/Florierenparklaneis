<?php require "student-header.php"; 
if(isset($_GET['student_id'])){ 
    $incoming_id = $_GET['student_id'];
} 

?>

<style>

.chat-box{
    height: 530px;
    background: #f7f7f7;
    padding: 10px 30px 20px 30px;
    box-shadow: inset 0 32px 32px -32px rgb(0 0 0 / 5%), inset 0 -32px 32px -32px rgb(0 0 0 / 5%);
    overflow-y: auto;
}
.chat-box .chat{
    margin: 15px 0;
}
.chat-box .chat p{
    word-break: break-word;
    padding: 8px 16px;
    box-shadow: inset 0 32px 32px -32px rgb(0 0 0 / 5%), inset 0 -32px 32px -32px rgb(0 0 0 / 5%);
}
.chat-box .outgoing{
    display: flex;
}
.outgoing .details p{
    background: #333;
    color: #fff;
    border-radius: 18px 18px 0 18px;
}
.outgoing .details{
    margin-left: auto;
    max-width: calc(100% - 40px);
}
.chat-box .incoming img{
    height: 35px;
    width: 35px;
}
.chat-box .incoming{
    display: flex;

}
.incoming .details p{
    background:  green;
    color: #fff;
    border-radius: 18px 18px 18px 0;
}
.incoming .details{
    margin-left: 10px;
    margin-right: auto;
    max-width: calc(100% - 40px);
}
.chat-box::-webkit-scrollbar{
    width: 0px;
}
.chat-area .typing-area{
    padding: 5px 30px;
    display: flex;
    justify-content: space-between;
    position: fixed;
    bottom: 0;
    right: 0;
    left: 0;
    background-color: #f7f7f7;
}
.typing-area textarea{
    height: 45px;
    width: calc(100% - 58px);
    font-size: 17px;
    border: 1px solid #ccc;
    padding: 10px 13px;
    border-radius: 5px 0 05px;
    outline: none;
}
.typing-area button{
    width: 55px;
    border: none;
    outline: none;
    border-radius: 0 5px 5px 0;
    background: #333;
    color: #fff;
    font-size: 19px;
    cursor: pointer;
}

</style>

<div class="row justify-content-center">

<!-- Left side columns -->
<div class="col-lg-4">
<section class="chat-area mt-5 pt-3">
    
    <div class="chat-box">


        
    </div>

   
    <form class="typing-area mb-4" id="chat_form">
        <div id="error"></div>
        <textarea placeholder="type something <?= $row['lastname']; ?>..." id="message" name="message" class="form_data" class="input-field"></textarea>
        <input type="hidden" name="outgoing_id" id="outgoing_id" value="<?= $row['student_id']; ?>">
        <input type="hidden" name="incoming_id" id="incoming_id" value="<?= $incoming_id; ?>" />
        <button type="submit" id="chat_btn"><i class="bi bi-send text-white"></i></button>
    </form>
</section>

</div>
</div>
<?php require "chat-footer.php"; ?>

<script>
    $(document).ready(function(){

        var outgoing_id = $('#outgoing_id').val();
        var incoming_id = $('#incoming_id').val();
        var message = $('#message').val();
        var btn = $('#chat_btn').val();

        fetch_student_chat();

        setInterval(function(){
            fetch_student_chat();
        }, 1000);

        function fetch_student_chat(){
            $.ajax({
                url: "backend/fetch-s-chat.php",
                type: "POST",
                data:
                {
                    outgoing_id: outgoing_id,
                    incoming_id: incoming_id,
                    message:message,
                    btn:btn
                },
                success:function(data){
                    $('.chat-box').html(data);
                }
            });
        }

    $(document).on('click', '#chat_btn', function(e){
        e.preventDefault();

        var outgoing_id = $('#outgoing_id').val();
        var incoming_id = $('#incoming_id').val();
        var message = $('#message').val();
        var btn = $('#chat_btn').val();

        if(message == ""){
            Swal.fire(
            'Invalid',
            'Enter a message',
            'error'
          )
            }
        else{
            $.ajax({
                url: 'backend/get-student-chat.php',
                type: 'post',
                data:
                {
                    outgoing_id: outgoing_id,
                    incoming_id: incoming_id,
                    message:message,
                    btn:btn
                },
                success: function(data){
                    $('.chat-box').html(data);
                    
                }
            });
            $('#chat_form')[0].reset();
        }
    });
});                              
</script>