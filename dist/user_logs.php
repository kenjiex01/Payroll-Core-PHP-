<?php
include('connection.php');
$user_id = $_SESSION['user_id'];
$date_user_log = date('d-m-Y');
$time_user_log = date("h:i:s");

//inserting collections
	$sql = "INSERT INTO user_log (user_id, action, date_added, time_added) VALUES ('$user_id', '$action', '$date_user_log', '$time_user_log')";

	if ($conn->query($sql) === TRUE) {
	  
	} else {
	  echo "Error Inserting Payment : " . $sql . $conn->error;
	}

?>