<?php
session_start();

$_SESSION['company_name'] = $_POST['company_select'];
echo $_SESSION['company_name'];

header('location:../dashboard.php');
?>