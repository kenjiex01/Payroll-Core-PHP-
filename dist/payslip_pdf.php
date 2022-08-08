<?php 
include('connection.php');
include('assets/fpdf/fpdf.php');

$company = $_POST['company_select'];
$start_date = date("m/d/Y", strtotime($_POST['start_date_payslip']));
$end_date = date("m/d/Y", strtotime($_POST['end_date_payslip']));
$cut_off = $_POST['payroll_cutoff_payslip'];
$payroll_month = $_POST['payroll_month_payslip'];

$_SESSION['file_name'] = "Payslip( ".$cut_off." ".$payroll_month." )";

$current_date = date("m/d/Y");


//Start of Header
$pdf = new FPDF();
// $pdf->AddPage('P',array(215.9,279.4));
	
$pdf= new FPDF('P','mm',array(215.9,330.2));
$pdf->SetTopMargin(10);
$pdf->AddPage();
$pdf->SetFont('arial','B',16);



$a = 1;
while($a <= 2){




$sql = "SELECT * FROM employee_tbl WHERE company = '$company' AND status = 'Active'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
	// output data of each row
	while($row = $result->fetch_assoc()) {

//------------------------------------employee_table_while----------------------------------------------------
	$contribution_status = $row['contribution_status'];
	$employee_id = $row['employee_id'];

//------------------------------------employee_details----------------------------------------------------
$sql1 = "SELECT * FROM employee_details WHERE employee_id = '$employee_id'";
$result1 = $conn->query($sql1);

if ($result1->num_rows > 0) {
	// output data of each row
	while($row1 = $result1->fetch_assoc()) {
		$rate = $row1['employee_rate'];
		$allowance = $row1['allowance'];
	}
}
else{
}
//------------------------------------employee_details----------------------------------------------------



//------------------------------------Government Deductions----------------------------------------------------
$tot_num_days  = 0;
$sql3 = "SELECT num_days FROM emp_working_hours WHERE emp_id = '$employee_id' AND month ='$payroll_month'";
$result3 = $conn->query($sql3);

if ($result3->num_rows > 0) {
	// output data of each row
	while($row3 = $result3->fetch_assoc()) {
		$tot_num_days += $row3['num_days'];
	}
}
else{
}


$sql4 = "SELECT MAX(range_compensation_2),MAX(deduction) FROM sss_contribution_tbl";
$result4 = $conn->query($sql4);
if ($result4->num_rows > 0) {
	// output data of each row
  	while($row4 = $result4->fetch_assoc()) {
  		$max_range = $row4['MAX(range_compensation_2)'];
  		$max_deduction = $row4['MAX(deduction)'];
	}
}else{
							
}


$sss_compensation = $tot_num_days * $rate;
if($sss_compensation >= $max_range){
$deduction = $max_deduction;
}else{
	$sql5 = "SELECT * FROM sss_contribution_tbl";
	$result5 = $conn->query($sql5);

		if ($result5->num_rows > 0) {
		  // output data of each row
		  while($row5 = $result5->fetch_assoc()) {
		  		if ($row5['range_compensation_1'] <= $sss_compensation AND $sss_compensation <= $row5['range_compensation_2']){
		  			$deduction = $row5['deduction'];
		  		}else{

		  		}
		  	}
		}else{
								
		}
}

$sql6 = "SELECT * FROM deduction_tbl";
$result6 = $conn->query($sql6);

if ($result6->num_rows > 0) {
	// output data of each row
	while($row6 = $result6->fetch_assoc()) {
	  	$pagibig = $row6['PAGIBIG_deduction'];
	  	$philhealth = $row6['philhealth_deduction'];
	}
}else{
						
}


if($contribution_status == "Yes"){

if($cut_off == "First Half"){
	$pagibig = $pagibig;
	$philhealth = $philhealth;
	$sss = 0;
}else{
	$pagibig = 0;
	$philhealth = 0;
	$sss = $deduction;
}
}else{
	$pagibig = 0;
	$philhealth = 0;
	$sss = 0;
}

//------------------------------------Government Deductions----------------------------------------------------



//------------------------------------Cash Advance-------------------------------------------------------------
// $total_cash_adv = 0;
// $sql7 = "SELECT amount FROM cash_advance_tbl WHERE employee_id = '$employee_id' AND cut_off = '$cut_off' AND month_add = '$payroll_month' ";
// $result7 = $conn->query($sql7);

// if ($result7->num_rows > 0) {
// // output data of each row
// 	while($row7 = $result7->fetch_assoc()) {
// 		$total_cash_adv += $row7['amount'];
// 	}
// }else{
// 	$total_cash_adv = 0;
// }
//------------------------------------Cash Advance-------------------------------------------------------------


//------------------------------------Company-------------------------------------------------------------
$sql8 = "SELECT * FROM company WHERE company_name = '$company'";
$result8 = $conn->query($sql8);

	if ($result8->num_rows > 0) {
	  // output data of each row
	  while($row8 = $result8->fetch_assoc()) {
	  	$company_namess = $row8['payslip_company_title'];
	  	}
	}else{
		
	}
//------------------------------------Company-------------------------------------------------------------


//------------------------------------employee_time----------------------------------------------------
$sql2 = "SELECT * FROM emp_working_hours WHERE emp_id = '$employee_id' AND month = '$payroll_month' AND cutoff = '$cut_off'";
$result2 = $conn->query($sql2);

if ($result2->num_rows > 0) {
	// output data of each row
	while($row2 = $result2->fetch_assoc()) {
//------------------------------------employee_time_while----------------------------------------------------
	$num_days = $row2['num_days'];	
	$basic_pay = $num_days * $rate;
	$num_late = $row2['num_late'];
	$holiday_pay = $row2['holiday_pay'];
	$num_ot = $row2['num_ot'];
	$ot_pay = ($rate / 8)*1.25;
	$total_ot = $num_ot * $ot_pay;
	$tardy_rate = ($rate + $allowance) / 8; 
	$tardy_pay = $num_late * $tardy_rate;
	$total_allowance = $allowance * $num_days;

	$gross = $basic_pay + $holiday_pay + $total_ot + $total_allowance;
	$total_deductions = $sss + $pagibig + $philhealth + $tardy_pay;
	$net_pay = $gross - $total_deductions;

$finger_id = $row['finger_id'];	
$full_name = $row['employee_first_name']. " " . $row['employee_middle_name'] . " " . $row['employee_last_name'];

$pdf->SetFont('arial','B',12);
$pdf->Cell(130,7,$company_namess,0,0,"R");
$pdf->SetFont('arial','',10);
$pdf->Ln(6);
$pdf->Cell(23,7,'Employee # :',0,0,"R");
$pdf->Cell(40,7,$finger_id,0); // ----------------------------- Finger ID
$pdf->Cell(30,7,'Rate :',0);
$pdf->Cell(30,7,number_format($rate,2),0);
$pdf->Cell(30,7,'Pay Date : ',0,0,"R");
$pdf->Cell(30,7,$current_date,0);
$pdf->Ln(6);
$pdf->Cell(24,7,'Name : ',0,0,"R");
$pdf->Cell(50,7,utf8_decode($full_name),"B"); //--------------------------Full Name
$pdf->Cell(50,7,'',"0");
$pdf->Cell(29,7,'Pay Coverage : ',0,0,"R");
$pdf->Cell(29,7,$start_date.' - '.$end_date,0);
$pdf->Ln(7);
$pdf->Cell(45,7,'Days : ',0,0,"R");
$pdf->Cell(60,7,$num_days,0,0,"R");  //------------------Number of Days

$pdf->Cell(48,7,'Pay Period : ',0,0,"R");
$pdf->Cell(16,7,$current_date,0,0,"R");
$pdf->Ln(6);
$pdf->Cell(45,7,'Basic Pay : ',0,0,"R");
$pdf->Cell(60,7,number_format($basic_pay,2),0,0,"R");
$pdf->SetFont('arial','',10);
$pdf->Cell(20,7,'LESS : ',0,0,"R");
$pdf->SetFont('arial','',10);
$pdf->Cell(30,7,'SSS : ',0,0,"R");
// $pdf->Cell(20,7,$sss_compensation,0,0,"R");
$pdf->Cell(20,7,$sss,0,0,"R");
$pdf->Ln(6);
$pdf->Cell(45,7,'Legal Holiday : ',0,0,"R");
$pdf->Cell(60,7,number_format($holiday_pay,2),0,0,"R");
$pdf->Cell(50,7,'Philhealth : ',0,0,"R");
$pdf->Cell(20,7,number_format($philhealth,2),0,0,"R");
$pdf->Ln(6);
$pdf->Cell(45,7,'Overtime Pay : ',0,0,"R");
$pdf->Cell(60,7,number_format($total_ot,2),0,0,"R");
$pdf->Cell(50,7,'PAGIBIG : ',0,0,"R");
$pdf->Cell(20,7,number_format($pagibig,2),0,0,"R");
$pdf->Ln(7);
$pdf->Cell(45,7,'ADD : ',0,0,"R");
$pdf->Cell(30,7,'Adj/Bonus:',0,0,"R");
$pdf->Cell(30,7,number_format($total_allowance,2),0,0,"R");
$pdf->SetFont('arial','B',10);
$pdf->Cell(35,7,'Other Deduction ',0,0,"R");
$pdf->SetFont('arial','',10);
$pdf->Cell(15,7,'Late : ',0,0,"R");
$pdf->Cell(20,7,number_format($tardy_pay,2),0,0,"R");
$pdf->Ln(6);
$pdf->SetFont('arial','B',10);
$pdf->Cell(45,6,'',0,0,"R");
$pdf->Cell(30,6,'GROSS Pay : ',"TLB",0,"R");
$pdf->Cell(30,6,number_format($gross,2),"TRB",0,"R");
$pdf->SetFont('arial','',10);
$pdf->Cell(50,7,'',0,0,"R");
$pdf->Cell(20,7,'',0,0,"R");
// $pdf->Cell(50,7,'Cash Advance : ',0,0,"R");
// $pdf->Cell(20,7,number_format($total_cash_adv,2),0,0,"R");
$pdf->Ln(7);
$pdf->SetFont('arial','B',10);
$pdf->Cell(105,7,'',0,0,"R");
$pdf->Cell(50,7,'Total Deduction : ',"TLB",0,"R");
$pdf->Cell(30,7,number_format($total_deductions,2),"TRB",0,"C");
$pdf->Ln(7);
$pdf->SetFillColor(255,248,28);
$pdf->Cell(20,6,'Received By : ',0,0,"C");
$pdf->Cell(85,6,utf8_decode($full_name),"B",0,"C");
$pdf->Cell(40,6,'NET PAY : ',"TLB",0,"R",true);
$pdf->Cell(40,6,number_format($net_pay,2),"TRB",0,"C",true);

$pdf->Ln(8);
$pdf->Cell(200,6,'',"T",0,"C");
$pdf->Ln(2);

//------------------------------------employee_time_while----------------------------------------------------
	}
}
else{
}
//------------------------------------employee_time----------------------------------------------------


//------------------------------------employee_table_while----------------------------------------------------
	}
}
else{

}
$a++;
//----------------------------------------------End---------------------------------------------------
}//end of while

$pdf->Output();
?>