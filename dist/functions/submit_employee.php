<?php
session_start();
include("../connection.php");

$employee_id = $_POST['employee_id'];
$finger_id = $_POST['finger_id'];
$first_name = $_POST['first_name'];
$middle_initial = $_POST['middle_initial'];
$last_name = $_POST['last_name'];
$company_name = $_POST['company_name'];
$position = $_POST['position'];




if($employee_id != ""){

$sql = "UPDATE employee_tbl SET finger_id = '$finger_id', employee_first_name = '$first_name', employee_middle_name = '$middle_initial', employee_last_name = '$last_name', company = '$company_name', position = '$position' WHERE employee_id = '$employee_id'";

if ($conn->query($sql) === TRUE) {
	echo "Employee updated Successfully.";
} else {
  echo "Error updating record: " . $conn->error;
}

}else{

//inserting sales
	$sql = "INSERT INTO employee_tbl (finger_id,employee_first_name,employee_middle_name,employee_last_name,company,position) VALUES ('$finger_id','$first_name','$middle_initial','$last_name','$company_name','$position')";

	if ($conn->query($sql) === TRUE) {

	  echo "Employee Added Successfully.";
	} else {
	  echo "Error Inserting data : " . $sql . $conn->error;
	}

$conn->close();
}

?>