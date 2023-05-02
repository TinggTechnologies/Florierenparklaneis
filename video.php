<?php
include('config.php');
//include('api.php');

$arr['topic'] = "Test by Leo";
$arr['start_date'] = date('2022-09-26 02:30:00');
$arr['duration'] = 30;
$arr['password'] = "leo";
$arr['type'] = "2";

$result = createMeeting($arr);
echo '<pre>';
print_r($result);
