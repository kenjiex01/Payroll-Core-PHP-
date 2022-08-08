<?php 
session_start();

unset($_SESSION['submitted']);
header('location:employee_time_management.php');
?>