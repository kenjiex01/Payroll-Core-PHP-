<?php
include('../connection.php');
session_start();

$delete_id = $_POST['delete_id'];
// sql to delete a record
$sql = "DELETE FROM cash_advance_tbl WHERE id='$delete_id'";

if ($conn->query($sql) === TRUE) {
			  echo "Employee Cash Advance has been deleted!";
} else {
  echo "Error deleting record: " . $conn->error;
}
?>