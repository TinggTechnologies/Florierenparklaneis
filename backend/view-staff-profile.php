<?php
if(isset($_GET['staff_id'])){
    $staff_id = $_GET['staff_id'];
}
$sql = "SELECT * FROM staff WHERE unique_id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $staff_id);
$stmt->execute();
$result = $stmt->get_result();
if($result->num_rows > 0){
    $fetch_data = $result->fetch_assoc();
    $_SESSION['staff_lastname'] = $fetch_data['lastname'];
    $_SESSION['staff_firstname'] = $fetch_data['firstname'];
    $_SESSION['staff_class'] = $fetch_data['class'];
}
?>

<?php

if(isset($_POST['delete-staff'])){
    $staff_id = $_POST['staff_id'];
    $sql = "DELETE FROM staff WHERE unique_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $staff_id);
    if($stmt->execute()){
        $message = "Dear " . $_SESSION['admin_lastname'] . ",you just Deleted " . $_SESSION['staff_lastname'] . " " . $_SESSION['staff_firstname'] . " Records, Class Teacher of " . $_SESSION['staff_class'] . " Class";
            $notification_sql = "INSERT INTO notification (unique_id, message, time) VALUES(?,?,NOW())";
            $admin_id = "admin";
            $notification_stmt = $conn->prepare($notification_sql);
            $notification_stmt->bind_param('ss', $admin_id, $message);
            if($notification_stmt->execute()){
        header("location: delete-staff.php");
    }
}
}
?>