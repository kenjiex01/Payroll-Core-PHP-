<?php
include('../connection.php');
session_start();

// $textArray = [];
$num_days = $_POST['num_days'];
$employee_idsss = $_POST['employee_idsss'];


$sql = "SELECT * FROM employee_details WHERE employee_id = '$employee_idsss' ";
$result = $conn->query($sql);

	if ($result->num_rows > 0) {
	  // output data of each row
	  while($row = $result->fetch_assoc()) {
	  	$basic_pay = $row['employee_rate'] * $num_days;
	  	// $basic_pay = number_format($number_format,2);
	  	$textArray = array(
	  				"basic_pay" => $basic_pay,
				);
	  	}
	}else{
		
	}

// print_r($textArray);

  echo json_encode($textArray);
	// echo $barcode_input;

?>