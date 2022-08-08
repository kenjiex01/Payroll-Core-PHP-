<?php
include('../connection.php');
session_start();
$sql = "SELECT * FROM employee_time GROUP BY finger_id,date_in_out ";
$result = $conn->query($sql);

	if ($result->num_rows > 0) {
	  // output data of each row
	  while($row = $result->fetch_assoc()) { 
	  		$f_name = "";
			$finger_id = $row['finger_id'];  

	  	
			$sql1 = "SELECT * FROM employee_tbl WHERE finger_id = '$finger_id' ";
			$result1 = $conn->query($sql1);

				if ($result1->num_rows > 0) {
				  // output data of each row
				  while($row1 = $result1->fetch_assoc()) { 
				  	$f_name = $row1['employee_first_name'] . " " . $row1['employee_middle_name'] . " " . $row1['employee_last_name'];
							$textArray[] = array(
							  		"Employee ID" => $row['finger_id'], 
							  		"Employee Name" => $f_name, 
							  		"Date" => $row['date_in_out'],
							  		"IN" => $row['time_in_out'],
							  	);
				  }
				}
	  	


	  	}
	}else{
		$textArray = "ADasdasas";
	}
  echo json_encode($textArray);

// print_r($textArray);

	// echo $barcode_input;

?>