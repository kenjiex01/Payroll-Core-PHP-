<!DOCTYPE html>
<html>
<head>

<style>
table, td, th {
  border: 1px solid black;
}

table {
  width: 100%;
  border-collapse: collapse;
}
</style>

	<title></title>
</head>

<body>
	
<?php 
include('connection.php');

$sql = "SELECT * FROM employee_tbl";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
	  // output data of each row
	  	while($row = $result->fetch_assoc()) {
echo $row['employee_first_name']. " " . $row['employee_middle_name'] . " " . $row['employee_last_name'];
echo "<table style='text-align: center;'>
	
<thead>
	<tr>
		<td style='width: 150px;'>Date</td>
		<td style='width: 60px;'>In1</td>
		<td style='width: 60px;'>Out1</td>
		<td style='width: 60px;'>In2</td>
		<td style='width: 60px;'>Out2</td>
		<td style='width: 60px;'>In3</td>
		<td style='width: 60px;'>Out3</td>
		<td style='width: 120px;'>Hrs Deduction</td>
		<td>Hrs Required</td>
		<td>Hrs Worked</td>
		<td>Hrs OT</td>
	</tr>
</thead>
<tbody>";	
			$finger_id = $row['finger_id'];
		  	$employee_id = $row['employee_id'];	

		  	$sql1 = "SELECT * FROM employee_time WHERE finger_id = '$finger_id' GROUP BY date_in_out";
			$result1 = $conn->query($sql1);
			if ($result1->num_rows > 0) {
			  // output data of each row
			  	while($row1 = $result1->fetch_assoc()) {
				echo "<tr>
					<td style='width: 150px;'>".$row1['date_in_out']."</td>";
					$a = 0;
					$date_in = $row1['date_in_out'];
					$sql2 = "SELECT * FROM employee_time WHERE finger_id = '$finger_id' AND date_in_out='$date_in' ORDER BY time_in_out";
					$result2 = $conn->query($sql2);
					if ($result2->num_rows > 0) {
					 $aa = 1;
					  // output data of each row
					 $eight = "08:04:00";
					  	while($row2 = $result2->fetch_assoc()) {
					  		if($aa == 1 AND strtotime($row2['time_in_out']) > strtotime($eight)){
							echo "<td style='width: 60px;color:red;'>".$row2['time_in_out']." ----- $aa</td>";
					  		}else{

					  		if($row2['forgotten'] == 1){
							echo "<td style='width: 60px; color:red;'>".$row2['time_in_out']. " ---- $aa</td>";
					  		}else{
							echo "<td style='width: 60px; color:black;'>".$row2['time_in_out']. " ---- $aa</td>";
					  		}
					  		

					  		}
							$last = $row2['time_in_out'];
					  		$aa++;
						}
					}
					$b = 6 - $result2->num_rows;
					$num_time_in = $result2->num_rows;
					while ($b>$a){
						if($b>2){
						echo"<td style='width: 60px;background-color:#1ecbe1;'></td>";
						}
						else{
						echo"<td style='width: 60px;background-color:none;'></td>";	
						}
					$b--;
					}

					if(strtotime($last) < strtotime("17:00:00") AND $num_time_in == 2){
						$half = "Yes";
					}
					else{
						$half = "No";
					}
					echo "<td style='width: 120px;'>$last</td>
					<td>$num_time_in</td>
					<td>$half</td>
					<td>Hrs OT</td>
				</tr>";
			  	}
			}else{
				echo "<tr>";
				echo "<td>No Data..</td>";
				echo "</tr>";
			}	

echo "</tbody>
</table>
<br><br><br><br>
";
		}
	}else{
				
	}

?>


</body>
</html>