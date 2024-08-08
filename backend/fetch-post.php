<?php

session_start();
include "../database/connection.php";

if(isset($_SESSION['student'])){
    $staff_id = $_SESSION['student'];
}
$output = '';

$sql = "SELECT * FROM post WHERE user='parent' OR user='both' ORDER BY post_id ASC";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->get_result();
            if($result->num_rows > 0){
              while($fetch = $result->fetch_assoc()){
                $admin = $fetch['admin_id'];
                $comment_id = $fetch['post_id'];
                $sql = "SELECT * FROM staff WHERE unique_id='$admin'";
                $stmt = $conn->prepare($sql);
                $stmt->execute();
               $result_row = $stmt->get_result();
               if($result_row->num_rows > 0){
                  $fetch_row = $result_row->fetch_assoc();
                  $sql = "SELECT * FROM comment WHERE post_id='$comment_id'";
                  $stmt = $conn->prepare($sql);
                  $stmt->execute();
                  $get_result = $stmt->get_result();
                  $count_comment = $get_result->num_rows;
                  $sql = "SELECT * FROM likes WHERE post_id='$comment_id'";
                  $stmt = $conn->prepare($sql);
                  $stmt->execute();
                  $likes_result = $stmt->get_result();
                  $count_likes = $likes_result->num_rows;
                  $sql4 = "SELECT * FROM likes WHERE post_id='$comment_id' AND unique_id='$staff_id'";
                  $stmt4 = $conn->prepare($sql4);
                  $stmt4->execute();
                  $likes_result4 = $stmt4->get_result();
                  if($likes_result4->num_rows > 0){
                    $click_likes = "bi bi-heart-fill";
                  } else {
                    $click_likes = "bi bi-heart";
                  }
              

    $output .= '  <div class="col-lg-4">
      <div class="card info-card sales-card">

        <div class="filter">
          <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">

            <li><a class="dropdown-item" href="#"><i class="bi bi-person"></i>Profile</a></li>
            <li><a class="dropdown-item" href="#"><i class="bi bi-send"></i>Message</a></li>
            <li><a class="dropdown-item" href="#"><i class="bi bi-telephone-outbound"></i>Call</a></li>
          </ul>
        </div>

        <div class="card-body">
          <h5 class="card-title"><a class="nav-link nav-profile d-flex align-items-center pt-0" href="#" data-bs-toggle="dropdown">
            <img style="height: 40px; width: 40px;" src="uploads/'. $fetch_row['image'].'" alt="Profile" class="rounded-circle">
            <span class="d-md-block ps-2">'. $fetch_row['lastname'].' '. $fetch_row['firstname'].'</span>
          </a><!-- End Profile Iamge Icon --></h5>

          <div class="row g-0">
            <div class="col-lg-12">
              <img  src="uploads/'. $fetch['image'] .'" class="img-fluid rounded-start img-responsive" style="width: 100%; height: 250px;" alt="...">
            </div>
            <p class="card-text pt-3">'. $fetch['text'] .'</p>
            <hr>
         
          <div class="row">
            <div class="col-sm-12 d-flex align-items-center justify-content-between">
            <a href="likes.php?comment_id='. $fetch['post_id'].'"><i class="'.$click_likes.' social-btn post-bar-toggle"></i><span class="badge bg-white text-success">'. $count_likes.'</span></a>
            <a href="student-comment.php?comment_id='. $fetch['post_id'].'"><i class="bi bi-chat-text social-btn post-bar-toggle"></i><span class="badge bg-white text-success">'. $count_comment.'</span></a>
            <div><i class="bi bi-share social-btn"></i><span class="badge bg-white text-success"></span></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>';
    

    } }}  else {
      $output .= '
      <div class="col-lg-4">
      <div class="card info-card sales-card">

        <div class="card-body">
  

          <div class="row g-0 text-center">
      <i class="bi bi-exclamation-circle-fill pt-3 text-danger" style="font-size: 5rem;"></i>
            <p class="card-text pt-3" style="font-weight: 700;">No Post</p>

        </div>
      </div>
    </div>
  </div>
      ';
    }

    

    echo $output;