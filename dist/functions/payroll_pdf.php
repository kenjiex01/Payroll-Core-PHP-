<?php 
include('../connection.php');
include('../assets/fpdf/fpdf.php');

$payroll_month = $_POST['payroll_month_generate'];
$payroll_cutoff = $_POST['payroll_cutoff_generate'];
$select_company = $_POST['select_company'];
$start_date = $_POST['start_date_gen'];
$end_date = $_POST['end_date_gen'];

$total_cash_adv = 0;

$total_basic_pay = 0;
$total_holiday_pay = 0;
$total_num_ot = 0;
$total_ot_pay = 0;
$total_allowance = 0;
$total_gross = 0;
$total_pagibig = 0;
$total_sss = 0;
$total_philhealth = 0;
$total_num_late = 0;
$total_tardy_pay = 0;
$total_cash_advance = 0;
$total_net_pay = 0;

$_SESSION['file_name'] = "Payroll ( ".$payroll_month." ". $payroll_cutoff ." )";

//Start of Header
$pdf = new FPDF();
$pdf->AddPage('L','Letter');
$pdf->SetFont('arial','B',16);
$pdf->SetFillColor(255,248,28);
//$pdf->Image("img/DMMMSU.png",70,8,30,30,'PNG');
//$pdf->Image("img/MLUC.jpg",270,8,30,30,'jpg');
$pdf->Cell(18,8,'',0);
$pdf->Cell(50, 5, "PAYROLL REPORT (". $select_company.")",0,1,"C");
$pdf->Ln(3);

$pdf->SetFont("arial","",10);
$pdf->Cell(50, 5, "PAY PERIOD : " . date("M. d,Y"),0,1,"L");
$pdf->Cell(50, 5, "Pay Coverage : " . date("M. d,Y", strtotime($start_date)) . " - " . date("M. d,Y", strtotime($end_date)),0,1,"L");
$pdf->Cell(50, 5, "Date : " . date("M. d,Y"),0,1 ,"L");
$pdf->Ln(5);
$pdf->SetFont("arial","",8);


$holiday_counter = "";
$not_counter = "";
$sql9 = "SELECT * FROM employee_tbl WHERE company = '$select_company' ORDER BY employee_last_name";
$result9 = $conn->query($sql9);
if ($result9->num_rows > 0) {
  // output data of each row
  	while($row9 = $result9->fetch_assoc()) {
  		$eid = $row9['employee_id'];
  		$sql10 = "SELECT * FROM emp_working_hours WHERE emp_id = '$eid' AND month = '$payroll_month' AND cutoff ='$payroll_cutoff' ";
		$result10 = $conn->query($sql10);
		if ($result10->num_rows > 0) {
		  // output data of each row
		  	while($row10 = $result10->fetch_assoc()) {
		  		if($row10['holiday_pay'] != 0){
		  		$holiday_counter = $holiday_counter + 1;
		  		}

		  		if($row10['num_ot'] != 0)
		  		{
		  			$not_counter = $not_counter + 1;
		  		}

		  	}
		}


  	}
}

if($holiday_counter != 0){
$hol_size = 0;
}else{
$hol_size = 17;
}

if($not_counter != 0){
$not_size = 0;
}else{
$not_size = 23;
}




//End of Header

$pdf->SetFont('arial','B',9,'C');
$pdf->Cell(-5,8,'',0,0,"C");
$pdf->Cell(60,8,'',1,0,"C");
$pdf->Cell(140-$hol_size-$not_size,8,'TOTAL GROSS SALARY',1,0,"C");
if($payroll_cutoff == "First Half"){
$pdf->Cell(53,8,'DEDUCTIONS',1,0,"C");
}else{
$pdf->Cell(40,8,'DEDUCTIONS',1,0,"C");
}

$pdf->Cell(20,8,'',1,0,"C");	
$pdf->Ln(8);

$pdf->SetFont('arial','B',9,'C');
$pdf->Cell(-5,8,'',0,0,"C");
$pdf->Cell(60,8,'Name',1,0,"C");
$pdf->Cell(15,8,'Days',1,0,"C");
$pdf->Cell(15,8,'Rate',1,0,"C");
$pdf->Cell(20,8,'Basic Pay',1,0,"C");

