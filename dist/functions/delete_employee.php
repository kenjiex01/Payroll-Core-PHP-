<?php
include('../connection.php');
session_start();

$delete_id = $_POST['delete_id'];
// sql to delete a record
$sql = "DELETE FROM employee_tbl WHERE employee_id='$delete_id'";

if ($conn->query($sql) === TRUE) {

			$sql1 = "DELETE FROM employee_details WHERE employee_id='$delete_id'";

			if ($conn->query($sql1) === TRUE) {
			  echo "Employee and details has been deleted!";
			} else {
  			  echo "Employee has been deleted!";
			}

} else {
  echo "Error deleting record: " . $conn->error;
}
?>