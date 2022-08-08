<?php
include('../connection.php');
session_start();
$working_hours_id = $_POST['working_hours_id'];                           
$cutoff = $_POST['cutoff'];                           
$payroll_month = $_POST['payroll_month'];                           
$employee_id = $_POST['employee_id'];                           
$amount = $_POST['number_of_days'];       
$dates = date("Y-m-d");


if($working_hours_id == ""){

	//inserting sales
	$sql = "INSERT INTO cash_advance_tbl (employee_id, cut_off, month_add, date_added, amount) VALUES ('$employee_id', '$cutoff', '$payroll_month', '$dates', '$amount')";

	if ($conn->query($sql) === TRUE) {

	  echo "Employee Cash Advance Added Successfully.";
	  $action = "Employee Cash Advance Added Successfully of employee_id : ".$employee_id.".";
	  include("../user_logs.php");
	} else {
	  echo "Error Inserting data : " . $sql . $conn->error;
	}

}  //if
else{

	$sql = "UPDATE cash_advance_tbl SET employee_id = '$employee_id', month_add = '$payroll_month', cut_off = '$cutoff', amount = '$amount' WHERE id  = '$working_hours_id' ";

	if ($conn->query($sql) === TRUE) {
		echo "Employee Cash Advance updated Successfully.";
		$action = "Employee Cash Advance updated Successfully of employee_id : ".$employee_id.".";
		include("../user_logs.php");
	} else {
	  echo "Error updating record: " . $conn->error;
	}

}   //else                
$conn->close();
?>