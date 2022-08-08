<?php
session_start();
include("connection.php");

$counter_id 		= $_POST['counter_id'];
$employee_id 		= $_POST['employee_id'];
$employee_date 		= $_POST['employee_date'];
$employee_time 		= $_POST['employee_time'];

$current_date		= date('d-m-Y H:i:s');
$altered_by 		= $_SESSION['user_id'];
if($counter_id != ""){
//update customer details
$status = "Updated";
$sql = "UPDATE employee_time SET employee_id = '$employee_id', date_in_out = '$employee_date', time_in_out = '$employee_time', status = '$status', aletered_by = '$altered_by', altered_date = '$current_date' WHERE id = '$counter_id'";

if ($conn->query($sql) === TRUE) {
} else {
  echo "Error updating record: " . $conn->error;
}

	if ($conn->query($sql) === TRUE) {
	$action = "Updated Employee Time Table(ID : ".$counter_id.")";
	include('user_logs.php');
  		$_SESSION['submitted'] = "Updated Employee Time Table(ID : ".$counter_id.")";
	  	header('location: ../customer_management.php');
	} else {
	  echo "Error Inserting Payment : " . $sql . $conn->error;
	}

$conn->close();
}//if
else{


$status = "Inserted";
//inserting new customer details
	$sql = "INSERT INTO employee_time (employee_id, date_in_out, time_in_out, status, altered_by, altered_date) VALUES ('$employee_id', '$employee_date', '$employee_time', '$status', '$altered_by', '$current_date')";

	if ($conn->query($sql) === TRUE) {
		$action = "Added a New Employee Time Record (Employee ID : ".$employee_id.")";
		include('user_logs.php');

	  echo "Added a New Employee Time Record (Employee ID : ".$employee_id.")";
	  $_SESSION['submitted'] = "Added a New Employee Time Record (Employee ID : ".$employee_id.")";
	  header('location: ../customer_management.php');
	} else {
	  echo "Error Inserting Employee Record : " . $sql . $conn->error;
	}

$conn->close();
}//else

?>