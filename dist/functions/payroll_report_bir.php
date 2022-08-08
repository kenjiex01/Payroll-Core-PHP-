<?php 
include('../connection.php');
include('../assets/fpdf/fpdf.php');

$payroll_month = $_POST['payroll_month_bir'];
$select_company = $_POST['select_company_bir'];
$start_date = $_POST['start_date_bir'];
$end_date = $_POST['end_date_bir'];

$total_num_days = 0;
$total_basic_pay = 0;
$total_EC = 0;
$total_ER = 0;
$total_deduction = 0;
$total_pagibig_er = 0;
$total_pagibig = 0;
$total_philhealth_er = 0;
$total_philhealth = 0;


$one = 1;


$_SESSION['file_name'] = date("F Y", strtotime($payroll_month)) . " PAYROLL";

$pdf = new FPDF();
// $pdf->AddPage('P',array(215.9,279.4));
	
$pdf= new FPDF('L','mm',array(215.9,330.2));
$pdf->SetTopMargin(10);
$pdf->AddPage();
$pdf->SetFont('arial','B',16);
//$pdf->Image("img/DMMMSU.png",70,8,30,30,'PNG');
//$pdf->Image("img/MLUC.jpg",270,8,30,30,'jpg');
$pdf->Cell(18,8,'',0);
$pdf->Cell(60, 5, "PAYROLL REPORT (". $select_company.")",0,1,"C");
$pdf->Ln(3);

$pdf->SetFont("arial","",10);
$pdf->Cell(50, 5, "PAY PERIOD : " . date("M. d,Y"),0,0,"L");
$pdf->Cell(260, 5, "Date : " . date("M. d,Y"),0,1 ,"R");
$pdf->Cell(50, 5, "Pay Coverage : " . date("M. d,Y", strtotime($start_date)) . " - " . date("M. d,Y", strtotime($end_date)),0,0,"L");
$pdf->Ln(8);
$pdf->SetFont("arial","",8);

//End of Header

$pdf->SetFont("arial","B",15);
$pdf->Cell(65,16,'FULL NAME',1,0,"C");
$pdf->Cell(32,16,'# OF DAYS',1,0,"C");
$pdf->Cell(32,16,'BASIC PAY',1,0,"C");
$pdf->Cell(60,8,'SSS',1,0,"C");
$pdf->Cell(60,8,'PAG-IBIG',1,0,"C");
$pdf->Cell(60,8,'PHILHEALTH',1,0,"C");

$pdf->Ln(8);
$pdf->Cell(65,16,'',0,0,"C");
$pdf->Cell(32,16,'',0,0,"C");
$pdf->Cell(32,16,'',0,0,"C");
$pdf->Cell(20,8,'EC',1,0,"C");
$pdf->Cell(20,8,'ER',1,0,"C");
$pdf->Cell(20,8,'EE',1,0,"C");
$pdf->Cell(30,8,'ER',1,0,"C");
$pdf->Cell(30,8,'EE',1,0,"C");
$pdf->Cell(30,8,'ER',1,0,"C");
$pdf->Cell(30,8,'EE',1,0,"C");
$pdf->Ln(8);




$sql = "SELECT * FROM employee_tbl WHERE company = '$select_company' AND status = 'Active' AND contribution_status = 'Yes' ORDER BY employee_last_name";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
  // output data of each row
