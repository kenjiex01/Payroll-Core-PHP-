<?php
include('connection.php');

$edit_id = $_SESSION['edit_id'];
	$sql = "SELECT * FROM employee_time WHERE id = '$edit_id' ";
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
	  // output data of each row
	  while($row = $result->fetch_assoc()) {
	  	$_SESSION['employee_id'] = $row['employee_id'];
	  	$_SESSION['date_in_out'] = $row['date_in_out'];
	  	$_SESSION['time_in_out'] = $row['time_in_out'];

	$sql1 = "SELECT * FROM employee_tbl WHERE employee_id = '". $_SESSION['employee_id'] ."' ";
	$result1 = $conn->query($sql1);

	if ($result1->num_rows > 0) {
	  // output data of each row
	  while($row1 = $result1->fetch_assoc()) {
	  	$_SESSION['full_name'] = $row1['employee_first_name']. " " . $row1['employee_middle_name']. " " . $row1['employee_last_name'];
	  }
	}else{
				
	}
	  }
	}else{
				
	}

?>