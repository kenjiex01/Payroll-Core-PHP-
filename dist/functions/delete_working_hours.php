<?php
include('../connection.php');
session_start();

$delete_id = $_POST['delete_id'];
// sql to delete a record
$sql = "DELETE FROM emp_working_hours WHERE id='$delete_id'";

if ($conn->query($sql) === TRUE) {
			  echo "Employee working hours has been deleted!";
} else {
  echo "Error deleting record: " . $conn->error;
}
?>