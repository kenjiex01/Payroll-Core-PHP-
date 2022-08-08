<?php
include('../connection.php');
session_start();

// $textArray = [];
$id = $_GET['id'];


$sql = "SELECT * FROM cash_advance_tbl WHERE id = '$id' ";
$result = $conn->query($sql);

	if ($result->num_rows > 0) {
	  // output data of each row
	  while($row = $result->fetch_assoc()) {
	  	$textArray = array(
	  				"id" => $row['id'],
				    "emp_id" => $row['employee_id'],
				    "month" => $row['month_add'],
				    "cutoff" => $row['cut_off'],
				    "amount" => $row['amount'],
				);
	  	}
	}else{
		
	}

// print_r($textArray);

  echo json_encode($textArray);
	// echo $barcode_input;

?>