$pdf->SetFont("arial","",10);
  	while($row = $result->fetch_assoc()) {
  	$full_name = utf8_decode($row['employee_first_name']." ".$row['employee_middle_name']." ".$row['employee_last_name']);

  	$employee_id = $row['employee_id'];
  	$sql1 = "SELECT * FROM employee_details WHERE employee_id = '$employee_id'";
	$result1 = $conn->query($sql1);
	if ($result1->num_rows > 0) {
	// output data of each row
		while($row1 = $result1->fetch_assoc()) {
		$employee_rate = $row1['employee_rate'];

	}
	}else{		
	}

	$sql2 = "SELECT SUM(num_days),SUM(basic_pay) FROM emp_working_hours WHERE emp_id = '$employee_id' AND month = '$payroll_month'";
	$result2 = $conn->query($sql2);
	if ($result2->num_rows > 0) {
	// output data of each row
		while($row2 = $result2->fetch_assoc()) {
		$num_days = $row2['SUM(num_days)'];
		$basic_pay = $row2['SUM(basic_pay)'];
	}
	}else{		
	}

$sql3 = "SELECT MAX(range_compensation_2),MAX(deduction) FROM sss_contribution_tbl";
$result3 = $conn->query($sql3);
if ($result3->num_rows > 0) {
	// output data of each row
  	while($row3 = $result3->fetch_assoc()) {
  		$max_range = $row3['MAX(range_compensation_2)'];
  		$max_deduction = $row3['MAX(deduction)'];
	}
}else{
							
}


$sss_compensation = $num_days * $employee_rate;
if($sss_compensation >= $max_range){
$deduction = $max_deduction;
}else{
	$sql4 = "SELECT * FROM sss_contribution_tbl";
	$result4 = $conn->query($sql4);

		if ($result4->num_rows > 0) {
		  // output data of each row
		  while($row4 = $result4->fetch_assoc()) {
		  		if ($row4['range_compensation_1'] <= $sss_compensation AND $sss_compensation <= $row4['range_compensation_2']){
		  			$deduction = $row4['deduction'];
		  			$ER = $row4['employer_deduction'];
		  			$EC = $row4['employee_compensation'];
		  		}else{

		  		}
		  	}
		}else{
			$deduction = 0;
			$ER = 0;
			$EC = 0;					
		}
}

$sql5 = "SELECT * FROM employee_monthly_contributions WHERE employee_id='$employee_id' AND cutoff='First Half' AND month='$payroll_month'";
$result5 = $conn->query($sql5);

if ($result5->num_rows > 0) {
	// output data of each row
	while($row5 = $result5->fetch_assoc()) {
	  	$pagibig = $row5['pagibig_ee'];
	  	$pagibig_er = $row5['pagibig_er'];
	  	$philhealth = $row5['phil_ee'];
	  	$philhealth_er = $row5['phil_er'];
	}
}else{
		$pagibig = 0;
	  	$pagibig_er = 0;
	  	$philhealth = 0;
	  	$philhealth_er = 0;						
}

// $sql6 = "SELECT * FROM employee_monthly_contributions WHERE employee_id='$employee_id' AND cutoff='Second Half' AND month='$payroll_month'";
// $result6 = $conn->query($sql6);
// if ($result6->num_rows > 0) {
// 	// output data of each row
// 	while($row6 = $result6->fetch_assoc()) {
// 	}
// }else{
	  			
// }


	$total_num_days = $total_num_days + $num_days;
	$total_basic_pay = $total_basic_pay + $basic_pay;
	$total_EC = $total_EC + $EC;
	$total_ER = $total_ER + $ER;
	$total_deduction = $total_deduction + $deduction;
	$total_pagibig_er = $total_pagibig_er + $pagibig_er;
	$total_pagibig = $total_pagibig + $pagibig;
	$total_philhealth_er = $total_philhealth_er + $philhealth_er;
	$total_philhealth = $total_philhealth + $philhealth;

	$remainder = $one % 2;

	//If the remainder is 0, then it means
	//that the number is even.
	if($remainder == 0){
	    $check = TRUE;
	}else{
		$check = FALSE;
	}



	$pdf->SetFillColor(190,190,190);
	$pdf->Cell(65,8,$full_name,1,0,"C",$check);
	$pdf->Cell(32,8,number_format($num_days,2),1,0,"C",$check); // number of days
	$pdf->Cell(32,8,number_format($basic_pay,2),1,0,"C",$check); // basic pay
	$pdf->Cell(20,8,$EC,1,0,"C",$check); // sss ER
	$pdf->Cell(20,8,$ER,1,0,"C",$check); // sss ER
	$pdf->Cell(20,8,$deduction,1,0,"C",$check);	// sss EE
	$pdf->Cell(30,8,number_format($pagibig_er,2),1,0,"C",$check); // pagibig ER
	$pdf->Cell(30,8,number_format($pagibig,2),1,0,"C",$check); // pagibig EE
	$pdf->Cell(30,8,number_format($philhealth_er,2),1,0,"C",$check); // philhealth ER
	$pdf->Cell(30,8,number_format($philhealth,2),1,0,"C",$check); // philhealth EE
	$pdf->Ln(8);





	$one++;
	}
}else{
	$employee_rate = "0";
	$allowance = "0";			
}

$pdf->SetFillColor(255,248,28);
$pdf->SetFont("arial","B",12);
$pdf->Cell(65,8,'Total:',1,0,"C",TRUE);
$pdf->Cell(32,8,number_format($total_num_days,2),1,0,"C",TRUE); // num days
$pdf->Cell(32,8,number_format($total_basic_pay,2),1,0,"C",TRUE); // basic pay 
$pdf->Cell(20,8,number_format($total_EC,2),1,0,"C",TRUE); // SSS ER
$pdf->Cell(20,8,number_format($total_ER,2),1,0,"C",TRUE); // SSS ER
$pdf->Cell(20,8,number_format($total_deduction,2),1,0,"C",TRUE); // SSS EE
$pdf->Cell(30,8,number_format($total_pagibig_er,2),1,0,"C",TRUE); // pagibig ER
$pdf->Cell(30,8,number_format($total_pagibig,2),1,0,"C",TRUE); // pagibig EE
$pdf->Cell(30,8,number_format($total_philhealth_er,2),1,0,"C",TRUE); // philhealth ER
$pdf->Cell(30,8,number_format($total_philhealth,2),1,0,"C",TRUE); // philhealth EE



// echo "</tr>";
$pdf->Output();
	

?>