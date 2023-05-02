<?php
require "student-session.php"; 
require "database/connection.php";
require "backend/download-pdf.php";
require "backend/payment.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Florieren Parklane International School</title>
  <meta content="Florieren Parklane International School, Lagos was opened few years ago with the aim of enhancing an academically sound and godly young individuals. The school started with creche, Pre-Nursery, Nursery and Years One-Five in the Primary section and gradually opened the High School section which is still under development" name="description">
  <meta content="florieren parklane international school, florieren park lane, florieren" name="keywords">

  <!-- Favicons -->
  <link href="assets/assets/img/logo.png" rel="icon">
  <link href="assets/assets/img/logo.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/assets/css/style.css" rel="stylesheet">
  <link href="./assets/css/sweetalert.css" rel="stylesheet">

</head>

<body>

<?php
              $staff_id = $_SESSION['student'];
              $sql = "SELECT * FROM users WHERE student_id=?";
              $stmt = $conn->prepare($sql);
              $stmt->bind_param('s', $staff_id);
              $stmt->execute();
              $result = $stmt->get_result();
              if($result->num_rows > 0){
                $row = $result->fetch_assoc();
              }
              $stmt->close();
              ?>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="student-dashboard.php" class="logo d-flex align-items-center">
        <img src="assets/img/florieren/logo.png" alt="">
        <span class="d-none d-lg-block">Florieren ParkLane</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    <div class="search-bar">
      <form class="search-form d-flex align-items-center" method="POST" action="#">
        <input type="text" name="query" placeholder="Search" title="Enter search keyword">
        <button type="submit" title="Search"><i class="bi bi-search"></i></button>
      </form>
    </div><!-- End Search Bar -->

    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">

        <li class="nav-item d-block d-lg-none">
          <a class="nav-link nav-icon search-bar-toggle " href="#">
            <i class="bi bi-search"></i>
          </a>
        </li><!-- End Search Icon-->

        <?php
if(isset($_POST['student-notification'])){
  $not_sql = "UPDATE notification SET unset='1' WHERE unique_id=? OR unique_id='student'";
  $not_stmt = $conn->prepare($not_sql);
  $not_stmt->bind_param('s', $staff_id);
  if($not_stmt->execute()){
    echo "<script>location.href = 'student-notification.php';</script>";
  }
}

?>

        <li class="nav-item dropdown">
       <div class="not">

       </div>


        <li class="nav-item dropdown">

          <div class="mes">
            
          </div>


          </li>

    
        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <img src="uploads/<?php echo $row['image']; ?>" alt="Profile" class="rounded-circle">
            <span class="d-none d-md-block dropdown-toggle ps-2"><?php echo $row['lastname'] . ' ' . $row['firstname']; ?></span>
          </a><!-- End Profile Iamge Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6><?php echo $row['lastname'] . ' ' . $row['firstname']; ?></h6>
              <span><?php echo $_SESSION['student']; ?></span>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="student-profile.php">
                <i class="bi bi-person"></i>
                <span>My Profile</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="student-profile.php">
                <i class="bi bi-cloud-arrow-up"></i>
                <span>Edit Profile</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="student-profile.php">
                <i class="bi bi-lock"></i>
                <span>Change Password</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="student-logout.php">
                <i class="bi bi-box-arrow-right"></i>
                <span>Sign Out</span>
              </a>
            </li>

          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link collapsed" href="student-dashboard.php">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->

      <li class="nav-item">
        <a class="nav-link " href="student-profile.php">
          <i class="bi bi-person"></i>
          <span>Profile</span>
        </a>
      </li><!-- End Profile Page Nav -->

      <li class="nav-heading">Features</li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="pay.php">
          <i class="bi bi-cash-coin"></i>
          <span>Pay Bills</span>
        </a>
      </li><!-- Manage Result -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="fees-status.php">
          <i class="bi bi-clock-history"></i>
          <span>Transaction History</span>
        </a>
      </li><!-- Manage Result -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="print-receipt.php">
          <i class="bi bi-printer"></i>
          <span>Print Receipt</span>
        </a>
      </li><!-- Manage Result -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="student-checking-result.php">
          <i class="bi bi-reception-4"></i>
          <span>Result Checker</span>
        </a>
      </li><!-- Manage Result -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="student-library.php">
          <i class="bi bi-book"></i>
          <span>Library</span>
        </a>
      </li><!-- Manage Library -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="view-class-timetable.php">
          <i class="bi bi-clock"></i>
          <span>Class Time Table</span>
        </a>
      </li><!-- Manage Library -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="view-exam-timetable.php">
          <i class="bi bi-clock"></i>
          <span>Exam Time Table</span>
        </a>
      </li><!-- Exam Time-Table -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="check-assignment.php">
          <i class="bi bi-receipt-cutoff"></i>
          <span>Assignment</span>
        </a>
      </li><!-- End Manage Assignment -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="maintenance.php">
          <i class="bi bi-display"></i>
          <span>Virtual Class Room</span>
        </a>
      </li><!-- End Manage Assignment -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="note.php">
          <i class="bi bi-book"></i>
          <span>Lecture Notes</span>
        </a>
      </li><!-- End Manage Assignment -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="tutorial-video.php">
          <i class="bi bi-book"></i>
          <span>Tutorial Videos</span>
        </a>
      </li><!-- End Manage Assignment -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="start-cbt.php">
          <i class="bi bi-diagram-3"></i>
          <span>Cbt Test</span>
        </a>
      </li><!-- End Manage Assignment -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="student-attendance.php">
          <i class="bi bi-diagram-3"></i>
          <span>Attendance</span>
        </a>
      </li><!-- End Manage Assignment -->


    </ul>

  </aside><!-- End Sidebar-->

