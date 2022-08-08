<?php
include('../connection.php');
session_start();

$sql = "SELECT * FROM company";
$result = $conn->query($sql);

	if ($result->num_rows > 0) {
	  // output data of each row
	  while($row = $result->fetch_assoc()) {
	  	echo "<option value='".$row['company_name']."'>".$row['company_name']."</option>";
	  	}
	}else{
		
	}

?>