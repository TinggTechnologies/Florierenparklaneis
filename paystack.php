<?php require "student-header.php"; ?>

<?php
$fees = null;
$session_sql = "SELECT * FROM set_session_tbl";
$session_stmt = $conn->prepare($session_sql); 
$session_stmt->execute();
$session_result = $session_stmt->get_result();
if($session_result->num_rows > 0){
    $get_session_result = $session_result->fetch_assoc();
}
$session = $get_session_result['set_session'];

$term_sql = "SELECT * FROM set_term_tbl";
$term_stmt = $conn->prepare($term_sql); 
$term_stmt->execute();
$term_result = $term_stmt->get_result();
if($term_result->num_rows > 0){
    $get_term_result = $term_result->fetch_assoc();
}
$term = $get_term_result['set_term'];

$fees_sql = "SELECT * FROM manage_fees_tbl";
$fees_stmt = $conn->prepare($fees_sql); 
$fees_stmt->execute();
$fees_result = $fees_stmt->get_result();
if($fees_result->num_rows > 0){
    $get_fees_result = $fees_result->fetch_assoc();
}

if($row['class'] === 'Jss-1' || $row['class'] === 'Jss-2' || $row['class'] === 'Jss-3'){
  $fees = $get_fees_result['manage_junior_fees'];
  } else{
    $fees = $get_fees_result['manage_senior_fees'];
  }
  if($fees === ''){
    $fees = 0;
  }
?>
<div class="row justify-content-center">

<!-- Left side columns -->
<div class="col-lg-4">

<section class="signup py-5 mt-4">

<div class="container">
<nav>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="student-dashboard.php"><i class="bi bi-house-door"></i></a></li>
        <li class="breadcrumb-item"><a href="#">School Fees <i class="bi bi-receipt-cutoff" style="font-size: 1.2rem;"></i></a></li>
                </ol>
  </nav>

<div class="container">
<form id="paymentForm" class="mt-5">
  <h2 class="text-center text-success">Pay School Fees</h2>
  <p class="pt-3 text-center">Pay your school fees conveniently in no time. Be rest assured that the payment done is secured by paystack. The payment will be for <span class="text-success"><?= $term; ?></span> term and  <span class="text-success"><?= $session; ?></span> session.</p>
  <div class="form-group">
    <input type="hidden" id="email-address" value="<?= $row['email'] ?>" required />
  </div>
  <div class="form-group">
    <input type="hidden" value="<?=  $fees; ?>" id="amount" required />
  </div>
  <div class="form-group">
    <input type="hidden" id="first-name" value="<?= $row['firstname'] ?>" />
  </div>
  <div class="form-group">
    <input type="hidden" id="last-name" value="<?= $row['lastname'] ?>" />
  </div>
  <div class="form-submit">
    <button type="submit" style="border-radius: 25px;" class="btn btn-success w-100 mb-5" onclick="payWithPaystack()"> Pay <?= $fees; ?></button>
  </div>
</form>
</div>

<script src="https://js.paystack.co/v1/inline.js"></script> 



<?php require "main-footer.php"; ?>
<script>
  const paymentForm = document.getElementById('paymentForm');
paymentForm.addEventListener("submit", payWithPaystack, false);
function payWithPaystack(e) {
  e.preventDefault();

  let handler = PaystackPop.setup({
    key: 'pk_test_c7e02b7b329cd65db9fb7a3321b5e2b9093465d6', // Replace with your public key
    email: document.getElementById("email-address").value,
    amount: document.getElementById("amount").value * 100,
    ref: ''+Math.floor((Math.random() * 1000000000) + 1), // generates a pseudo-unique reference. Please replace with a reference you generated. Or remove the line entirely so our API will generate one for you
    // label: "Optional string that replaces customer email"
    onClose: function(){
      window.location = "https://florierenparklaneis.com.ng/student-dashboard.php?transaction=cancel";
      alert('Transaction cancelled.');
    },
    callback: function(response){
      let message = 'Payment complete! Reference: ' + response.reference;
      alert(message);
      window.location = "http://localhost/florierenparklane.com/verify_transaction.php?reference=" + response.reference;
    }
  });

  handler.openIframe();
}
</script>

