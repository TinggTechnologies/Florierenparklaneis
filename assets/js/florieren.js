
 $(document).on('click', '#submit_btn', function(e){
  e.preventDefault();

  var firstname = $('#firstname').val();
  var lastname = $('#lastname').val();
  var email = $('#email').val();
  var telephone = $('#telephone').val();
  var student_class = $('#class').val();
  var password = $('#password').val();
  var confirm_password = $('#confirm_password').val();
  var submit_btn = $('#submit_btn').val();

  $.ajax({
    url:'backend/register-student.php',
    type:'POST',
    data:
    {
      firstname:firstname,
      lastname:lastname,
      email:email,
      telephone:telephone,
      class:student_class,
      password:password,
      confirm_password:confirm_password,
      submit_btn:submit_btn
    },
    success: function(response){
      $("#output").html(response);
    }
  });
  $("#form")[0].reset();

 });


