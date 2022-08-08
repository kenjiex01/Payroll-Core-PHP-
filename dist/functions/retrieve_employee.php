<?php
include('../connection.php');
session_start();

// $textArray = [];
$edit_id = $_GET['edit_id'];


$sql = "SELECT * FROM employee_tbl WHERE employee_id = '$edit_id' ";
$result = $conn->query($sql);

	if ($result->num_rows > 0) {
	  // output data of each row
	  while($row = $result->fetch_assoc()) {
	  			

			  	$textArray = array(
						    "employee_id" => $row['employee_id'],
						    "fingerprint" => $row['finger_id'],
						    "first_name" => $row['employee_first_name'],
						    "middle_name" => $row['employee_middle_name'],
						    "last_name" => $row['employee_last_name'],
						    "company" => $row['company'],
						    "position" => $row['position'],
						);

	  	
	  	}
	}else{
		
	}

// print_r($textArray);

  echo json_encode($textArray);
	// echo $barcode_input;

?>