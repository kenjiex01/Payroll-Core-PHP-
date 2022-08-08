<?php
session_start();
include("../connection.php");

$employee_id = $_POST['emp_id'];
$status = $_POST['status'];
$date_modified = date("Y-m-d");

$sql = "UPDATE employee_tbl SET  status = '$status', status_date = '$date_modified' WHERE employee_id = '$employee_id'";

if ($conn->query($sql) === TRUE) {
	echo "Employee Status updated Successfully.";
	$action = "Updated Employee ID : ". $employee_id . " Status to : " . $status;
	include("../user_logs.php");
} else {
  echo "Error updating record: " . $conn->error;
}


$conn->close();

?>