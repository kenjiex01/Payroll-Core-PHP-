<?php
include('../connection.php');
session_start();

$delete_id = $_POST['delete_id'];
// sql to delete a record
$sql = "DELETE FROM employee_details WHERE employee_id='$delete_id'";

if ($conn->query($sql) === TRUE) {
  echo "Employee details has been deleted!";
} else {
  echo "Error deleting record: " . $conn->error;
}
?>