<html>
  <body> 
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
      <input type="file" name="file" size="60" /><br><br>
      start date    <input type="date" name="start_date" id="start_date" /><br><br>
      End date    <input type="date" name="end_date" id="end_date" /><br><br>
      <input type="submit" value="Read Contents" />
    </form>
  </body>
</html>

<?php
date_default_timezone_set('Asia/Manila');
if ($_FILES) {
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    //Checking if file is selected or not
    if ($_FILES['file']['name'] != "") {
  
      //Checking if the file is plain text or not
      if (isset($_FILES) && $_FILES['file']['type'] != 'text/plain') {
          echo "<span>File could not be accepted ! Please upload any '*.txt' file.</span>";
          exit();
      } 
      echo "<center><span id='Content'>Contents of ".$_FILES['file']['name']." File</span></center>";
    
      //Getting and storing the temporary file name of the uploaded file
      $fileName = $_FILES['file']['tmp_name'];
    
      //Throw an error message if the file could not be open
      $file = fopen($fileName,"r") or exit("Unable to open file!");
     
      // Reading a .txt file line by line
      // while(!feof($file)) {
      //   // echo fgets($file). "<br>";
      //   echo fgets($file[1]) . "<br>";
      // }
      $i = 0;
      while(($data=fgetcsv($file,1000,"\t"))!==FALSE){
        if($i == 0){

        }
        else{
    $date_time = explode(" ", $data[6]);
    $time_in_out = date("H:i", strtotime($date_time[1]));
    $d_date = date("m/d/Y",strtotime($date_time[0]));
    $s_date = date("m/d/Y",strtotime($start_date));
    $e_date = date("m/d/Y",strtotime($end_date));
    $read_month =  date("M",strtotime($d_date));
    $read_date =  date("d",strtotime($d_date));
    $read_year =  date("Y",strtotime($d_date));
    if($read_year == date("Y",strtotime($s_date)) AND $read_year == date("Y",strtotime($e_date)) ){

            if(date("Y-m-d",strtotime($d_date)) >= date("Y-m-d",strtotime($s_date)) AND date("Y-m-d",strtotime($d_date)) <= date("Y-m-d",strtotime($e_date))){

              echo $data[2].'----------';
              echo $d_date.'------------';
              echo $time_in_out.'------------';
              // echo date(" ",strtotime($d_date)). "<br>";
              echo date("Y",strtotime($d_date)). "<br>";

            //inserting new customer details
            include('connection.php');
            $sql = "INSERT INTO employee_time (finger_id, date_in_out, time_in_out) VALUES ('".$data[2]."', '$date_time[0]', '$date_time[1]')";
                if ($conn->query($sql) === TRUE) {
            echo "<br>";
            $conn->close();
                } else {
                  echo "Error Inserting Customer Details : " . $sql . $conn->error;
                }



            }
        
    }
        }
        $i++;
      }

     
      //Reading a .txt file character by character
      while(!feof($file)) {
        echo fgetc($file);
      }
      fclose($file);
  } else {
      if (isset($_FILES) && $_FILES['file']['type'] == '')
        echo "<span>Please Choose a file by click on 'Browse' or 'Choose File' button.</span>";
    }
}
?>