<?php
include("../connection.php");
$time = strtotime("202-1");
$final = date("Y-m-d", strtotime("+1 month", $time));


echo $time."<br>";
// echo $final."<br>";
?>