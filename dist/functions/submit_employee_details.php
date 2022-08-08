<?php
session_start();
include("../connection.php");

$update_id = $_POST['update_id'];
$employee_id = $_POST['employee_id'];
$employee_name = $_POST['employee_name'];
$employee_rate = $_POST['employee_rate'];
$allowance = $_POST['allowance'];


if($update_id != ""){

$sql = "UPDATE employee_details SET employee_rate = '$employee_rate', allowance = '$allowance' WHERE id = '$update_id'";

if ($conn->query($sql) === TRUE) {
	echo "Employee details updated Successfully.";
} else {
  echo "Error updating record: " . $conn->error;
}

}else{

//inserting sales
	$sql = "INSERT INTO employee_details (employee_id, employee_rate, allowance) VALUES ('$employee_id', '$employee_rate', '$allowance')";

	if ($conn->query($sql) === TRUE) {

	  echo "Employee Details Added Successfully.";
	} else {
	  echo "Error Inserting data : " . $sql . $conn->error;
	}

$conn->close();
}

?>