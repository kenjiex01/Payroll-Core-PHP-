<?php
include('../connection.php');
session_start();

// $textArray = [];
$emp_id = $_GET['emp_id'];

$sql = "SELECT * FROM employee_tbl WHERE employee_id = '$emp_id' ";
$result = $conn->query($sql);

	if ($result->num_rows > 0) {
	  // output data of each row
	  while($row = $result->fetch_assoc()) {
	  	$full_name = $row['employee_first_name']. " " . $row['employee_middle_name']. " " .$row['employee_last_name'];
	  	$textArray = array(
				    "employee_id" => $row['employee_id'],
				    "full_name" => $full_name,
				);
	  	}
	}else{
		
	}

// print_r($textArray);

  echo json_encode($textArray);
	// echo $barcode_input;

?>