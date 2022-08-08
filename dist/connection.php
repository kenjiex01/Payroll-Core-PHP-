<?php
$servername = "localhost";
$username = "root";
$password = "usbw";
$dbname = "payroll";
date_default_timezone_set('Asia/Manila');
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}




// $servername = "192.168.1.253:3306";
// $username = "root";
// $password = "basic54321@";
// $dbname = "daily_reports";
// date_default_timezone_set('Asia/Manila');
// // Create connection
// $conn = new mysqli($servername, $username, $password, $dbname);
// // Check connection
// if ($conn->connect_error) {
//   die("Connection failed: " . $conn->connect_error);
// }

?>