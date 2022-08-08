<?php 
include('../connection.php');

$payroll_month = $_POST['payroll_month'];
$payroll_cutoff = $_POST['payroll_cutoff'];
$select_company = $_POST['select_company'];

$sql = "SELECT * FROM employee_tbl WHERE company = '$select_company'";
$result = $conn->query($sql);

	if ($result->num_rows > 0) {
	  // output data of each row
	  while($row = $result->fetch_assoc()) {
	  	$emp_id = $row['employee_id'];
	  		echo "<tr>";

	  		$sql2 = "SELECT * FROM employee_details WHERE employee_id ='$emp_id' ";
			$result2 = $conn->query($sql2);

				if ($result2->num_rows > 0) {
				  // output data of each row
				  while($row2 = $result2->fetch_assoc()) {
				  		$employee_rate = $row2['employee_rate'];
				  		$allowance = $row2['allowance'];
				  	}
				}else{
						$employee_rate = "0";
				  		$allowance = "0";
				}

				$sql3 = "SELECT * FROM deduction_tbl";
				$result3 = $conn->query($sql3);

				if ($result3->num_rows > 0) {
					  // output data of each row
					  while($row3 = $result3->fetch_assoc()) {
					  		$pagibig = $row3['PAGIBIG_deduction'];
					  		$philhealth = $row3['philhealth_deduction'];
					  	}
					}else{
							
					}


	  		$sql1 = "SELECT * FROM emp_working_hours WHERE emp_id ='$emp_id' AND month='$payroll_month' AND cutoff='$payroll_cutoff'";
			$result1 = $conn->query($sql1);

				if ($result1->num_rows > 0) {
				  // output data of each row
				  while($row1 = $result1->fetch_assoc()) {

				  		$basic_pay = $employee_rate * $row1['num_days'];
				  		$tot_allowance = $allowance * $row1['num_days'];
				  		$ot_pay = ($employee_rate / 8)*1.25;
				  		$tot_ot_pay = $ot_pay * $row1['num_ot'];
				  		$gross = $basic_pay + $row1['holiday_pay'] + $tot_ot_pay + $tot_allowance;


				  		echo "<td>".$row['employee_first_name']." ".$row['employee_middle_name']." ".$row['employee_last_name']."</td>";
				  		echo "<td>".$row1['num_days']."</td>";
				  		echo "<td>".number_format($employee_rate,2)."</td>";
				  		echo "<td>".number_format($basic_pay,2)."</td>";
				  		echo "<td>".number_format($row1['holiday_pay'],2)."</td>";
				  		echo "<td>".$row1['num_ot']."</td>";
				  		echo "<td>".number_format($tot_ot_pay,2)."</td>";
				  		echo "<td>".number_format($allowance,2)."</td>";
				  		echo "<td>".number_format($tot_allowance,2)."</td>";
				  		echo "<td>".number_format($gross,2)."</td>";
				  		if($payroll_cutoff == 'First Half'){
				  		echo "<td>".number_format($pagibig,2)."</td>"; // pagibig
				  		echo "<td>".number_format($philhealth,2)."</td>"; //philhealth
				  		echo "<td>".number_format(0,2)."</td>"; //sss
				  		}else{
				  		$philhealth = 0;
				  			$pagibig = 0;
				  		echo "<td>".number_format(0,2)."</td>"; //pagibig
				  		echo "<td>".number_format(0,2)."</td>"; //philhealth


				  		$sql5 = "SELECT num_days FROM emp_working_hours WHERE emp_id = '$emp_id' AND month = '$payroll_month'";
						$result5 = $conn->query($sql5);

							if ($result5->num_rows > 0) {
							  // output data of each row
							  while($row5 = $result5->fetch_assoc()) {
							  		$sum += $row5['num_days'];
							  	}
							}else{
									
							}

							$sql6 = "SELECT MAX(range_compensation_2),MAX(deduction) FROM sss_contribution_tbl";
							$result6 = $conn->query($sql6);

								if ($result6->num_rows > 0) {
								  // output data of each row
								  while($row6 = $result6->fetch_assoc()) {
								  		$max_range = $row6['MAX(range_compensation_2)'];
								  		$max_deduction = $row6['MAX(deduction)'];
								  	}
								}else{
										
								}

							$sss_compensation = $sum * $employee_rate; 
							if($sss_compensation >= $max_range){
								$deduction = $max_deduction;
							}else{
								$sql7 = "SELECT * FROM sss_contribution_tbl";
								$result7 = $conn->query($sql7);

									if ($result7->num_rows > 0) {
									  // output data of each row
									  while($row7 = $result7->fetch_assoc()) {
									  		if ($row7['range_compensation_1'] <= $sss_compensation AND $sss_compensation <= $row7['range_compensation_2']){
									  			$deduction = $row7['deduction'];

									  		}else{

									  		}
									  	}
									}else{
											
									}
							}


						$sss_compensation = $sum * $employee_rate; 
				  		echo "<td>".$deduction."</td>"; //sss

				  		}

				  		echo "<td>".$row1['num_late']."</td>"; //late
				  		$tardy_rate = ($employee_rate + $allowance) / 8; 
				  		$tardy_pay = $row1['num_late'] * $tardy_rate; 
				  		echo "<td>".number_format($tardy_pay,2)."</td>"; //late

				  		$sql8 = "SELECT amount FROM cash_advance_tbl WHERE employee_id = '$emp_id' AND cut_off = '$payroll_cutoff' AND month_add = '$payroll_month' ";
						$result8 = $conn->query($sql8);

							if ($result8->num_rows > 0) {
							  // output data of each row
							  while($row8 = $result8->fetch_assoc()) {
							  		$total_cash_adv += $row8['amount'];
							  	}
							}
				  		echo "<td>".number_format($total_cash_adv,2)."</td>"; //Cash Advance
				  		$net_pay = $gross - $pagibig - $deduction - $philhealth - $tardy_pay - $total_cash_adv;

				  		echo "<td>".number_format($net_pay,2)."</td>"; //NET Pay
				  		$sum = "";
				  		$deduction = "";
				  		$total_cash_adv = 0;
				  	}
				}else{
					
				}




	  		echo "</tr>";
	  	}
	}else{
		
	}

?>