if($holiday_counter != 0){
$pdf->Cell(17,8,'Holiday',1,0,"C");
}


if($not_counter != 0){
$pdf->Cell(8,8,'OT',1,0,"C");
$pdf->Cell(15,8,'OT Pay',1,0,"C");
}
$pdf->Cell(15,8,'ALW',1,0,"C");
$pdf->Cell(20,8,'Total ALW',1,0,"C");
$pdf->Cell(15,8,'GROSS',1,0,"C",true);

if($payroll_cutoff == "First Half"){
$pdf->Cell(15,8,'PAGIBIG',1,0,"C");
$pdf->Cell(13,8,'PHIC',1,0,"C");
}else{
$pdf->Cell(15,8,'SSS',1,0,"C");
}


$pdf->Cell(10,8,'Late',1,0,"C");
$pdf->Cell(15,8,'Late Pay',1,0,"C");
$pdf->Cell(20,8,'NET Pay',1,0,"C",true);
$pdf->Ln(8);


$sql = "SELECT * FROM employee_tbl WHERE company = '$select_company' ORDER BY employee_last_name";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
  // output data of each row
  	while($row = $result->fetch_assoc()) {
  	$contribution_status = $row['contribution_status'];
  	$emp_id = $row['employee_id'];
	  	
  	$sql1 = "SELECT * FROM employee_details WHERE employee_id='$emp_id'";
	$result1 = $conn->query($sql1);
	if ($result1->num_rows > 0) {
	  // output data of each row
	  	while($row1 = $result1->fetch_assoc()) {
	  	$employee_rate = $row1['employee_rate'];
		$allowance = $row1['allowance'];
		  	
		  		

		}
	}else{
		$employee_rate = "0";
		$allowance = "0";			
	}

	if($contribution_status == "Yes"){

		$sql3 = "SELECT * FROM deduction_tbl";
		$result3 = $conn->query($sql3);

		if ($result3->num_rows > 0) {
			// output data of each row
			while($row3 = $result3->fetch_assoc()) {
			  	$pagibig_ee = $row3['PAGIBIG_deduction'];
			  	$pagibig_er = $row3['PAGIBIG_ER'];
			  	$philhealth_ee = $row3['philhealth_deduction'];
			  	$philhealth_er = $row3['philhealth_ER'];
			}
		}else{
								
		}
	}else{
				$pagibig_ee = 0;
			  	$pagibig_er = 0;
			  	$philhealth_ee = 0;
			  	$philhealth_er = 0;
	}


	$sql2 = "SELECT * FROM emp_working_hours WHERE emp_id = '$emp_id' AND month='$payroll_month' AND cutoff='$payroll_cutoff'";
	$result2 = $conn->query($sql2);
	if ($result2->num_rows > 0) {
	  // output data of each row
	  	while($row2 = $result2->fetch_assoc()) {
	  	$basic_pay = $employee_rate * $row2['num_days'];
		$tot_allowance = $allowance * $row2['num_days'];
		$ot_pay = ($employee_rate / 8)*1.25;
		$tot_ot_pay = $ot_pay * $row2['num_ot'];
		$gross = $basic_pay + $row2['holiday_pay'] + $tot_ot_pay + $tot_allowance;
		$full_name = utf8_decode($row['employee_first_name']." ".$row['employee_middle_name']." ".$row['employee_last_name']);
		$pdf->Cell(-5,8,'',0,0,"C");
		$pdf->Cell(60,8,$full_name,1,0,"C");
		$pdf->Cell(15,8,$row2['num_days'],1,0,"C");
		$pdf->Cell(15,8,number_format($employee_rate,2),1,0,"C");
		$pdf->Cell(20,8,number_format($basic_pay,2),1,0,"C");
		if($holiday_counter != 0){
		$pdf->Cell(17,8,number_format($row2['holiday_pay'],2),1,0,"C");
		}
		if($not_counter != 0){
		$pdf->Cell(8,8,$row2['num_ot'],1,0,"C");
		$pdf->Cell(15,8,number_format($tot_ot_pay,2),1,0,"C");
		}
		$pdf->Cell(15,8,number_format($allowance,2),1,0,"C");
		$pdf->Cell(20,8,number_format($tot_allowance,2),1,0,"C");
		$pdf->Cell(15,8,number_format($gross,2),1,0,"C",true);	
		
		$total_basic_pay = $total_basic_pay + $basic_pay;
		$total_holiday_pay = $total_holiday_pay + $row2['holiday_pay'];
		$total_num_ot = $total_num_ot + $row2['num_ot'];
		$total_ot_pay = $total_ot_pay + $tot_ot_pay;
		$total_allowance = $total_allowance + $tot_allowance;
		$total_gross = $total_gross + $gross;



		if($payroll_cutoff == 'First Half'){
			$pdf->Cell(15,8,number_format($pagibig_ee,2),1,0,"C");
			$pdf->Cell(13,8,number_format($philhealth_ee,2),1,0,"C");
			$deduction = 0;
		}else{
			$philhealth_ee = 0;
			$pagibig_ee = 0;

			$sql5 = "SELECT num_days FROM emp_working_hours WHERE emp_id = '$emp_id' AND month = '$payroll_month'";
			$result5 = $conn->query($sql5);
			$sum = "";
			if ($result5->num_rows > 0) {
				// output data of each row
				while($row5 = $result5->fetch_assoc()) {
					$sum += $row5['num_days'];
				}
			}else{
									
			}

			if($contribution_status == "Yes"){


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

			} // if($contribution_status == "Yes"){
			else{
				$deduction = "0.00";
			}


			$sss_compensation = $sum * $employee_rate; 
			$pdf->Cell(15,8,$deduction,1,0,"C");

		}



			$pdf->Cell(10,8,$row2['num_late'],1,0,"C");
			$tardy_rate = ($employee_rate + $allowance) / 8; 
			$tardy_pay = $row2['num_late'] * $tardy_rate;
			$pdf->Cell(15,8,number_format($tardy_pay,2),1,0,"C");


			$net_pay = $gross - $pagibig_ee - $deduction - $philhealth_ee - $tardy_pay;
			$pdf->Cell(20,8,number_format($net_pay,2),1,0,"C",true);
			$pdf->Ln(8);

		$total_pagibig = $total_pagibig + $pagibig_ee;
		$total_sss = $total_sss + $deduction;
		$total_philhealth = $total_philhealth + $philhealth_ee;
		$total_num_late = $total_num_late + $row2['num_late'];
		$total_tardy_pay = $total_tardy_pay + $tardy_pay;
		$total_net_pay = $total_net_pay + $net_pay;
		$total_cash_adv = 0;
		}
	}else{
						
	}

	  		

	}
}else{
					
}

