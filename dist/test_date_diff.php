<?php 
include('connection.php');
$date1 = date("H:i", strtotime("08:00"));

//Create a date object out of today's date:
$date2 = date("H:i", strtotime("08:01"));

//Create a comparison of the two dates and store it in an array:
$diff = (array) date_diff($date1, $date2);

//Output the array:
echo '<pre>'.print_r($diff,1).'</pre>';
// echo $diff['m'];
?>