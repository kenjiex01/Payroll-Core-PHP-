<?php 
include('../connection.php');

$working_hours_id = $_POST['working_hours_id'];                           
$cutoff = $_POST['cutoff'];                           
$payroll_month = $_POST['payroll_month'];                           
$employee_id = $_POST['employee_idsss'];                           
$number_of_days = $_POST['number_of_days'];                           
$holiday_pay = $_POST['holiday_pay'];                           
$number_of_ot = $_POST['number_of_ot'];                           
$number_of_late = $_POST['number_of_late'];      
$basic_pay = (float)$_POST['basic_pay'];

// $working_hours_id = 0;                           
// $cutoff = "Second Half";                           
// $payroll_month = "2021-07";                           
// $employee_id = "15";                           
// $number_of_days = "12";                           
// $holiday_pay = 0;                           
// $number_of_ot = 0;                           
// $number_of_late = "3.5";      
// $basic_pay = "3384";

// --------------------------------------------------------------------

$sql = "SELECT * FROM employee_details WHERE employee_id = '$employee_id' ";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
	$employee_rate = $row['employee_rate'];  	
  	$allowance = $row['allowance'];
  	}
}else{
	
}

$sql6 = "SELECT * FROM employee_tbl WHERE employee_id = '$employee_id' ";
$result6 = $conn->query($sql6);

if ($result6->num_rows > 0) {
  // output data of each row
  while($row6 = $result6->fetch_assoc()) {
	$contribution_status = $row6['contribution_status'];  	
  	}
}else{
	
}

$sql1 = "SELECT MAX(range_compensation_2),MAX(deduction),MAX(employer_deduction) FROM sss_contribution_tbl";
$result1 = $conn->query($sql1);

	if ($result1->num_rows > 0) {
	  // output data of each row
	  while($row1 = $result1->fetch_assoc()) {
	  		$max_range = $row1['MAX(range_compensation_2)'];
	  		$max_deduction = $row1['MAX(deduction)'];
	  		$max_employer_sss = $row1['MAX(employer_deduction)'];
	  	}
	}else{
							
	}

$sql5 = "SELECT SUM(num_days) FROM emp_working_hours WHERE emp_id = '$employee_id' AND month = '$payroll_month'";
$result5 = $conn->query($sql5);
$sum = "";
if ($result5->num_rows > 0) {
	// output data of each row
	while($row5 = $result5->fetch_assoc()) {
		$sum += $row5['SUM(num_days)'] + $number_of_days;
	}
}else{
						
}	

$sss_compensation = $sum * $employee_rate; 
if($sss_compensation >= $max_range){
	$sss_ee = $max_deduction;
	$sss_er = $max_employer_sss;
}else{
	$sql2 = "SELECT * FROM sss_contribution_tbl";
	$result2 = $conn->query($sql2);
	if ($result2->num_rows > 0) {
	  // output data of each row
	  while($row2 = $result2->fetch_assoc()) {
	  		if ($row2['range_compensation_1'] <= $sss_compensation AND $sss_compensation <= $row2['range_compensation_2']){
	  			$ssss_ee = $row2['deduction'];
	  			$ssss_er = $row2['employer_deduction'];

	  		}else{

	  		}
	  	}
	}else{
							
	}
}


$sql3 = "SELECT * FROM deduction_tbl";
$result3 = $conn->query($sql3);
if ($result3->num_rows > 0) {
	// output data of each row
	while($row3 = $result3->fetch_assoc()) {
	  	$pag_ee = $row3['PAGIBIG_deduction'];
	  	$pag_er = $row3['PAGIBIG_ER'];
	  	$phil_ee = $row3['philhealth_deduction'];
	  	$phil_er = $row3['philhealth_ER'];
	}
}else{
						
}

$total_cash_adv = 0;
$sql4 = "SELECT amount FROM cash_advance_tbl WHERE employee_id = '$employee_id' AND cut_off = '$cutoff' AND month_add = '$payroll_month' ";
$result4 = $conn->query($sql4);

if ($result4->num_rows > 0) {
// output data of each row
	while($row4 = $result4->fetch_assoc()) {
		$total_cash_adv += $row4['amount'];
	}
}else{

}


if($contribution_status == "Yes"){

		if($cutoff == "First Half"){
			$pagibig_ee = $pag_ee;
			$pagibig_er = $pag_er;

			$philhealth_ee = $phil_ee;
			$philhealth_er = $phil_er;

			$sss_ee = 0;
			$sss_er = 0;
		}else{

			$pagibig_ee = 0;
			$pagibig_er = 0;

			$philhealth_ee = 0;
			$philhealth_er = 0;

			$sss_ee = $ssss_ee;
			$sss_er = $ssss_er ;

		}

}else{
	$philhealth_ee = 0;
	$philhealth_er = 0;

	$sss_ee = 0;
	$sss_er = 0;

	$pagibig_ee = 0;
	$pagibig_er = 0;
}




$ot_pay = ($employee_rate / 8) * 1.25;
$total_ot_pay = $ot_pay * $number_of_ot;
$total_allowance = $allowance * $number_of_days;
$gross = (float)$basic_pay + (float)$holiday_pay + (float)$total_ot_pay + (float)$total_allowance;
// $gross = (float)$basic_pay;

$tardy_rate = ($employee_rate + $allowance) / 8;
$tardy_pay = $tardy_rate * $number_of_late;
$net_pay = $gross - $pagibig_ee - $philhealth_ee - $sss_ee - $tardy_pay - $total_cash_adv;
	  	$textArray = array(
	  				"basic_pay" => $basic_pay,
	  				"rate" => $employee_rate,
				    "ot_pay" =>  $total_ot_pay,
				    "total_allowance" =>  $total_allowance,
				    "gross" =>  $gross,
				    "pagibig_ee" =>  $pagibig_ee,
				    "pagibig_er" =>  $pagibig_er,
				    "sss_ee" =>  $sss_ee,
				    "sss_er" =>  $sss_er,
				    "philhealth_ee" =>  $philhealth_ee,
				    "philhealth_er" =>  $philhealth_er,
				    "tardy_pay" =>  $tardy_pay,
				    "total_cash_adv" =>  $total_cash_adv,
				    "net_pay" =>  $net_pay,
				);
  echo json_encode($textArray);  

?>