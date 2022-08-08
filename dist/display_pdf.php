<?php
session_start();
include('connection.php');
include('assets/fpdf/fpdf.php');



$c_date = date('d-m-Y');
$current_date = date('d-m-Y', strtotime('-1 day', strtotime($c_date)));//less 1 day
$tom_date = date('d-m-Y', strtotime('+1 day', strtotime($c_date)));
// $current_date = date('d-m-Y');// current date 
$_SESSION['file_name'] = date("M-d-Y"). " (Daily Reports)";

//Start of Header
$pdf = new FPDF();
$pdf->AddPage('L','Legal');
$pdf->SetFont('arial','B',16);
//$pdf->Image("img/DMMMSU.png",70,8,30,30,'PNG');
//$pdf->Image("img/MLUC.jpg",270,8,30,30,'jpg');
$pdf->Cell(18,8,'',0);
$pdf->Cell(0, 5, "PAYROLL REPORT",0,1,"C");

$pdf->Ln(3);
$pdf->SetFont("arial","",8);
$pdf->Ln(1);
//End of Header


$pdf->SetFont('arial','B',8,'C');
//$pdf->Cell(40,40,'',0,"C");
$pdf->Cell(60,8,'Employee Name',1,0,"C");
$pdf->Cell(15,8,'# of Days',1,0,"C");
$pdf->Cell(15,8,'Rate/Day',1,0,"C");
$pdf->Cell(25,8,'Basic Pay',1,0,"C");
$pdf->Cell(17,8,'Holiday Pay',1,0,"C");
$pdf->Cell(15,8,'# of OT',1,0,"C");
$pdf->Cell(15,8,'OT Pay',1,0,"C");
$pdf->Cell(15,8,'Allowance',1,0,"C");
$pdf->Cell(23,8,'Total Allowance',1,0,"C");
$pdf->Cell(20,8,'GROSS',1,0,"C");
$pdf->Cell(15,8,'PAGIBIG',1,0,"C");
$pdf->Cell(15,8,'SSS',1,0,"C");
$pdf->Cell(15,8,'PhilHealth',1,0,"C");
$pdf->Cell(15,8,'# of Late',1,0,"C");
$pdf->Cell(15,8,'Tardy Pay',1,0,"C");
$pdf->Cell(15,8,'CA',1,0,"C");
$pdf->Cell(25,8,'NET Pay',1,0,"C");
$pdf->Ln(8);



$pdf->SetFont('arial','B',8,'C');
//$pdf->Cell(40,40,'',0,"C");
$sql = "SELECT * FROM employee_tbl";
$result = $conn->query($sql);

	if ($result->num_rows > 0) {
	  // output data of each row
	  while($row = $result->fetch_assoc()) {
$pdf->Cell(60,8,$row['employee_first_name']. " " . $row['employee_middle_name']. " " .$row['employee_last_name'],1,0,"C");

$sql1 = "SELECT * FROM emp_working_hours WHERE emp_id = '$row[employee_id]'";
$result1 = $conn->query($sql1);

	if ($result1->num_rows > 0) {
	  // output data of each row
	  while($row1 = $result1->fetch_assoc()) {

	  	$sql2 = "SELECT * FROM employee_details WHERE employee_id = '$row[employee_id]'";
		$result2 = $conn->query($sql2);

			if ($result1->num_rows > 0) {
			  // output data of each row
			  while($row2 = $result2->fetch_assoc()) {
			  	$allowance = $row2['allowance'];
			  	$rate = $row2['employee_rate'];
			  }
			}else{
			  	$allowance = 0;
			  	$rate = 0;
			}




			//_____________________Cash Advance_______________
			$sql3 = "SELECT * FROM cash_advance_tbl WHERE employee_id = '$row[employee_id]'";
			$result3 = $conn->query($sql3);

				if ($result3->num_rows > 0) {
				  // output data of each row
				  while($row3 = $result3->fetch_assoc()) {
				  	$cash_adv = $row3['amount'];
				  }
				}else{
				  	$allowance = 0;
				  	$cash_adv = 0;
				}








		$basic_pay = $rate * $row1['num_days'];
		$ot_pay = ($rate / 8) * 1.25;
		$tot_allowance = $allowance * $row1['num_days'];

		$gross = $basic_pay + $row1['holiday_pay'] + $tot_allowance + ($row1['num_ot'] * number_format($ot_pay,2));
		
		$tardy_pay = ($rate + $allowance)/8; 

		$pdf->Cell(15,8,$row1['num_days'],1,0,"C");
		$pdf->Cell(15,8,$rate,1,0,"C");
		$pdf->Cell(25,8,number_format($basic_pay,2),1,0,"C");
		$pdf->Cell(17,8,$row1['holiday_pay'],1,0,"C");
		$pdf->Cell(15,8,$row1['num_ot'],1,0,"C");
		$pdf->Cell(15,8,number_format($ot_pay,2),1,0,"C");
		$pdf->Cell(15,8,$allowance,1,0,"C");
		$pdf->Cell(23,8,number_format($tot_allowance,2),1,0,"C");
		$pdf->Cell(20,8,number_format($gross,2),1,0,"C");
		$pdf->Cell(15,8,'PAGIBIG',1,0,"C");
		$pdf->Cell(15,8,'SSS',1,0,"C");
		$pdf->Cell(15,8,'PhilHealth',1,0,"C");
		$pdf->Cell(15,8,$row1['num_late'],1,0,"C");
		$pdf->Cell(15,8,number_format($tardy_pay,2),1,0,"C");
		$pdf->Cell(15,8,number_format($cash_adv,2),1,0,"C");
		$pdf->Cell(25,8,'NET Pay',1,0,"C");
		$pdf->Ln(8);
		}
	}
	else{
		$pdf->Cell(15,8,'0',1,0,"C");
		$pdf->Cell(15,8,'0',1,0,"C");
		$pdf->Cell(25,8,'0',1,0,"C");
		$pdf->Cell(17,8,'0',1,0,"C");
		$pdf->Cell(15,8,'0',1,0,"C");
		$pdf->Cell(15,8,'0',1,0,"C");
		$pdf->Cell(15,8,'0',1,0,"C");
		$pdf->Cell(23,8,'0',1,0,"C");
		$pdf->Cell(20,8,'0',1,0,"C");
		$pdf->Cell(15,8,'0',1,0,"C");
		$pdf->Cell(15,8,'0',1,0,"C");
		$pdf->Cell(15,8,'0',1,0,"C");
		$pdf->Cell(15,8,'0',1,0,"C");
		$pdf->Cell(15,8,'0',1,0,"C");
		$pdf->Cell(15,8,'0',1,0,"C");
		$pdf->Cell(25,8,'0',1,0,"C");
		$pdf->Ln(8);
	}

}
}


$pdf->Output();

?>