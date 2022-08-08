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



	  	$sql1 = "SELECT * FROM employee_details WHERE employee_id = '$edit_id' ";
		$result1 = $conn->query($sql1);

			if ($result1->num_rows > 0) {
			  // output data of each row
			  while($row1 = $result1->fetch_assoc()) {
			  	$full_name = $row['employee_first_name']. " " . $row['employee_middle_name']. " " .$row['employee_last_name'];
			  	$textArray = array(
			  				"update_id" => $row1['id'],
						    "employee_id" => $row['employee_id'],
						    "full_name" => $full_name,
						    "rate" => $row1['employee_rate'],
						    "allowance" => $row1['allowance'],
						);
			  }
			}
	  	}
	}else{
		
	}

// print_r($textArray);

  echo json_encode($textArray);
	// echo $barcode_input;

?>