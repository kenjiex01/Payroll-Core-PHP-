<?php 
session_start();
date_default_timezone_set('Asia/Manila');
$_SESSION['user_id'] = "1";
$company_name = $_SESSION['company_name'];
$curr_month = date("Y-m");

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
            //inserting new customer details
            include('connection.php');
            $sql = "INSERT INTO employee_time (finger_id, date_in_out, time_in_out) VALUES ('".$data[2]."', '$date_time[0]', '$date_time[1]')";
                if ($conn->query($sql) === TRUE) {
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

<!DOCTYPE html>

<html class="app-ui">

    <head>
        <!-- Meta -->
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />

        <!-- Document title -->
        <title>Index | PAYROLL</title>

        <meta name="description" content="AppUI - Admin Dashboard Template & UI Framework" />
        <meta name="author" content="rustheme" />
        <meta name="robots" content="noindex, nofollow" />

        <!-- Favicons -->
        <link rel="apple-touch-icon" href="assets/img/favicons/apple-touch-icon.png" />
        <link rel="icon" href="assets/img/favicons/favicon.ico" />

        <!-- Google fonts -->
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:300,400,400italic,500,900%7CRoboto+Slab:300,400%7CRoboto+Mono:400" />

        <!-- AppUI CSS stylesheets -->
        <link rel="stylesheet" id="css-font-awesome" href="assets/css/font-awesome.css" />
        <link rel="stylesheet" id="css-ionicons" href="assets/css/ionicons.css" />
        <link rel="stylesheet" id="css-bootstrap" href="assets/css/bootstrap.css" />
        <link rel="stylesheet" id="css-app" href="assets/css/app.css" />
        <link rel="stylesheet" id="css-app-custom" href="assets/css/app-custom.css" />
        <!-- End Stylesheets -->
    </head>

    <body class="app-ui layout-has-drawer layout-has-fixed-header">
        <div class="app-layout-canvas">
            <div class="app-layout-container">

                <header style="background-image: url('img/basic_bg.png');background-size: 1400px 800px;background-position: center top;margin-top: 1px;margin-bottom: -50px;">
                    <div >
                        
                    <h1 style="font-family: verdana;margin-left: 38%;margin-top: 50px;" >PAYROLL System</h1>
                    <h3><a  href="javascript:void(0)" style="margin-left: 42%;margin-top: -10%;color:#4c51ff;">Basic Frames & Photography</a></h3>
                    </div>
                </header>
                <main class="app-layout-content" style="margin-left: -16%;width: 1650px;">

                    <!-- Search Section -->
          

                    <!-- Page Content -->
                    <div class="container-fluid">
                        <div class="card">
                            <ul class="nav nav-tabs" data-toggle="tabs">
                                <li class="active" id="employee_management">
                                    <a href="#search-employee_management">Upload DTR</a>
                                </li>
                                <li id="generate_dtr">
                                    <a href="#search-generate_dtr">Generate DTR</a>
                                </li>
                            </ul>
                            <div class="card-block tab-content bg-white">
<!-- ___________________________________________________________UPLOAD DTR__________________________________________________________-->
                                <!--Tab employee management -->
                    <div class="tab-pane fade fade-in in active" id="search-employee_management">
                            <div class="b-b m-b-md">
                                <h2>UPLOAD  <small class="h5 text-muted">DTR</small><small class="h5 text-muted" style="margin-left: 75%;"><a href="index.php">Go Back</a></small></h2>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <h2 class="h3 m-b-m">

                                    <div class="col-lg-12">
                                     <a  href="javascript:void(0)">UPLOAD DTR</a>
                                    </div>
                                    </h2>
                                    <br>
                                    <br>
                            <div class="row">
                            <div class="col-lg-12">
                                
                            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
                              <input class="form-control" type="file" name="file" size="60" /><br>
                              start date    <input class="form-control" type="date" name="start_date" id="start_date" /><br>
                              End date    <input class="form-control" type="date" name="end_date" id="end_date" /><br><br>
                              <input class="btn btn-primary" type="submit" value="Read Contents" style="margin-left: 40%;" />
                            </form>

                                
                            </div>
                            
                        </div>

                            </div>
                        </div>
                                <!-- EndTab employee management -->
                    </div>
<!-- ___________________________________________________________UPLOAD DTR__________________________________________________________-->


<!-- ___________________________________________________________GENERATE DTR__________________________________________________________-->
                                <!--Tab employee management -->
                    <div class="tab-pane fade fade-in in" id="search-generate_dtr">
                            <div class="b-b m-b-md">
                                <h2>GENERATE  <small class="h5 text-muted">DTR</small></h2>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <h2 class="h3 m-b-m">

                                    <div class="col-lg-12">
                                     <a  href="javascript:void(0)">GENERATE DTR</a>
                                    </div>
                                    </h2>
                                    <br>
                                    <br>
                            <div class="row">
                            <div class="col-lg-12">
                                
                            <form method="POST" action="generate_dtr.php" target="_blank">
                            <!-- <select class="form-control" id="select_company" name="select_company">
                                <?php
                                // include('connection.php');
                                // session_start();

                                // $sql = "SELECT * FROM company";
                                // $result = $conn->query($sql);

                                //     if ($result->num_rows > 0) {
                                //       // output data of each row
                                //       while($row = $result->fetch_assoc()) {
                                //         echo "<option value='".$row['company_name']."'>".$row['company_name']."</option>";
                                //         }
                                //     }else{
                                        
                                //     }

                                ?>
                            </select> -->
                            <input type="text" class="form-control" name="select_company" id="select_company" value="<?php echo $company_name ?>" readonly>
                            <br>
                            start date    
                            <input class="form-control" type="date" name="start_date" id="start_date" /><br>
                            End date    
                            <input class="form-control" type="date" name="end_date" id="end_date" /><br><br>
                            <input class="btn btn-primary" type="submit" value="Read Contents" style="margin-left: 40%;" />
                            </form>

                                
                            </div>
                            
                        </div>

                            </div>
                        </div>
                                <!-- EndTab employee management -->
                    </div>
<!-- ___________________________________________________________GENERATE DTR__________________________________________________________-->




                            </div>
                        </div>
                    </div>
                    <!-- End Page Content -->

                </main>

            </div>
            <!-- .app-layout-container -->
        </div>
        <!-- .app-layout-canvas -->

        

        <div class="app-ui-mask-modal"></div>

        <!-- AppUI Core JS: jQuery, Bootstrap, slimScroll, scrollLock and App.js -->
        <script src="assets/js/core/jquery.min.js"></script>
        <script src="assets/js/core/bootstrap.min.js"></script>
        <script src="assets/js/core/jquery.slimscroll.min.js"></script>
        <script src="assets/js/core/jquery.scrollLock.min.js"></script>
        <script src="assets/js/core/jquery.placeholder.min.js"></script>
        <script src="assets/js/app.js"></script>
        <script src="assets/js/app-custom.js"></script>

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.all.min.js"></script>
        <script src="assets/js/plugins/dropzonejs/dropzone.min.js"></script>

        <!-- Page JS Plugins -->
        <script src="assets/js/plugins/datatables/jquery.dataTables.min.js"></script>

        <!-- Page JS Code -->
        <script src="assets/js/pages/base_tables_datatables.js"></script>

        <script>
            $(document).ready(function(){
                
            });
        </script>

    </body>

</html>