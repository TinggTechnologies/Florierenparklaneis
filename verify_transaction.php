<?php
session_start();
require "database/connection.php";

if(isset($_SESSION['student'])){
    $id = $_SESSION['student'];
    
}

$sql = "SELECT * FROM users WHERE student_id=?";
              $stmt = $conn->prepare($sql);
              $stmt->bind_param('s', $id);
              $stmt->execute();
              $result = $stmt->get_result();
              if($result->num_rows > 0){
                $row = $result->fetch_assoc();
                $class = $row['class'];
              }

              $term_sql = "SELECT * FROM set_term_tbl";
$term_stmt = $conn->prepare($term_sql); 
$term_stmt->execute();
$term_result = $term_stmt->get_result();
if($term_result->num_rows > 0){
    $get_term_result = $term_result->fetch_assoc();
}
$term = $get_term_result['set_term'];

$session_sql = "SELECT * FROM set_session_tbl";
$session_stmt = $conn->prepare($session_sql); 
$session_stmt->execute();
$session_result = $session_stmt->get_result();
if($session_result->num_rows > 0){
    $get_session_result = $session_result->fetch_assoc();
}
$session = $get_session_result['set_session'];

if(isset($_GET['reference'])){
    $ref = $_GET['reference'];
}
if($ref == ""){
    echo "<script>location.href = 'javascript://history.go(-1)';</script>";
}

  $curl = curl_init();
  
  curl_setopt_array($curl, array(
    CURLOPT_URL => "https://api.paystack.co/transaction/verify/" . rawurlencode($ref),
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => array(
      "Authorization: Bearer sk_test_1654a956a101f80a62752ac1d6053f1cee359bc0",
      "Cache-Control: no-cache",
    ),
  ));
  
  $response = curl_exec($curl);
  $err = curl_error($curl);

  curl_close($curl);
  
  if ($err) {
    echo "cURL Error #:" . $err;
  } else {
    $result = json_decode($response);
  }

  if($result->data->status == "success"){
    $status = $result->data->status;
    $reference = $result->data->reference;
    $amount = $result->data->amount;
    $transfer_date = $result->data->paid_at;
    date_default_timezone_set('Africa/Lagos');
    $date_time = date('m/d/y h:i:s a', time());

    $sql1 = "INSERT INTO scratch_card (student_id, class, transfer_amount, transfer_date, term, session, status, reference, date, verified) VALUES(?,?,?,?,?,?,?,?,?, '1')";
    $sql1 = $conn->prepare($sql1);
    $sql1->bind_param('sssssssss', $id, $class, $amount, $transfer_date, $term, $session, $status, $reference, $date_time);
    if($sql1->execute()){
        echo '<script>location.href = "success.php?status='.$reference.'";</script>';
    }

  } else {
    echo "<script>location.href = 'error.php';</script>";
  }
  
?>