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
$basic_pay = $_POST['basic_pay'];      
$ot_pay = $_POST['ot_pay'];      
$total_allowance = $_POST['total_allowance'];      
$gross = $_POST['gross'];      
$pagibig_ee = $_POST['pagibig_ee'];      
$pagibig_er = $_POST['pagibig_er'];      
$sss_ee = $_POST['sss_ee'];      
$sss_er = $_POST['sss_er'];      
$philhealth_ee = $_POST['philhealth_ee'];      
$philhealth_er = $_POST['philhealth_er'];      
$tardy_pay = $_POST['tardy_pay'];      
$net_pay = $_POST['net_pay'];      


if($working_hours_id == ""){

	//inserting employee_working_hours
	$sql = "INSERT INTO emp_working_hours (emp_id, month, cutoff, num_days, num_late, holiday_pay, num_ot, basic_pay, ot_pay, total_allowance, gross, tardy_pay, net_pay) VALUES ('$employee_id', '$payroll_month', '$cutoff', '$number_of_days', '$number_of_late', '$holiday_pay', '$number_of_ot', '$basic_pay', '$ot_pay', '$total_allowance', '$gross', '$tardy_pay', '$net_pay')";

	if ($conn->query($sql) === TRUE) {

	  //inserting employee_contributions
		$sql1 = "INSERT INTO employee_monthly_contributions (employee_id, month, cutoff, sss_er, sss_ee, phil_er, phil_ee, pagibig_er, pagibig_ee) VALUES ('$employee_id', '$payroll_month', '$cutoff', '$sss_er', '$sss_ee', '$philhealth_er', '$philhealth_ee', '$pagibig_er', '$pagibig_ee')";

		if ($conn->query($sql1) === TRUE) {

		  echo "Employee Working Details Added Successfully.";
		} else {
		  echo "Error Inserting data : " . $sql . $conn->error;
		}


	} else {
	  echo "Error Inserting data : " . $sql . $conn->error;
	}

	

}  //end if
else{

	$sql = "UPDATE emp_working_hours SET emp_id = '$employee_id', month = '$payroll_month', cutoff = '$cutoff', num_days = '$number_of_days', num_late = '$number_of_late', holiday_pay = '$holiday_pay', num_ot = '$number_of_ot', basic_pay = '$basic_pay' WHERE id  = '$working_hours_id' ";

	if ($conn->query($sql) === TRUE) {
		echo "Employee updated Successfully.";
	} else {
	  echo "Error updating record: " . $conn->error;
	}

}   //else                
$conn->close();
?>