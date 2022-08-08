<?php
session_start();
include('connection.php');
include('assets/fpdf/fpdf.php');

$start_date = date('Y-m-d', strtotime($_POST['start_date']));
$end_date = date('Y-m-d', strtotime($_POST['end_date']));
$company = $_POST['select_company'];
$c_date = date('d-m-Y');
$current_date = date('d-m-Y', strtotime('-1 day', strtotime($c_date)));//less 1 day
$tom_date = date('d-m-Y', strtotime('+1 day', strtotime($c_date)));
// $current_date = date('d-m-Y');// current date 
$_SESSION['file_name'] = date("M-d-Y"). " (Daily Reports)";

//Start of Header
// $pdf = new FPDF();
// $pdf->AddPage('L','Legal');
$pdf= new FPDF('L','mm',array(215.9,279.4));
$pdf->AddPage();
$pdf->SetFont('arial','B',16);
//$pdf->Image("img/DMMMSU.png",70,8,30,30,'PNG');
//$pdf->Image("img/MLUC.jpg",270,8,30,30,'jpg');
// $pdf->Cell(18,8,'',0);
// $pdf->Cell(0, 5, "PAYROLL REPORT",0,1,"C");


$sql3 = "SELECT * FROM company WHERE company_name = '$company'";
	$result3 = $conn->query($sql3);
	if ($result3->num_rows > 0) {
	  // output data of each row
	  	while($row3 = $result3->fetch_assoc()) {
	 	$company_name = $row3['payslip_company_title'];
	 	$company_id = $row3['id'];

			 	$sql4 = "SELECT * FROM company_details WHERE company_id = '$company_id'";
				$result4 = $conn->query($sql4);
				if ($result4->num_rows > 0) {
				  // output data of each row
				  	while($row4 = $result4->fetch_assoc()) {
				  		$company_address = $row4['company_address'];
				  	}
				 }
	  	}
	 }

$pdf->SetFont("arial","B",15);
$pdf->Cell(260,8,$company_name,0,0,"C");
$pdf->Ln(5);
$pdf->SetFont("arial","",9);
$pdf->Cell(260,8,$company_address,0,0,"C");
$pdf->Ln(5);
$pdf->SetFont("arial","B",15);
$pdf->Cell(260,8,"TIMESHEET REPORT",0,0,"C");
$pdf->Ln(5);
$pdf->SetFont("arial","B",11);
$pdf->Cell(260,8,"From " .$start_date. " to " . $end_date,0,0,"C");
$pdf->Ln(10);



