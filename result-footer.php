  
  <br /><br />
  <!-- Vendor JS Files -->
  <script src="assets/assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/assets/vendor/chart.js/chart.min.js"></script>
  <script src="assets/assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/assets/vendor/quill/quill.min.js"></script>
  <script src="assets/assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/assets/js/main.js"></script>
  <script src="assets/js/jquery-3.6.0.js"></script>
  <script>
  const social_btn = document.getElementsByClassName("like");

  for(let i=0; i < social_btn.length; i++){
    social_btn.onclick = () => {
    
      social_btn[i].classList.remove('bi-heart');
      social_btn[i].classList.add('bi-heart-fill');
  }

}

const message = document.querySelector('.message');

message.onkeyup = (e) =>{
  message.style.height = "auto";
  let scHeight = e.target.scrollHeight;
  message.style.height = `${scHeight}px`;
}

 </script>

<script>
    $(document).ready(function(){
        fetch_user();

        setInterval(function(){
            fetch_user();
        }, 5000);

        function fetch_user(){
            $.ajax({
                url:"backend/fetch-notification.php",
                method: "POST",
                success: function(data){
                    $(".not").html(data);
                }
            });
        }
    });
   </script>
   <script>
    $(document).ready(function(){
        fetch_message();

        setInterval(function(){
            fetch_message();
        }, 5000);

        function fetch_message(){
            $.ajax({
                url:"backend/fetch-message.php",
                method: "POST",
                success: function(data){
                    $(".mes").html(data);
                }
            });
        }
    });
   </script>
</body>

</html>