$pdf->SetFont("arial","B",9);
$pdf->Cell(-5,8,'',0,0,"C");
$pdf->Cell(60,8,'',1,0,"C");
$pdf->Cell(15,8,'TOTAL',1,0,"C",TRUE);
$pdf->Cell(15,8,'',1,0,"C",TRUE);
$pdf->Cell(20,8,number_format($total_basic_pay,2),1,0,"C",TRUE);
if($holiday_counter != 0){
$pdf->Cell(17,8,number_format($total_holiday_pay,2),1,0,"C",TRUE);
}
if($not_counter != 0){
$pdf->Cell(8,8,$total_num_ot,1,0,"C",TRUE);
$pdf->Cell(15,8,number_format($total_ot_pay,2),1,0,"C",TRUE);
}
$pdf->Cell(15,8,'',1,0,"C",TRUE);
$pdf->Cell(20,8,number_format($total_allowance,2),1,0,"C",TRUE);
$pdf->Cell(15,8,number_format($total_gross,2),1,0,"C",TRUE);

if($payroll_cutoff == "First Half"){
$pdf->Cell(15,8,number_format($total_pagibig,2),1,0,"C",TRUE);
$pdf->Cell(13,8,number_format($total_philhealth,2),1,0,"C",TRUE);
}else{
$pdf->Cell(15,8,number_format($total_sss,2),1,0,"C",TRUE);
}

$pdf->Cell(10,8,number_format($total_num_late,2),1,0,"C",TRUE);
$pdf->Cell(15,8,number_format($total_tardy_pay,2),1,0,"C",TRUE);
$pdf->Cell(20,8,number_format($total_net_pay,2),1,0,"C",TRUE);
$pdf->Ln(8);

	  		// echo "</tr>";
				$pdf->Output();
	

?>