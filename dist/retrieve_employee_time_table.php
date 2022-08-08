<?php
include('connection.php');

$current_date = date("d-m-Y");

$sql = "SELECT * FROM employee_time GROUP BY date_in_out,finger_id ";
$result = $conn->query($sql);

	if ($result->num_rows > 0) {
	  // output data of each row
	  while($row = $result->fetch_assoc()) {


	  		$sql2 = "SELECT * FROM employee_tbl WHERE finger_id = '".$row['finger_id']."' ";
		$result2 = $conn->query($sql2);

			if ($result2->num_rows > 0) {
			  // output data of each row
			  while($row2 = $result2->fetch_assoc()) {
		if($row2['employee_first_name'] != ""){
			
	  	echo "<tr>";
	  	echo "<td> " . $row['finger_id'] . " </td>";
	  	echo "<td>".$row2['employee_first_name'] . " " . $row2['employee_last_name'] ."</td>";
	  	echo "<td> " . $row['date_in_out'] . " </td>";
	  	

	  	$sql1 = "SELECT * FROM employee_time WHERE finger_id = '".$row['finger_id']."' AND date_in_out = '".$row['date_in_out']."' ";
		$result1 = $conn->query($sql1);

			if ($result1->num_rows > 0) {
			  // output data of each row
			  while($row1 = $result1->fetch_assoc()) {
	  				echo "<td style='width:100px;'> " . date('h:i A',strtotime( $row1['time_in_out'])) . " </td>";
			  }
			}else{
				
			}
			$a = $result1->num_rows;
			while($a < 4){
			echo "<td style='color:red;'>No Entry</td>";
			$a++;
			}
	  	
	  	// echo "<td>  </td>";
	  	
	  	echo "</tr>";
		}
			  }
			}else{
				
			}



	  }
	}else{
		
	}

?>