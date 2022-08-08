<?php 
session_start();

unset($_SESSION['edit_id']);
unset($_SESSION['full_name']);
unset($_SESSION['employee_id']);
unset($_SESSION['date_in_out']);
unset($_SESSION['time_in_out']);
header("location:employee_time_management.php");
?>