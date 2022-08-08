<?php 
include('../connection.php');
include('../assets/fpdf/fpdf.php');

$select_company = $_POST['select_company_xmas'];
$start_date = $_POST['start_date_xmas'];
$end_date = $_POST['end_date_xmas'];


$one = 1;


$_SESSION['file_name'] = "( ".date("Y" ). " ) 13TH MONTH REPORT  ";

$pdf = new FPDF();
// $pdf->AddPage('P',array(215.9,279.4));
	
$pdf= new FPDF('L','mm',array(215.9,330.2));
$pdf->SetTopMargin(10);
$pdf->AddPage();
$pdf->SetFillColor(255,248,28);
$pdf->SetFont('arial','B',16);
//$pdf->Image("img/DMMMSU.png",70,8,30,30,'PNG');
//$pdf->Image("img/MLUC.jpg",270,8,30,30,'jpg');
$pdf->Cell(60, 5, "13Th MONTH REPORT (". $select_company.")",0,1,"L");
$pdf->Ln(3);
$pdf->SetFont('arial','',12);
$pdf->Cell(60, 5, "Pay Period : ",0,1,"L");
$pdf->Ln(3);
$pdf->SetFont("arial","B",12);
$pdf->Cell(-5,8,"",0,0,"C");
$pdf->Cell(55,8,'Name',1,0,"C"); //Full name

$pdf->SetFont("arial","B",9);

$ts1 = strtotime($start_date);
$ts2 = strtotime($end_date);

$year1 = date('Y', $ts1);
$year2 = date('Y', $ts2);

$month1 = date('m', $ts1);
$month2 = date('m', $ts2);

$diff = (($year2 - $year1) * 12) + ($month2 - $month1);
$date_head = $start_date;
// echo $diff;
$a = 0;
while($a <= $diff){
$pdf->Cell(18,8,date("F",strtotime($date_head)),1,0,"C");
$date_head = strtotime($date_head);
$date_head = date("Y-m", strtotime("+1 month", $date_head));
$a++;
}
$pdf->SetFillColor(255,248,28);
$pdf->Cell(23,8,"Total",1,0,"C");
$pdf->Cell(25,8,"13th Month",1,0,"C",true);
$pdf->Ln(8);



$sql = "SELECT * FROM employee_tbl WHERE company = '$select_company' ORDER BY employee_last_name";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
// output data of each row
while($row = $result->fetch_assoc()) {
		$emp_id = $row['employee_id'];


		$remainder = $one % 2;
		if($remainder == 0){
		    $check = TRUE;
		}else{
			$check = FALSE;
		}
		$pdf->SetFillColor(190,190,190);


  		$full_name = utf8_decode($row['employee_first_name']) . " " . utf8_decode($row['employee_middle_name']) . " " . utf8_decode($row['employee_last_name']);
		$total = 0;
		$date_check = $start_date;
		$pdf->Cell(-5,8,"",0,0,"C");
		$pdf->Cell(55,8,$full_name,1,0,"C",$check); // Full name
		$a=0;
		$basic_pay = "";
		while($a <= $diff){
		$date_check = date("Y-m",strtotime($date_check));

		$sql1 = "SELECT * FROM emp_working_hours WHERE emp_id = '$emp_id' AND month = '$date_check'";
		$result1 = $conn->query($sql1);
		if ($result1->num_rows > 0) {
		// output data of each row
			while($row1 = $result1->fetch_assoc()) {
				$basic_pay = $basic_pay + $row1['basic_pay'];
			}
		}else{
			$basic_pay = "0";
		}
				// $pdf->Cell(20,8,$date_check,1,0,"C");
				$pdf->Cell(18,8,number_format($basic_pay,2),1,0,"C",$check); // Basic Pay
				$total = $total + $basic_pay;
				$basic_pay = "";

		$date_check= strtotime($date_check);
		$date_check = date("Y-m", strtotime("+1 month", $date_check)); 
		$a++;
		}
		$xmas_bonus = $total / 12;
		$pdf->Cell(23,8,number_format($total,2),1,0,"C",$check); // Christmas Bonus
		$pdf->SetFillColor(255,248,28);
		$pdf->Cell(25,8,number_format($xmas_bonus,2),1,0,"C", true); // Christmas Bonus
		
		$one++;
	$pdf->Ln(8);
  	}
}

// echo "</tr>";
$pdf->Output();
	

?>