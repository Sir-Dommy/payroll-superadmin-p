<?php
session_start();
date_default_timezone_set('Africa/nairobi');


$startTime = date('Y-m-d H:i:s');
$finish = $_SESSION['endtime'];

$timeDifference = strtotime($finish) - strtotime($startTime);
// $_SESSION['endtime'] = $endTime = date('Y-m-d H:i:s', strtotime('+'.$_SESSION['duration'].'minutes', strtotime($_SESSION['stime'])));

echo gmdate("H:i:s", $timeDifference);

echo "<br>".$timeDifference
?>
