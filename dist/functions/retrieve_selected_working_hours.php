<?php
include('../connection.php');
session_start();

// $textArray = [];
$id = $_GET['id'];


$sql = "SELECT * FROM emp_working_hours WHERE id = '$id' ";
$result = $conn->query($sql);

	if ($result->num_rows > 0) {
	  // output data of each row
	  while($row = $result->fetch_assoc()) {
	  	$textArray = array(
	  				"id" => $row['id'],
				    "emp_id" => $row['emp_id'],
				    "month" => $row['month'],
				    "cutoff" => $row['cutoff'],
				    "num_days" => $row['num_days'],
				    "num_late" => $row['num_late'],
				    "holiday_pay" => $row['holiday_pay'],
				    "num_ot" => $row['num_ot'],
				    "basic_pay" => $row['basic_pay'],
				);
	  	}
	}else{
		
	}

// print_r($textArray);

  echo json_encode($textArray);
	// echo $barcode_input;

?>