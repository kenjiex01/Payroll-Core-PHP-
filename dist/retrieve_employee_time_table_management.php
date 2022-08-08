<?php
include('connection.php');


	$sql = "SELECT * FROM employee_tbl";
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
	  // output data of each row
	  while($row = $result->fetch_assoc()) {

	  		$sql1 = "SELECT * FROM employee_time WHERE finger_id = '".$row['finger_id']."' ";
			$result1 = $conn->query($sql1);

			if ($result1->num_rows > 0) {
			  // output data of each row
			  while($row1 = $result1->fetch_assoc()) {

			  		echo "<tr>";
			  		echo "<td>".$row['finger_id']."</td>";
			  		echo "<td>".$row['employee_first_name']. " " . $row['employee_middle_name']. " ". $row['employee_last_name'] ."</td>";
			  		echo "<td>".$row1['date_in_out']."</td>";
			  		echo "<td style='width:100px;'>".date('h:i A',strtotime( $row1['time_in_out']))."</td>";
			  		echo "<td><a href='employee_time_management.php?edit_id=".$row1['id']."'><button class='btn btn-success'><i class='fa fa-pencil'></i> Edit</button></a>	 
			  		<button class='btn btn-danger'><i class='fa fa-trash'></i> Delete</button>
			  		</td>";
			  		echo "</tr>";
			  		
			  }
			}else{
						
			}

	  }
	}else{
				
	}
?>