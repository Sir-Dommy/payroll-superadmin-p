<?php
session_start();

date_default_timezone_set('Africa/nairobi');

$_SESSION['duration'] = 30;
$_SESSION['stime'] = date('Y-m-d H:i:s');

// $_SESSION['endtime'] = $endTime = date('Y-m-d H:i:s', strtotime('+'.$_SESSION['duration'].'minutes', strtotime($_SESSION['stime'])));

$_SESSION['endtime'] = $endTime = date('Y-m-d H:i:s', 30*60 +  strtotime($_SESSION['stime']));

?>

<script type="text/javascript">
    window.location = "index3.php";
</script>