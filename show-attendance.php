<?php

$sql = "SELECT * FROM student_attendance WHERE staff_id=? AND tick=?";
          $stmt = $conn->prepare($sql);
          $stmt->bind_param('ss', $staff_id, $now);
          $stmt->execute();
          $result = $stmt->get_result();
          if($result->num_rows > 0){

          }

          ?>+