// $pdf->Ln(3);
$pdf->SetFont("arial","",8);
// $pdf->Ln(1);
//End of Header
$sql = "SELECT * FROM employee_tbl WHERE company = '$company' AND status = 'Active' ORDER BY employee_last_name";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
	  // output data of each row
	  	while($row = $result->fetch_assoc()) {
	  
$finger_id = $row['finger_id'];
$employee_id = $row['employee_id'];
$full_name = utf8_decode($row['employee_first_name']. " " . $row['employee_middle_name'] . " " . $row['employee_last_name']);


	$pdf->Cell(60,8,$full_name . " (".$finger_id.")",0,0,"L");
	$pdf->Ln(8);
	$pdf->SetFont('arial','B',9,'C');
	//$pdf->Cell(40,40,'',0,"C");
	$pdf->Cell(20,8,'Date',1,0,"C");
	$pdf->Cell(15,8,'In1',1,0,"C");
	$pdf->Cell(15,8,'Out1',1,0,"C");
	$pdf->Cell(15,8,'In2',1,0,"C");
	$pdf->Cell(15,8,'Out2',1,0,"C");
	$pdf->Cell(15,8,'In3',1,0,"C");
	$pdf->Cell(15,8,'Out3',1,0,"C");
	$pdf->Cell(15,8,'In4',1,0,"C");
	$pdf->Cell(15,8,'Out4',1,0,"C");
	$pdf->Cell(15,8,'In5',1,0,"C");
	$pdf->Cell(15,8,'Out5',1,0,"C");
	$pdf->Cell(15,8,'In6',1,0,"C");
	$pdf->Cell(15,8,'Out6',1,0,"C");
	$pdf->Cell(25,8,'Hrs Required',1,0,"C");
	$pdf->Cell(20,8,'Tot Hrs',1,0,"C");
	$pdf->Ln(8);
	$pdf->SetFillColor(255,248,28);
	

$sql1 = "SELECT * FROM employee_time WHERE finger_id = '$finger_id' GROUP BY date_in_out  ORDER BY ID ASC";
$result1 = $conn->query($sql1);
if ($result1->num_rows > 0) {
  // output data of each row
  	while($row1 = $result1->fetch_assoc()) {
		$a = 0;
		$cc = 0;
		$date_in = $row1['date_in_out'];
$condition_date = date('Y-m-d', strtotime($date_in));
if (($condition_date >= $start_date) && ($condition_date <= $end_date)){
		$sql2 = "SELECT * FROM employee_time WHERE finger_id = '$finger_id' AND date_in_out='$date_in' ORDER BY time_in_out";
		$result2 = $conn->query($sql2);
		if ($result2->num_rows > 0) {

//echo $paymentDate; // echos today! 


		$pdf->Cell(20,8,$date_in,1,0,"C");	
		 $aa = 1;
		  // output data of each row
		 $eight = "08:04:00";
		 $start = strtotime("00:00:00");
		 $end = strtotime("00:00:00");
		  	while($row2 = $result2->fetch_assoc()) {

		  		$end = strtotime($row2['time_in_out']);




		  		$diff = abs($start - $end); 
  
  
				// To get the year divide the resultant date into
				// total seconds in a year (365*60*60*24)
				$years = floor($diff / (365*60*60*24)); 
				  
				  
				// To get the month, subtract it with years and
				// divide the resultant date into
				// total seconds in a month (30*60*60*24)
				$months = floor(($diff - $years * 365*60*60*24)
				                               / (30*60*60*24)); 
				  
				  
				// To get the day, subtract it with years and 
				// months and divide the resultant date into
				// total seconds in a days (60*60*24)
				$days = floor(($diff - $years * 365*60*60*24 - 
				             $months*30*60*60*24)/ (60*60*24));
				  
				  
				// To get the hour, subtract it with years, 
				// months & seconds and divide the resultant
				// date into total seconds in a hours (60*60)
				$hours = floor(($diff - $years * 365*60*60*24 
				       - $months*30*60*60*24 - $days*60*60*24)
				                                   / (60*60)); 
				  
				  
				// To get the minutes, subtract it with years,
				// months, seconds and hours and divide the 
				// resultant date into total seconds i.e. 60
				$minutes = floor(($diff - $years * 365*60*60*24 
				         - $months*30*60*60*24 - $days*60*60*24 
				                          - $hours*60*60)/ 60); 
				  
				  
				// To get the minutes, subtract it with years,
				// months, seconds, hours and minutes 
				$seconds = floor(($diff - $years * 365*60*60*24 
				         - $months*30*60*60*24 - $days*60*60*24
				                - $hours*60*60 - $minutes*60)); 





				$pdf->SetFont('arial','B',8,'C');
		  		$time_in_out = date('h:i A', strtotime($row2['time_in_out']));
		  		if($aa == 1 AND strtotime($row2['time_in_out']) > strtotime($eight)){
		  		$pdf->SetTextColor(255,0,0);
				// echo "<td style='width: 60px;color:red;'>".$row2['time_in_out']." ----- $aa</td>";
				$pdf->Cell(15,8,$time_in_out,1,0,"C");
		  		$pdf->SetTextColor(0,0,0);
						$cc++;
		  		}else{


		  			if($hours == 0 AND $minutes <= 2){
						

		  			}else{

				  		if($row2['forgotten'] == 1){
				  		$pdf->SetTextColor(255,0,0);
						$pdf->Cell(15,8,$time_in_out,1,0,"C");
		  				$pdf->SetTextColor(0,0,0);
						$cc++;
						// echo "<td style='width: 60px; color:red;'>".$row2['time_in_out']. " ---- $aa</td>";
				  		}else{
				  		$pdf->SetTextColor(0,0,0);
						$pdf->Cell(15,8,$time_in_out,1,0,"C");
						$cc++;
						// echo "<td style='width: 60px; color:black;'>".$row2['time_in_out']. " ---- $aa</td>";
				  		}
		  			}
		  		

		  		}
		  		$aa++;
				$last = $row2['time_in_out'];

		  		$start = $end;
			}
		}
		$b = 12 - $cc;
		$num_time_in = $result2->num_rows;
				$pdf->SetFont('arial','B',9,'C');
		while ($b>$a){
			if($b>8){
				$pdf->SetFillColor(0,222,255);
				$pdf->Cell(15,8,"",1,0,"C",true);
			// echo"<td style='width: 60px;background-color:#1ecbe1;'></td>";
			}
			else{
				  		$pdf->SetTextColor(0,0,0);
				$pdf->Cell(15,8,"",1,0,"C");
			// echo"<td style='width: 60px;background-color:none;'></td>";	
			}
		$b--;
		}

		if(strtotime($last) < strtotime("17:00:00") AND $num_time_in == 2){
			$half = "Yes";
		}
		else{
			$half = "No";
		}
		// echo "<td style='width: 120px;'>$last</td>
	// 	<td>$num_time_in</td>
	// 	<td>$half</td>
	// 	<td>Hrs OT</td>
	// </tr>";
$pdf->Cell(25,8,"",1,0,"C");
$pdf->Cell(20,8,'Tot Hrs',1,0,"C");
$pdf->Ln(8);



}else{
    // echo "NO GO!";  
}

  	}
	$pdf->Cell(20,8,'Total',1,0,"C");
	$pdf->Cell(225,8,"",1,0,"C");
	$pdf->Ln(8);
$pdf->Ln(5);
}else{
// $pdf->Cell(220,8,'No Data....',1,0,"C");
// $pdf->Ln(8);
}




	  	}

	}



$pdf->Output();

?>