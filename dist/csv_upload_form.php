<?php 
include('connection.php');
if (isset($_POST['submit'])) 
	{
		 $handle = fopen($_FILES['filename']['tmp_name'], "r");
		$headers = fgetcsv($handle, 1000, ",");
		while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) 
		{
			

			$sql = "INSERT INTO sss_contribution_tbl (range_compensation_1, range_compensation_2, deduction) VALUES ('$data[1]', '$data[2]', '$data[3]')";

			if ($conn->query($sql) === TRUE) {

				echo $data[0] . " | ";
				echo $data[1] . " | ";
				echo $data[2] . " | ";
				echo $data[3] . " <br> ";
			} else {
			  echo "Error Inserting data : " . $sql . $conn->error;
			}


		}
fclose($handle);
	}



?>


<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

<form enctype='multipart/form-data' action='' method='post'>
 
<label>Upload Product CSV file Here</label>
 
<input size='50' type='file' name='filename'>
</br>
<input type='submit' name='submit' value='Upload Products'>
 
</form>


</body>
</html>