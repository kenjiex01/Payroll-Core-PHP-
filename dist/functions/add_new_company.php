<?php 
include('../connection.php');

$company_name = $_POST['company_name'];
//inserting new company
	$sql = "INSERT INTO company (company_name) VALUES ('$company_name')";

	if ($conn->query($sql) === TRUE) {
		header('location:../index.php');
	} else {
	  echo "Error Inserting data : " . $sql . $conn->error;
	}

$conn->close();
?>