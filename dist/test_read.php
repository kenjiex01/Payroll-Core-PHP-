<?php 
ini_set('max_execution_time', 0); // 0 = Unlimited
date_default_timezone_set('Asia/Manila');
session_start();

if(isset($_FILES["file"]["name"])){
$_SESSION['start_date'] = $_POST['start_date'];
$_SESSION['end_date'] = $_POST['end_date'];


$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["file"]["name"]);


if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_dir.$_FILES['file']['name'])) {
    // $status = 1;
$_SESSION['file_name'] = $target_dir . basename($_FILES["file"]["name"]);
// header('location:test_read.php');
}
}

$file=fopen($_FILES["file"]["name"],"r");

$i=0;

$tot_time = "00:00:00";
$line=array();
while(($data=fgetcsv($file,1000,"\t"))!==FALSE){
$date_time = explode(" ", $data[6]);

$time=strtotime($date_time[0]);
$month=date("F",$time);
$year=date("Y",$time);
$dayy=date("d",$time);



$start_date_checker = date('Y-m-d', strtotime($_SESSION['start_date']));
$end_date_checker = date('Y-m-d', strtotime($_SESSION['end_date']));


$checking_date = date('Y-m-d', strtotime($date_time[0]));

if($i == 0 ){
	
}else{
// $tot_time = $date_time[1] + $tot_time;
$tot_time .= strtotime($tot_time)+strtotime($date_time[1]);
$tot_time = date("H:i:s",strtotime($tot_time));
// echo $date_time[0];

if($checking_date <= $end_date_checker AND $checking_date >= $start_date_checker ){

//inserting new customer details
include('connection.php');
$sql = "INSERT INTO employee_time (employee_id, date_in_out, time_in_out) VALUES ('".$data[2]."', '$date_time[0]', '$date_time[1]')";
	if ($conn->query($sql) === TRUE) {
print_r(array_values($data));
echo $dayy;
echo "<br>";

$conn->close();
	} else {
	  echo "Error Inserting Customer Details : " . $sql . $conn->error;
	}



}

}
$i++;
 
}
unset($_SESSION['file_name']);
fclose($file);
header('location:index.html');
//array_shift($line);

//$converted=fopen("try_bio.txt","w");

//foreach($line as $li){
//fputcsv($converted,$li);
//print_r(array_values($li));
//}
//fclose($converted);

// echo "import successful";

?>