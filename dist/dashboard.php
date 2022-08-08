<?php 
session_start();
date_default_timezone_set('Asia/Manila');
$_SESSION['user_id'] = "1";
$company_name = $_SESSION['company_name'];
$curr_month = date("Y-m");
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

                    <h1 style="font-family: verdana;text-align: center;margin-top: 50px;" >PAYROLL System</h1>
                    <h3 style="text-align: center;"><a  href="javascript:void(0)" style="margin-top: -10%;color:#4c51ff;"><?php echo $_SESSION['company_name']; ?></a></h3>
                </div>
            </header>
            <main class="app-layout-content" style="margin-left: -16%;width: 1650px;">

                <!-- Search Section -->


                <!-- Page Content -->
                <div class="container-fluid">
                    <div class="card">
                        <ul class="nav nav-tabs" id="myTab">
                            <li class="nav-item">
                                <a href="#search-employee_management" class="nav-link active" data-toggle="tab">Employee</a>
                            </li>
                            <li class="nav-item">
                                <a href="#search-users" class="nav-link" data-toggle="tab">Payroll Form</a>
                            </li>
                            <li class="nav-item">
                                <a href="#search-cash_advance" class="nav-link" data-toggle="tab">Cash Advance</a>
                            </li>
                            <li class="nav-item">
                                <a href="#search-time_management" class="nav-link" data-toggle="tab">Time Management</a>
                            </li>
                            <li class="nav-item">
                                <a href="#search-genrate_payslip" class="nav-link" data-toggle="tab">Generate Payslip</a>
                            </li>
                            <li class="nav-item">
                                <a href="#search-projects" class="nav-link" data-toggle="tab">Generate PDF</a>
                            </li>
                            <li class="nav-item">
                                <a href="#search-bir_report" class="nav-link" data-toggle="tab">Monthly Report</a>
                            </li>
                            <li class="nav-item">
                                <a href="#search-xmas_report" class="nav-link" data-toggle="tab">Christmas Bonus Report</a>
                            </li>
                        </ul>
                        <div class="card-block tab-content bg-white">
                            <!-- ___________________________________________________________Employee__________________________________________________________-->
                            <!--Tab employee management -->



                            <!-- ===============================================Employee=============================================-->            
                            <div class="tab-pane fade fade-in in active" id="search-employee_management">
                                <div class="b-b m-b-md">
                                    <h2>EMPLOYEE  <small class="h5 text-muted">MANAGEMENT</small></h2>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <h2 class="h3 m-b-m">

                                            <div class="col-lg-8">
                                             <a  href="javascript:void(0)">Employee Table</a>
                                         </div>
                                         <div class="col-lg-4">
                                            <a  href="javascript:void(0)">Employee Form</a>
                                        </div>
                                    </h2>
                                    <br>
                                    <br>
                                    <div class="row">
                                        <div class="col-lg-8">


                                            <h2>Legend</h2>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <button class="btn btn-primary"><i class="fa fa-pencil"></i> Edit</button> 
                                                    <button class="btn btn-danger"><i class="fa fa-trash"></i> Delete</button> 
                                                    <button class="btn btn-warning"><i class="fa fa-ban"></i> Resigned</button> 
                                                    <button class="btn btn-success"><i class="fa fa-check"></i> active</button> 
                                                </div>
                                            </div>

                                            <table class="table table-bordered table-striped table-vcenter js-dataTable-full" id="employee_tbl">
                                                <thead>
                                                    <tr>
                                                        <td>Employee ID</td>
                                                        <td>Fingerprint</td>
                                                        <td>Full Name</td>
                                                        <td>Company</td>
                                                        <td>Position</td>
                                                        <td>Contribution Status</td>
                                                        <td>Action</td>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php 
                                                    include('connection.php');
                                                    $company = $_SESSION['company_name'];
                                                    $sql = "SELECT * FROM employee_tbl WHERE company = '$company'";
                                                    $result = $conn->query($sql);

                                                    if ($result->num_rows > 0) {
                                              // output data of each row
                                                        while($row = $result->fetch_assoc()) {
                                                            if($row['status'] == "Active"){
                                                $color = "#000000"; // black
                                            }else{
                                                $color = "#ff002d"; // red
                                            }

                                            echo "<tr style='color:".$color."'>";
                                            echo "<td>".$row['employee_id']."</td>";
                                            echo "<td>".$row['finger_id']."</td>";
                                            echo "<td>".$row['employee_first_name']." ".$row['employee_middle_name']." ".$row['employee_last_name']."</td>";
                                            echo "<td>".$row['company']."</td>";
                                            echo "<td>".$row['position']."</td>";
                                            echo "<td class='contribution_status' id='contribution_status' data-id='".$row['employee_id']."' data-status='".$row['contribution_status']."'>".$row['contribution_status']."</td>";
                                            echo "<td>
                                            <button type='button' class='btn btn-primary employee_edit_btns' id='employee_edit_btns' data-edit_id='".$row['employee_id']."'><i class='fa fa-pencil'></i></button>
                                            <button type='button' class='btn btn-danger employee_delete_btns' id='employee_delete_btns' data-delete_id='".$row['employee_id']."'><i class='fa fa-trash'></i></button>";
                                            if($row['status'] == "Active"){
                                                echo "<button class='btn btn-warning change_status' id='change_status' data-status='Resigned' data-emp_id='".$row['employee_id']."'><i class='fa fa-ban'></i></button> ";
                                            }
                                            else{
                                                echo "<button class='btn btn-success change_status' id='change_status' data-status='Active' data-emp_id='".$row['employee_id']."'><i class='fa fa-check'></i></button>";
                                            }

                                            echo"</td>";
                                            echo "</tr>";
                                        }
                                    }

                                    ?>
                                </tbody>

                            </table>


                        </div>
                        <div class="col-lg-4">

                            <div class="card">
                                <div class="card-header">

                                </div>
                                <div class="card-block">
                                    <!-- DropzoneJS Container -->
                                    <form class="form-horizontal m-t-sm">

                                        <div class="form-group">
                                            <div class="col-sm-12">
                                                <div class="form-material floating">
                                                    <input class="form-control" type="text" id="new_employee_id" name="new_employee_id" style="text-align: right;" readonly>
                                                    <label for="new_employee_id">Employee ID</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-sm-12">
                                                <div class="form-material floating">
                                                    <input class="form-control" type="text" id="new_finger_number" name="new_finger_number" style="text-align: right;">
                                                    <label for="new_finger_number">Finger print number</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-sm-12">
                                                <div class="form-material floating">
                                                    <input class="form-control" type="text" id="first_name" name="first_name" style="text-align: right;">
                                                    <label for="first_name">First Name</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-sm-12">
                                                <div class="form-material floating">
                                                    <input class="form-control" type="text" id="middle_initial" name="middle_initial" style="text-align: right;">
                                                    <label for="middle_initial">Middle Name</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-sm-12">
                                                <div class="form-material floating">
                                                    <input class="form-control" type="text" id="last_name" name="last_name" style="text-align: right;">
                                                    <label for="last_name">Last Name</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-sm-12">
                                                <div class="form-material floating">
                                                    <!-- <select class="form-control" id="company_name" name="company_name">
                                                        <option></option>
                                                        //<?php 
                                                        // include('connection.php');

                                                        // $sql = "SELECT * FROM company";
                                                        // $result = $conn->query($sql);

                                                        // if ($result->num_rows > 0) {
                                                        //       // output data of each row
                                                        //   while($row = $result->fetch_assoc()) {
                                                        //     echo "<option value='".$row['company_name']."'>". $row['company_name']."</option>";
                                                        //}
                                                    //}
                                                    //?>
                                                </select> -->
                                                <input class="form-control" type="text" name="company_name" id="company_name" value="<?php echo $_SESSION['company_name']; ?>" readonly>

                                                <label for="company_name">Company</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <div class="form-material floating">
                                                <input class="form-control" type="text" id="employee_position" name="employee_position" style="text-align: right;">
                                                <label for="employee_position">Position</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div>
                                        <button class="btn btn-success" style="margin-left: 20%;" type="button" id="employee_submit_btn">Add Employee</button>
                                        <button class="btn btn-danger" type="button" id="clear_employee_form">Clear Form</button>
                                    </div>
                                </form>
                            </div>
                            <!-- .card-block -->
                        </div>
                        <!-- .card -->

                    </div>
                </div>





            </div>

        </div>
        <!-- ===============================================Employee=============================================-->

        <br>
        <br>
        <!-- ===========================================Employee Details=============================================-->



        <div class="row">
            <h2 class="h3 m-b-m">

                <div class="col-lg-8">
                 <a  href="javascript:void(0)">Employee Details Table</a>
             </div>
             <div class="col-lg-4">
                 <a  href="javascript:void(0)">Employee Details Form</a>
             </div>
         </h2>
         <br>
         <br>
         <div class="col-lg-8">
           <table class="table table-bordered table-striped table-vcenter js-dataTable-full" id="tbl_employee_details">
            <thead>
                <tr>
                    <td>ID</td>
                    <td>Full Name</td>
                    <td>Rate</td>
                    <td>Allowance</td>
                    <td>Action</td>
                </tr>
            </thead>
            <tbody>
                <?php 
                include('connection.php');
                $company = $_SESSION['company_name'];
                $sql = "SELECT * FROM employee_details ";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                                              // output data of each row
                    while($row = $result->fetch_assoc()) {
                        $emp_id = $row['employee_id'];

                        $sql1 = "SELECT * FROM employee_tbl WHERE employee_id = '$emp_id' AND company = '$company'";
                        $result1 = $conn->query($sql1);

                        if ($result1->num_rows > 0) {
                                                      // output data of each row
                            while($row1 = $result1->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>".$row['employee_id']."</td>";
                                echo "<td>".$row1['employee_first_name']." " .$row1['employee_middle_name']. " " . $row1['employee_last_name']. "</td>";
                                echo "<td>".$row['employee_rate']."</td>";
                                echo "<td>".$row['allowance']."</td>";
                                echo "<td>
                                <button class='btn btn-primary edit_btn' id='edit_btn' data-id='".$row['employee_id']."'><i class='fa fa-pencil'></i></button>
                                <button class='btn btn-danger delete_btn' id='delete_btn' data-id='".$row['employee_id']."'><i class='fa fa-trash'></i></button>
                                </td>";
                                echo "</tr>";

                            }
                        }



                    }
                }

                ?>
            </tbody>

        </table>

    </div>
    <div class="col-lg-4">
        <!-- DropzoneJS -->
        <!-- For more info and examples please check http://www.dropzonejs.com/#usage -->
        <!-- <h2 class="section-title">Employee Details</h2> -->
        <div class="card">
            <div class="card-header">

               <button class="btn btn-primary" style="margin-left: 92%;" type="button" data-toggle="modal" data-target="#modal-employee_select"><i class="fa fa-user"></i></button>

           </div>
           <div class="card-block">
            <!-- DropzoneJS Container -->
            <form class="form-horizontal m-t-sm">
                <input type="text" name="employee_update_id" id="employee_update_id" hidden>
                <div class="form-group">
                    <div class="col-sm-12">
                        <div class="form-material floating">
                            <input class="form-control" type="text" id="employee_id" name="employee_id" style="text-align: right;" readonly>
                            <label for="employee_id">Employee ID</label>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-12">
                        <div class="form-material floating">
                            <input class="form-control" type="text" id="employee_name" name="employee_name" style="text-align: right;" readonly>
                            <label for="employee_name">Employee Name</label>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-12">
                        <div class="form-material floating">
                            <input class="form-control" type="text" id="employee_rate" name="employee_rate" style="text-align: right;">
                            <label for="employee_rate">Rate / Day</label>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-12">
                        <div class="form-material floating">
                            <input class="form-control" type="text" id="allowance" name="allowance" style="text-align: right;">
                            <label for="allowance">Allowance</label>
                        </div>
                    </div>
                </div>
                <div>
                    <button class="btn btn-success" style="margin-left: 20%;" type="button" id="employee_details_submit_btn">Add Details</button>
                    <button class="btn btn-danger" type="button" id="clear_form">Clear Form</button>
                </div>
            </form>
        </div>
        <!-- .card-block -->
    </div>
    <!-- .card -->
    <!-- End DropzoneJS -->
</div>
<!-- .col-lg-6 -->
</div>
<!-- .row -->

<!-- ===========================================Employee Details=============================================-->



<!-- =========================================== Modal =============================================-->
<!--Start modals -->
<!-- Pop Out Modal -->
<div class="modal fade" id="modal-employee_select" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-popout">
        <div class="modal-content">
            <div class="card-header bg-green bg-inverse">
                <h4>Select Employee</h4>
                <ul class="card-actions">
                    <li>
                        <button data-dismiss="modal" type="button"><i class="ion-close"></i></button>
                    </li>
                </ul>
            </div>
            <div class="card-block">
               <table class="table table-bordered table-striped table-vcenter js-dataTable-full" id="tbl_employee">
                <thead>
                    <tr>
                        <td>ID</td>
                        <td>Full Name</td>
                        <td>Company</td>
                        <td>Postion</td>
                        <td>Action</td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include('connection.php');
                    $company = $_SESSION['company_name'];
                    $sql = "SELECT * FROM employee_tbl WHERE company = '$company'";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                                              // output data of each row
                      while($row = $result->fetch_assoc()) {


                        $sql1 = "SELECT * FROM employee_details WHERE employee_id = '".$row['employee_id']."' ";
                        $result1 = $conn->query($sql1);

                        if ($result1->num_rows > 0) {
                                                      // output data of each row
                          while($row1 = $result1->fetch_assoc()) {
                          }
                      }else{
                        echo "<tr>";
                        echo "<td>". $row['employee_id'] ."</td>";
                        echo "<td>". $row['employee_first_name']. " " .$row['employee_middle_name']." ".$row['employee_last_name']."</td>";
                        echo "<td>". $row['company'] ."</td>";
                        echo "<td>". $row['position'] ."</td>";
                        echo "<td><button type='button' class='btn btn-success btn_select_employee' id='btn_select_employee' data-id='".$row['employee_id']."' data-dismiss='modal'>Select</button></td>";
                        echo "</tr>";
                    }
                }
            }
            ?>
        </tbody>
    </table>
</div>
</div>
</div>
</div>
<!-- End Pop Out Modal -->
<!--End modals -->
<!-- =========================================== Modal =============================================-->


<!-- EndTab employee management -->
</div>
<!-- ___________________________________________________________Employee__________________________________________________________-->


<!--________________________________________________________PAYROLL FORM__________________________________________________________-->


<div class="tab-pane fade fade-in" id="search-users">
    <div class="b-b m-b-md">
        <h2>PAYROLL <small class="h5 text-muted">FORM</small></h2>
    </div>
    <div class="col-lg-8">
     <a  href="javascript:void(0)">Payroll Table</a>
 </div>
 <div class="col-lg-4">
     <a  href="javascript:void(0)">Payroll Form</a>
 </div>
</h2>
<br>
<br>

<div class="row">
    <div class="col-lg-8">

        <table class="table table-bordered table-striped table-vcenter js-dataTable-full" style="text-align: center;" id="working_hours_tbl">
            <thead>
                <td>Employee ID</td>
                <td>Employee Name</td>
                <td>Month</td>
                <td>Cut off</td>
                <td># Days</td>
                <td># Late</td>
                <td># OT</td>
                <td>Holiday Pay</td>
                <td>Action</td>

            </thead>
            <tbody>
                <?php
                include('connection.php');
                $company = $_SESSION['company_name'];
                $sql = "SELECT * FROM emp_working_hours";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                                            // output data of each row
                    while($row = $result->fetch_assoc()) {
                        $sql1 = "SELECT * FROM employee_tbl WHERE employee_id='".$row['emp_id']."' AND company = '$company'";
                        $result1 = $conn->query($sql1);

                        if ($result1->num_rows > 0) {
                                                    // output data of each row
                        echo "<tr>";
                        echo "<td>".$row['emp_id']."</td>";
                            while($row1 = $result1->fetch_assoc()) {
                                echo "<td>".$row1['employee_first_name']. " " . $row1['employee_middle_name']. " " . $row1['employee_last_name']."</td>";

                        echo "<td>".date("Y-M", strtotime($row['month']))."</td>";
                        echo "<td>".$row['cutoff']."</td>";
                        echo "<td>".$row['num_days']."</td>";
                        echo "<td>".$row['num_late']."</td>";
                        echo "<td>".$row['num_ot']."</td>";
                        echo "<td>".$row['holiday_pay']."</td>";
                        echo "<td>
                        <button class='btn btn-primary edit_btnsss' id='edit_btnsss' data-id='".$row['id']."'><i class='fa fa-pencil' ></i></button>
                        <button class='btn btn-danger delete_btnsss' id='delete_btnsss' data-id='".$row['id']."'><i class='fa fa-trash' ></i></button>
                        </td>";
                        echo "</tr>";
                            }
                        }
                    }
                }
                ?>
            </tbody>

        </table>

    </div>
    <div class="col-lg-4">
        <!-- DropzoneJS -->
        <!-- For more info and examples please check http://www.dropzonejs.com/#usage -->
        <h2 class="section-title">Payroll Form</h2>
        <div class="card">
            <div class="card-block card-block-full">
                <!-- DropzoneJS Container -->
                <button class="btn btn-primary" style="margin-left: 90%;" data-toggle="modal" data-target="#modal-employee_selectsss"><i class="fa fa-user"></i></button>
                <form class="form-horizontal m-t-sm">


                    <input type="text" id="working_hours_id" name="working_hours_id" hidden />


                    <div class="form-group">
                        <div class="col-sm-12">
                            <div class="form-material floating">
                                <select class="form-control" id="cutoff" name="cutoff">
                                    <option value='First Half'>First Half</option>
                                    <option value='Second Half'>Second Half</option>
                                </select>

                                <label for="cutoff">Cut off</label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-12">
                            <div class="form-material floating">
                                <input class="form-control" type="month" id="payroll_month" name="payroll_month" style="text-align: right;" value='<?php echo date("Y-m");?>'>
                                <label for="payroll_month">Month</label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-12">
                            <div class="form-material floating">
                                <input class="form-control" type="text" id="working_employee_idsss" name="working_employee_idsss" style="text-align: right;" readonly>
                                <label for="working_employee_idsss">Employee ID</label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-12">
                            <div class="form-material floating">
                                <input class="form-control" type="text" id="number_of_days" name="number_of_days" style="text-align: right;">
                                <label for="number_of_days">Number of Days</label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-12">
                            <div class="form-material floating">
                                <input class="form-control" type="text" id="holiday_pay" name="holiday_pay" style="text-align: right;">
                                <label for="holiday_pay">Holiday Pay</label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-12">
                            <div class="form-material floating">
                                <input class="form-control" type="text" id="number_of_ot" name="number_of_ot" style="text-align: right;">
                                <label for="number_of_ot">Number of Overtime</label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-12">
                            <div class="form-material floating">
                                <input class="form-control" type="text" id="number_of_late" name="number_of_late" style="text-align: right;">
                                <label for="Late">Number of Late</label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-12">
                            <div class="form-material floating">
                                <input class="form-control" type="text" id="basic_pay" name="basic_pay" style="text-align: right;" readonly>
                                <label for="Late">Basic Pay</label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-12">
                            <div class="form-material floating">
                                <button type="button" id="submit_btnsss" class="btn btn-success" style="margin-left:25%; ">Submit</button>
                                <button type="button" id="clear_btnsss" class="btn btn-danger" style="margin-left:2%;">Clear Form</button>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
            <!-- .card-block -->
        </div>
        <!-- .card -->
        <!-- End DropzoneJS -->
    </div>
    <!-- .col-lg-4 -->

</div>

</div>

<!--________________________________________________________Modal PAYROLL FORM__________________________________________________-->
<!-- Pop Out Modal -->
<div class="modal fade" id="modal-employee_selectsss" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-popout">
        <div class="modal-content">
            <div class="card-header bg-green bg-inverse">
                <h4>Select Employee</h4>
                <ul class="card-actions">
                    <li>
                        <button data-dismiss="modal" type="button"><i class="ion-close"></i></button>
                    </li>
                </ul>
            </div>

            <div class="card-block">
               <table class="table table-bordered table-striped table-vcenter js-dataTable-full" id="tbl_employeess">
                <thead>
                    <tr>
                        <td>ID</td>
                        <td>Full Name</td>
                        <td>Company</td>
                        <td>Postion</td>
                        <td>Action</td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include('connection.php');
                    $company = $_SESSION['company_name'];
                    $sql = "SELECT * FROM employee_tbl WHERE status = 'Active' AND company = '$company'";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                                              // output data of each row
                      while($row = $result->fetch_assoc()) {


                        $sql1 = "SELECT * FROM employee_details WHERE employee_id = '".$row['employee_id']."' ";
                        $result1 = $conn->query($sql1);

                        if ($result1->num_rows > 0) {
                                                      // output data of each row
                          while($row1 = $result1->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>". $row['employee_id'] ."</td>";
                            echo "<td>". $row['employee_first_name']. " " .$row['employee_middle_name']." ".$row['employee_last_name']."</td>";
                            echo "<td>". $row['company'] ."</td>";
                            echo "<td>". $row['position'] ."</td>";
                            echo "<td><button type='button' class='btn btn-success btn_select_employeesss' id='btn_select_employeesss' data-id='".$row['employee_id']."' data-dismiss='modal'>Select</button></td>";
                            echo "</tr>";
                        }
                    }else{
                    }
                }
            }
            ?>
        </tbody>
    </table>
</div>
</div>
</div>
</div>
<!-- End Pop Out Modal -->

<!--________________________________________________________Modal PAYROLL FORM__________________________________________________-->

<!--________________________________________________________PAYROLL FORM__________________________________________________________-->
<!--________________________________________________________CASH ADVANCE__________________________________________________________-->

<div class="tab-pane fade fade-in" id="search-cash_advance">
    <div class="b-b m-b-md">
        <h2>CASH <small class="h5 text-muted">ADVANCE</small></h2>
    </div>


    <div class="col-lg-8">
     <a  href="javascript:void(0)">Cash Advance Table</a>
 </div>
 <div class="col-lg-4">
     <a  href="javascript:void(0)">Cash Advance Form</a>
 </div>
</h2>
<br>
<br>


<!-- DropzoneJS and Tags Input -->
<div class="row">
    <div class="col-lg-8">

        <table class="table table-bordered table-striped table-vcenter js-dataTable-full" style="text-align: center;" id="working_hours_tbl_ca">
            <thead>
                <td>Employee ID</td>
                <td>Employee Name</td>
                <td>Cutoff</td>
                <td>Month</td>
                <td>Amount</td>
                <td>Action</td>

            </thead>
            <tbody>
                <?php
                include('connection.php');

                $sql = "SELECT * FROM cash_advance_tbl";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                                            // output data of each row
                    while($row = $result->fetch_assoc()) {

                        $sql1 = "SELECT * FROM employee_tbl WHERE employee_id = '".$row['employee_id']."' AND company = '$company_name' ";
                        $result1 = $conn->query($sql1);

                        if ($result1->num_rows > 0) {
                                                    // output data of each row
                            while($row1 = $result1->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>".$row['employee_id']."</td>";
                                echo "<td>".$row1['employee_first_name']." ".$row1['employee_middle_name']." ".$row1['employee_last_name']."</td>";
                                $monthss = date("M", strtotime($row['month_add']));
                                echo "<td>".$row['cut_off']."</td>";
                                echo "<td>".$monthss."</td>";
                                echo "<td>".number_format($row['amount'],2)."</td>";
                                echo "<td>
                                <button class='btn btn-primary edit_btn_ca' id='edit_btn_ca' data-id='".$row['id']."'><i class='fa fa-pencil' ></i></button>
                                <button class='btn btn-danger delete_btn_ca' id='delete_btn_ca' data-id='".$row['id']."'><i class='fa fa-trash' ></i></button>
                                </td>";
                                echo "</tr>";
                            }
                        }
                    }
                }
                ?>
            </tbody>

        </table>

    </div>
    <div class="col-lg-4">
        <!-- DropzoneJS -->
        <!-- For more info and examples please check http://www.dropzonejs.com/#usage -->
        <h2 class="section-title">Cash Advance Form</h2>
        <div class="card">
            <div class="card-block card-block-full">
                <!-- DropzoneJS Container -->
                <button class="btn btn-primary" style="margin-left: 90%;" data-toggle="modal" data-target="#modal-employee_select_ca"><i class="fa fa-user"></i></button>
                <form class="form-horizontal m-t-sm">


                    <input type="text" id="working_hours_id_ca" name="working_hours_id_ca" hidden />


                    <div class="form-group">
                        <div class="col-sm-12">
                            <div class="form-material floating">
                                <select class="form-control" id="cutoff_ca" name="cutoff_ca">
                                    <option value='First Half'>First Half</option>
                                    <option value='Second Half'>Second Half</option>
                                </select>

                                <label for="cutoff_ca">Cut off</label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-12">
                            <div class="form-material floating">
                                <input class="form-control" type="month" id="payroll_month_ca" name="payroll_month_ca" style="text-align: right;" value='<?php echo date("Y-m");?>'>
                                <label for="payroll_month">Month</label>  
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-12">
                            <div class="form-material floating">
                                <input class="form-control" type="text" id="employee_id_ca" name="employee_id_ca" style="text-align: right;" readonly>
                                <label for="employee_id">Employee ID</label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-12">
                            <div class="form-material floating">
                                <input class="form-control" type="text" id="number_of_days_ca" name="number_of_days_ca" style="text-align: right;">
                                <label for="number_of_days">Amount</label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-12">
                            <div class="form-material floating">
                                <button type="button" id="submit_btn_ca" class="btn btn-success" style="margin-left:25%; ">Submit</button>
                                <button type="button" id="clear_btn_ca" class="btn btn-danger" style="margin-left:2%;">Clear Form</button>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
            <!-- .card-block -->
        </div>
        <!-- .card -->
        <!-- End DropzoneJS -->
    </div>
    <!-- .col-lg-6 -->
</div>
<!-- .row -->


</div>
<!--_______________________________________________MODAL CASH ADVANCE __________________________________________________________-->
<!-- Pop Out Modal -->
<div class="modal fade" id="modal-employee_select_ca" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-popout">
        <div class="modal-content">
            <div class="card-header bg-green bg-inverse">
                <h4>Select Employee</h4>
                <ul class="card-actions">
                    <li>
                        <button data-dismiss="modal" type="button"><i class="ion-close"></i></button>
                    </li>
                </ul>
            </div>

            <div class="card-block">
               <table class="table table-bordered table-striped table-vcenter js-dataTable-full" id="tbl_employee_ca">
                <thead>
                    <tr>
                        <td>ID</td>
                        <td>Full Name</td>
                        <td>Company</td>
                        <td>Postion</td>
                        <td>Action</td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include('connection.php');

                    $sql = "SELECT * FROM employee_tbl WHERE status = 'Active' AND company = '$company_name'";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                                              // output data of each row
                      while($row = $result->fetch_assoc()) {


                        $sql1 = "SELECT * FROM employee_details WHERE employee_id = '".$row['employee_id']."' ";
                        $result1 = $conn->query($sql1);

                        if ($result1->num_rows > 0) {
                                                      // output data of each row
                          while($row1 = $result1->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>". $row['employee_id'] ."</td>";
                            echo "<td>". $row['employee_first_name']. " " .$row['employee_middle_name']." ".$row['employee_last_name']."</td>";
                            echo "<td>". $row['company'] ."</td>";
                            echo "<td>". $row['position'] ."</td>";
                            echo "<td><button type='button' class='btn btn-success btn_select_employee_ca' id='btn_select_employee_ca' data-id='".$row['employee_id']."' data-dismiss='modal'>Select</button></td>";
                            echo "</tr>";
                        }
                    }else{
                    }
                }
            }
            ?>
        </tbody>
    </table>
</div>
</div>
</div>
</div>
<!-- End Pop Out Modal -->
<!--End modals -->
<!--_______________________________________________MODAL CASH ADVANCE __________________________________________________________-->

<!--________________________________________________________CASH ADVANCE__________________________________________________________-->



<!--________________________________________________________TIME MANAGEMENT______________________________________________________-->
<div class="tab-pane fade fade-in" id="search-time_management">
    <div class="b-b m-b-md">
        <h2> EMPLOYEE TIME <small class="h5 text-muted">MANAGEMENT</small><small class="h5 text-muted" style="margin-left: 75%;"><a href="Upload_dtr.php">Upload DTR</a></small></h2>
    </div>


    <div class="col-lg-8">
     <a  href="javascript:void(0)">Employee Time Table</a>
 </div>
 <div class="col-lg-4">
     <a  href="javascript:void(0)">Employee Time Form</a>
 </div>
 <br>
 <br>


 <div class="row">
    <div class="col-lg-8">
        <?php $val = "Name";?>
        <!-- <iframe src="display_pdf.php" style="width: 1170px;height: 800px;"></iframe> -->
        <div class="card-block">
            <div class="row">
                <div class="col-lg-6">
                   Start Date : <input class="form-control" type="date" name="start_date" id="start_date" value="<?php echo date('Y-m-d'); ?>" />  
               </div>
               <div class="col-lg-6">
                   End Date : <input class="form-control" type="date" name="end_date" id="end_date" value="<?php echo date('Y-m-d'); ?>" />
               </div>
           </div>
           <br>
           <table class="table table-bordered table-striped table-vcenter"  id="tbl_employee_time" style="text-align: center;">
            <thead>
                <tr>
                    <td>Employee ID</td>
                    <td>Employee Name</td>
                    <td>Date</td>
                    <td>IN</td>
                    <td>OUT</td>
                    <td>IN</td>
                    <td>OUT</td>
                </tr>
            </thead>
            <tbody id="reloadingg">


            </tbody>
        </table>
    </div>

</div>


<div class="col-lg-4">
    <!-- DropzoneJS -->
    <!-- For more info and examples please check http://www.dropzonejs.com/#usage -->
    <h2 class="section-title">Employee Time Form</h2>
    <div class="card">
        <div class="card-block card-block-full">
            <!-- DropzoneJS Container -->

            <button class="btn btn-primary" style="margin-left: 90%;" data-toggle="modal" data-target="#modal-employee_select_time"><i class="fa fa-user"></i></button>
            <form class="form-horizontal m-t-sm">

                <div class="form-group">
                    <div class="col-sm-12">
                        <div class="form-material floating">
                            <input class="form-control" type="text" id="employee_time_id" name="employee_time_id" style="text-align: right;" readonly>
                            <label for="employee_time_id">Time ID</label>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-12">
                        <div class="form-material floating">
                            <input class="form-control" type="text" id="employee_id_time" name="employee_id_time" style="text-align: right;" readonly>
                            <label for="employee_id_time">Employee ID</label>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-12">
                        <div class="form-material floating">
                            <input class="form-control" type="text" id="employee_name_time" name="employee_name_time" style="text-align: right;">
                            <label for="employee_name_time">Employee Name</label>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-12">
                        <div class="form-material floating">
                            <input class="form-control" type="date" id="employee_date_time" name="employee_date_time" style="text-align: right;">
                            <label for="employee_date_time">Date</label>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-12">
                        <div class="form-material floating">
                            <input class="form-control" type="time" id="employee_time_time" name="employee_time_time" style="text-align: right;">
                            <label for="employee_time_time">Time</label>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-12">
                        <div class="form-material floating">
                            <button type="button" id="submit_employee_time" class="btn btn-success" style="margin-left:25%; ">Submit</button>
                            <button type="button" id="clear_btn_time" class="btn btn-danger" style="margin-left:2%;">Clear Form</button>
                        </div>
                    </div>
                </div>

            </form>
        </div>
        <!-- .card-block -->
    </div>
    <!-- .card -->
    <!-- End DropzoneJS -->
</div>
<!-- .row -->
</div>

</div>

<!--_______________________________________________MODAL CASH ADVANCE __________________________________________________________-->
<!-- Pop Out Modal -->
<div class="modal fade" id="modal-employee_select_time" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-popout">
        <div class="modal-content">
            <div class="card-header bg-green bg-inverse">
                <h4>Select Employee</h4>
                <ul class="card-actions">
                    <li>
                        <button data-dismiss="modal" type="button"><i class="ion-close"></i></button>
                    </li>
                </ul>
            </div>

            <div class="card-block">
               <table class="table table-bordered table-striped table-vcenter js-dataTable-full" id="tbl_employee_ca">
                <thead>
                    <tr>
                        <td>ID</td>
                        <td>Full Name</td>
                        <td>Company</td>
                        <td>Postion</td>
                        <td>Action</td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include('connection.php');

                    $sql = "SELECT * FROM employee_tbl WHERE status = 'Active'";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                                              // output data of each row
                      while($row = $result->fetch_assoc()) {


                        $sql1 = "SELECT * FROM employee_details WHERE employee_id = '".$row['employee_id']."' ";
                        $result1 = $conn->query($sql1);

                        if ($result1->num_rows > 0) {
                                                      // output data of each row
                          while($row1 = $result1->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>". $row['employee_id'] ."</td>";
                            echo "<td>". $row['employee_first_name']. " " .$row['employee_middle_name']." ".$row['employee_last_name']."</td>";
                            echo "<td>". $row['company'] ."</td>";
                            echo "<td>". $row['position'] ."</td>";
                            echo "<td><button type='button' class='btn btn-success' id='btn_select_employee_time' data-id='".$row['employee_id']."' data-dismiss='modal'>Select</button></td>";
                            echo "</tr>";
                        }
                    }else{
                    }
                }
            }
            ?>
        </tbody>
    </table>
</div>
</div>
</div>
</div>
<!-- End Pop Out Modal -->
<!--End modals -->
<!--_______________________________________________MODAL CASH ADVANCE __________________________________________________________-->

<!--________________________________________________________TIME MANAGEMENT______________________________________________________-->


<!--________________________________________________________PAYSLIP______________________________________________________-->
<div class="tab-pane fade fade-in" id="search-genrate_payslip">

    <div class="b-b m-b-md">
        <h2>GENERATE  <small class="h5 text-muted">PAYSLIP</small></h2>
    </div>

    <div class="card-block">
        <form method="POST" action="payslip_pdf.php" target="_blank">
         <div class="row">
             <div class="col-lg-12">
                 <!-- <select class="form-control" id="company_select" name="company_select">
                    //<?php 
                    // include('functions/retrieve_company_options.php');
                    // ?>
                 </select> -->
                 <input class="form-control" type="text" name="company_select" id="company_select" value="<?php echo $_SESSION['company_name']; ?>" readonly>
             </div>
         </div>
         <br>

         <div class="row">
            <div class="col-lg-6">
                Start Date : <input class="form-control" type="date" name="start_date_payslip" id="start_date_payslip" value="<?php echo date('Y-m-d'); ?>" />  
            </div>
            <div class="col-lg-6">
               End Date : <input class="form-control" type="date" name="end_date_payslip" id="end_date_payslip" value="<?php echo date('Y-m-d'); ?>" />
           </div>
       </div>

       <br>  
       <div class="row">
        <div class="col-lg-12">
            <div class="form-material floating">
                <input class="form-control" type="month" id="payroll_month_payslip" name="payroll_month_payslip" style="text-align: right;" value='<?php echo $curr_month; ?>'>
                <label for="payroll_month_payslip">Month</label>
            </div>
        </div>
    </div>
    <br>
    <div class="form-material floating">
        <select id="payroll_cutoff_payslip" name="payroll_cutoff_payslip" class="form-control">
            <option value="First Half">First Half</option>
            <option value="Second Half">Second Half</option>
        </select>
        <label for="payroll_cutoff_payslip">Cutoff</label>
    </div>
    <br>
    <button class="btn btn-success" id="submit_btn1" name="submit_btn1" style="margin-left: 46%;"><i class="fa fa-file-pdf-o"></i> GENERATE PAYSLIP</button>
</form>

</div>

</div>
<!--________________________________________________________PAYSLIP______________________________________________________-->


<!--________________________________________________________Generate Report_____________________________________________________-->
<div class="tab-pane fade fade-in" id="search-projects">
    <div class="b-b m-b-md">
        <h2>GENERATE <small class="h5 text-muted">REPORT</small></h2>
    </div>


    <div class="col-lg-12">
     <a  href="javascript:void(0)">Report Form</a>
 </div>
 <br>
 <br>

 <!-- DropzoneJS Container -->
 <form method="POST" action='./functions/payroll_pdf.php' target="_blank">
    <div class="form-group">
        <div class="col-sm-12">
            <div class="form-material floating">
                <!-- <select class="form-control" id="select_company" name="select_company">
                    <?php
                //     include('connection.php');
                //     session_start();

                //     $sql = "SELECT * FROM company";
                //     $result = $conn->query($sql);

                //     if ($result->num_rows > 0) {
                //                       // output data of each row
                //       while($row = $result->fetch_assoc()) {
                //         echo "<option value='".$row['company_name']."'>".$row['company_name']."</option>";
                //     }
                // }else{

                // }

                ?>
            </select> -->
            <input type="text" class="form-control" name="select_company" id="select_company" value="<?php echo $company_name; ?>" readonly>
            <label for="select_company">Company</label>
        </div>
        <br>
        <div class="form-material floating">
            <input class="form-control" type="month" id="payroll_month_generate" name="payroll_month_generate" style="text-align: right;" value='<?php echo $curr_month; ?>'>
            <label for="payroll_month_generate">Month</label>
        </div>

        <br>

        <div class="row">
            <div class="col-lg-6">
               Start Date : <input class="form-control" type="date" name="start_date_gen" id="start_date_gen" value="<?php echo date('Y-m-d'); ?>" />  
           </div>
           <div class="col-lg-6">
               End Date : <input class="form-control" type="date" name="end_date_gen" id="end_date_gen" value="<?php echo date('Y-m-d'); ?>" />
           </div>
       </div>
       <br>



       <div class="form-material floating">
        <select id="payroll_cutoff_generate" name="payroll_cutoff_generate" class="form-control">
            <option value="First Half">First Half</option>
            <option value="Second Half">Second Half</option>
        </select>
        <label for="payroll_cutoff_generate">Cutoff</label>
    </div>
    <br>
    <button class="btn btn-success" id="submit_btn1" name="submit_btn1" style="margin-left: 46%;"><i class="fa fa-file-pdf-o"></i> GENERATE PDF</button>
    <!-- <input type="submit" class="btn btn-success" name="submit_btn1" id="submit_btn1" style="margin-left: 46%;" value="GENERATE PDF" /> -->

</div>
</div>
</form>
<br>
<br>
<br>

<div class="row">
    <div class="col-lg-12">
        <?php $val = "Name";?>
        <!-- <iframe src="display_pdf.php" style="width: 1170px;height: 800px;"></iframe> -->
        <table class="table table-bordered" id="payroll_table_generate" style="font-size: 14px; margin-top: 25px;">
            <!-- <table class="table table-bordered table-striped table-vcenter js-dataTable-simple" id='payroll_table'> -->
                <thead>
                    <tr>
                        <td>Employee Name</td>
                        <td># of Days</td>
                        <td>Rate/Day</td>
                        <td>Basic Pay</td>
                        <td>Holiday Pay</td>
                        <td># of OT</td>
                        <td>OT Pay</td>
                        <td>Allowance</td>
                        <td>Total Allowance</td>
                        <td>GROSS</td>
                        <td>PAGIBIG</td>
                        <td>PhilHealth</td>
                        <td>SSS</td>
                        <td># of Late</td>
                        <td>Tardy Pay</td>
                        <td>CA</td>
                        <td>NET Pay</td>
                    </tr>
                </thead>
                <tbody id="payroll_data_generate">
                    <!-- <div id="payroll_data"></div> -->
                </tbody>

            </table>
        </div>

    </div>
    <!-- .row -->


</div>
<!--________________________________________________________Generate Report_____________________________________________________-->






<!--________________________________________________________BIR Report_____________________________________________________-->
<div class="tab-pane fade fade-in" id="search-bir_report">
    <div class="b-b m-b-md">
        <h2>MONTHLY <small class="h5 text-muted">REPORT</small></h2>
    </div>


    <div class="col-lg-12">
     <a  href="javascript:void(0)">Report Form</a>
 </div>
 <br>
 <br>

 <!-- DropzoneJS Container -->
 <form method="POST" action='./functions/payroll_report_bir.php' target="_blank">
    <div class="form-group">
        <div class="col-sm-12">
            <div class="form-material floating">
               <!--  <select class="form-control" id="select_company_bir" name="select_company_bir">
                    <?php
                //     include('connection.php');
                //     session_start();

                //     $sql = "SELECT * FROM company";
                //     $result = $conn->query($sql);

                //     if ($result->num_rows > 0) {
                //                       // output data of each row
                //       while($row = $result->fetch_assoc()) {
                //         echo "<option value='".$row['company_name']."'>".$row['company_name']."</option>";
                //     }
                // }else{

                // }

                ?>
            </select> -->

            <input type="text" class="form-control" name="select_company_bir" id="select_company_bir" value="<?php echo $company_name ?>" readonly>
            <label for="select_company">Company</label>
        </div>
        <br>
        <div class="form-material floating">
            <input class="form-control" type="month" id="payroll_month_bir" name="payroll_month_bir" style="text-align: right;" value='<?php echo $curr_month; ?>'>
            <label for="payroll_month_generate">Month</label>
        </div>

        <br>

        <div class="row">
            <div class="col-lg-6">
               Start Date : <input class="form-control" type="date" name="start_date_bir" id="start_date_bir" value="<?php echo date('Y-m-d'); ?>" />  
           </div>
           <div class="col-lg-6">
               End Date : <input class="form-control" type="date" name="end_date_bir" id="end_date_bir" value="<?php echo date('Y-m-d'); ?>" />
           </div>
       </div>
       <br>
       <button class="btn btn-success" id="submit_btn1" name="submit_btn1" style="margin-left: 46%;"><i class="fa fa-file-pdf-o"></i> GENERATE PDF</button>
       <!-- <input type="submit" class="btn btn-success" name="submit_btn1" id="submit_btn1" style="margin-left: 46%;" value="GENERATE PDF" /> -->

   </div>
</div>
</form>




</div>
<!--________________________________________________________BIR Report_____________________________________________________-->




<!--________________________________________________________Christmas bonus Report_____________________________________________________-->
<div class="tab-pane fade fade-in" id="search-xmas_report">
    <div class="b-b m-b-md">
        <h2>CHRISTMAS BONUS <small class="h5 text-muted">REPORT</small></h2>
    </div>


    <div class="col-lg-12">
     <a  href="javascript:void(0)">Report Form</a>
 </div>
 <br>
 <br>

 <!-- DropzoneJS Container -->
 <form method="POST" action='./functions/xmas_pay_report.php' target="_blank">
    <div class="form-group">
        <div class="col-sm-12">
            <div class="form-material floating">
                <!-- <select class="form-control" id="select_company_xmas" name="select_company_xmas">
                    <?php
                //     include('connection.php');
                //     session_start();

                //     $sql = "SELECT * FROM company";
                //     $result = $conn->query($sql);

                //     if ($result->num_rows > 0) {
                //                       // output data of each row
                //       while($row = $result->fetch_assoc()) {
                //         echo "<option value='".$row['company_name']."'>".$row['company_name']."</option>";
                //     }
                // }else{

                // }

                ?>
            </select> -->
            <input type="text" class="form-control" name="select_company_xmas" id="select_company_xmas" value="<?php echo $company_name; ?>" readonly>
            <label for="select_company">Company</label>
        </div>

        <br>

        <div class="row">
            <div class="col-lg-6">
               Start Date : <input class="form-control" type="month" name="start_date_xmas" id="start_date_xmas" value="<?php echo date('Y-m'); ?>" />  
           </div>
           <div class="col-lg-6">
               End Date : <input class="form-control" type="month" name="end_date_xmas" id="end_date_xmas" value="<?php echo date('Y-m'); ?>" />
           </div>
       </div>
       <br>
       <button class="btn btn-success" id="submit_btn1" name="submit_btn1" style="margin-left: 46%;"><i class="fa fa-file-pdf-o"></i> GENERATE PDF</button>
       <!-- <input type="submit" class="btn btn-success" name="submit_btn1" id="submit_btn1" style="margin-left: 46%;" value="GENERATE PDF" /> -->

   </div>
</div>
</form>




</div>
<!--________________________________________________________Christmas bonus Report_____________________________________________________-->



</div>
</div>
</div>
<!-- End Page Content -->

</main>

</div>
<!-- .app-layout-container -->
</div>
<!-- .app-layout-canvas -->

<!-- Apps Modal -->
<!-- Opens from the button in the header -->
<div id="apps-modal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-sm modal-dialog modal-dialog-top">
        <div class="modal-content">
            <!-- Apps card -->
            <div class="card m-b-0">
                <div class="card-header bg-app bg-inverse">
                    <h4>Apps</h4>
                    <ul class="card-actions">
                        <li>
                            <button data-dismiss="modal" type="button"><i class="ion-close"></i></button>
                        </li>
                    </ul>
                </div>
                <div class="card-block">
                    <div class="row text-center">
                        <div class="col-xs-6">
                            <a class="card card-block m-b-0 bg-app-secondary bg-inverse" href="index.html">
                                <i class="ion-speedometer fa-4x"></i>
                                <p>Admin</p>
                            </a>
                        </div>
                        <div class="col-xs-6">
                            <a class="card card-block m-b-0 bg-app-tertiary bg-inverse" href="frontend_home.html">
                                <i class="ion-laptop fa-4x"></i>
                                <p>Frontend</p>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- .card-block -->
            </div>
            <!-- End Apps card -->
        </div> 
    </div>
</div>
<!-- End Apps Modal -->

<div class="app-ui-mask-modal"></div>

<!-- AppUI Core JS: jQuery, Bootstrap, slimScroll, scrollLock and App.js -->
<script src="assets/js/mousetrap.min.js"></script>
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

<!-- Page JS Mousestrap -->

<script>
    $(document).ready(function(){

        $('a[data-toggle="tab"]').on('show.bs.tab', function(e) {
            localStorage.setItem('activeTab', $(e.target).attr('href'));
        });
        var activeTab = localStorage.getItem('activeTab');
        if(activeTab){
            $('#myTab a[href="' + activeTab + '"]').tab('show');
        }

        Mousetrap.bind('1 6 v . 3 4', function(){
            Swal.fire({
              title: 'Do you want to proceed?',
              showCancelButton: true,
              confirmButtonText: `Proceed`,
              denyButtonText: `Cancel`,
            }).then((result) => {
              /* Read more about isConfirmed, isDenied below */
              if (result.isConfirmed) {
                // Swal.fire('Admin Account Confirm!', '', 'success');
                Swal.fire({
                              position: 'center',
                              icon: 'success',
                              title: "Admin Account Confirmed!",
                              showConfirmButton: false,
                              timer: 1100
                          })
                            setTimeout( 
                              function() {
                                window.location.href = "reports_management.php";
                            }, 1150);
              } else if (result.isDenied) {
                Swal.fire('Canceled!', '', 'info');
              }
            });
        });

// //----------------------------------------------------

$("#employee_tbl").on("click",".contribution_status", function(){
    var employee_id = $(this).data('id');
    var contribution_status = $(this).data('status');
        if(contribution_status == "Yes"){
            var new_status = "No";
        }else{
            var new_status = "Yes";
        }
    // alert(employee_id + " " + contribution_status);

    $.ajax({         
        type: 'POST',                             
        url: './functions/update_contribution_status.php',                  //the script to call to get data          
        data: {
            emp_id : employee_id,
            status : new_status,
        },                              //data format      
        success: function(res)         
        {
        Swal.fire({
              position: 'center',
              icon: 'success',
              title: res,
              showConfirmButton: false,
              timer: 1100
        })
            check_employee_id();
            setTimeout( 
            function() {
                window.location.reload(true);
            }, 1200);
        } 
    });

});

function check_employee_id(){
    var employee_id = $("#employee_id").val();
    if(employee_id == ""){
        $("#employee_details_submit_btn").prop('disabled', true);
    }else{
        $("#employee_details_submit_btn").prop('disabled', false);
    }
}

$("#employee_submit_btn").on("click", function(){
    var employee_id = $("#new_employee_id").val();  
    var finger_id = $("#new_finger_number").val();  
    var first_name = $("#first_name").val(); 
    var middle_name = $("#middle_initial").val(); 
    var last_name = $("#last_name").val(); 
    var company_name = $("#company_name").val(); 
    var position = $("#employee_position").val();
                    // alert("Asdasd");
                    $.ajax({
                        url: "functions/submit_employee.php",
                        type: "POST",
                        data: {
                           employee_id : employee_id,
                           finger_id : finger_id,
                           first_name : first_name,
                           middle_initial : middle_name,
                           last_name : last_name,
                           company_name : company_name,
                           position : position        
                       },
                       success: function(dataResult){

                        Swal.fire({
                          icon: 'success',
                          title: dataResult,
                          showConfirmButton: false,
                          timer: 800
                      });
                        $("#new_employee_id").val("");  
                        $("#new_finger_number").val("");  
                        $("#first_name").val(""); 
                        $("#middle_initial").val(""); 
                        $("#last_name").val(""); 
                        $("#company_name").val("").change(); 
                        $("#employee_position").val("");
                        setTimeout( 
                          function() {
                            window.location.reload(true);
                        }, 500);
                    }
                });
                    

                });


$("#employee_tbl").on("click", ".change_status", function(){
    var emp_id = $(this).data('emp_id');
    var status = $(this).data('status');
    $.ajax({         
          type: 'POST',                             
          url: './functions/update_employee_status.php',                  //the script to call to get data          
          data: {
            emp_id : emp_id,
            status : status,
          },                              //data format      
          success: function(res)         
          {
            Swal.fire({
              position: 'center',
              icon: 'success',
              title: res,
              showConfirmButton: false,
              timer: 500
          })
            check_employee_id();
            setTimeout( 
              function() {
                window.location.reload(true);
            }, 500);
        } 
    });
});

$("#clear_employee_form").on("click", function(){
    $("#new_employee_id").val("");  
    $("#new_finger_number").val("");  
    $("#first_name").val(""); 
    $("#middle_initial").val(""); 
    $("#last_name").val(""); 
    $("#company_name").val(""); 
    $("#employee_position").val(""); 
});

$("#employee_tbl").on("click",".employee_delete_btns",function(){
    var delete_id = $(this).attr("data-delete_id");

    Swal.fire({
      title: 'Are you sure?',
      text: "You won't be able to revert this!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, delete it!'
  }).then((result) => {
      if (result.isConfirmed) {

        $.ajax({         
          type: 'POST',                             
                          url: './functions/delete_employee.php',                  //the script to call to get data          
                          data: {
                            delete_id : delete_id
                          },                              //data format      
                          success: function(res)         
                          {
                            Swal.fire({
                              position: 'center',
                              icon: 'success',
                              title: res,
                              showConfirmButton: false,
                              timer: 500
                          })
                            check_employee_id();
                            setTimeout( 
                              function() {
                                window.location.reload(true);
                            }, 500);
                        } 
                    });



    }
});


});

$("#employee_tbl").on("click",".employee_edit_btns", function(e){
    e.preventDefault();
    var edit_btns = $(this).attr("data-edit_id");
                    // alert(edit_btns);
                    $.ajax({         
                      type: 'GET',                             
                          url: './functions/retrieve_employee.php',                  //the script to call to get data          
                          data: {
                            edit_id : edit_btns
                        },                             
                          dataType: 'json',               //data format      
                          success: function(res)         
                          {
                            $("#new_employee_id").val(res.employee_id);  
                            $("#new_finger_number").val(res.fingerprint);  
                            $("#first_name").val(res.first_name); 
                            $("#middle_initial").val(res.middle_name); 
                            $("#last_name").val(res.last_name); 
                            $("#company_name").val(res.company); 
                            $("#employee_position").val(res.position); 
                            check_employee_id(); 
                        } 
                    });
                });

$("#tbl_employee_details").on("click",".edit_btn",function(){
    var edit_id = $(this).attr("data-id");
                    // alert("asdasd");
                    $.ajax({         
                      type: 'GET',                             
                          url: './functions/retrieve_employee_details.php',                  //the script to call to get data          
                          data: {
                            edit_id : edit_id
                        },                             
                          dataType: 'json',               //data format      
                          success: function(res)         
                          {
                            $("#employee_update_id").val(res.update_id);  
                            $("#employee_id").val(res.employee_id);  
                            $("#employee_name").val(res.full_name); 
                            $("#employee_rate").val(res.rate); 
                            $("#allowance").val(res.allowance); 
                            check_employee_id(); 
                        } 
                    });


                });


$("#tbl_employee_details").on("click",".delete_btn",function(){
    var delete_id = $(this).attr("data-id");

    Swal.fire({
      title: 'Are you sure?',
      text: "You won't be able to revert this!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, delete it!'
  }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({         
          type: 'POST',                             
                          url: './functions/delete_employee_details.php',                  //the script to call to get data          
                          data: {
                            delete_id : delete_id
                          },                              //data format      
                          success: function(res)         
                          {
                            Swal.fire({
                              position: 'center',
                              icon: 'success',
                              title: res,
                              showConfirmButton: false,
                              timer: 500
                          })
                            check_employee_id();
                            setTimeout( 
                              function() {
                                window.location.reload(true);
                            }, 500);
                        } 
                    });
    }
})


});


check_employee_id();
$("#employee_details_submit_btn").on("click",function(){
    var update_id = $("#employee_update_id").val();
    var employee_id = $("#employee_id").val();
    var employee_name = $("#employee_name").val();
    var employee_rate = $("#employee_rate").val();
    var allowance = $("#allowance").val();
                    // alert(employee_id + "\n" + employee_name + "\n" + employee_rate + "\n" + allowance);

                    $.ajax({
                        url: "functions/submit_employee_details.php",
                        type: "POST",
                        data: {
                            update_id: update_id,
                            employee_id: employee_id,
                            employee_name: employee_name,
                            employee_rate: employee_rate,
                            allowance : allowance        
                        },
                        success: function(dataResult){

                            Swal.fire({
                              icon: 'success',
                              title: dataResult,
                              showConfirmButton: false,
                              timer: 800
                          });
                            $("#employee_update_id").val("");  
                            $("#employee_id").val("");  
                            $("#employee_name").val(""); 
                            $("#employee_rate").val(""); 
                            $("#allowance").val("");
                            check_employee_id();
                            setTimeout( 
                              function() {
                                window.location.reload(true);
                            }, 500);
                        }
                    });

                });

$("#clear_form").on("click",function(){
    $("#employee_update_id").val("");  
    $("#employee_id").val("");  
    $("#employee_name").val(""); 
    $("#employee_rate").val(""); 
    $("#allowance").val(""); 
    check_employee_id();
});


$("#tbl_employee").on("click",".btn_select_employee",function(){
    var emp_id = $(this).attr("data-id");

    $.ajax({         
      type: 'GET',                             
                          url: './functions/retrieve_selected_employee.php',                  //the script to call to get data          
                          data: {
                            emp_id : emp_id
                        },                             
                          dataType: 'json',               //data format      
                          success: function(res)         
                          {
                            $("#employee_id").val(res.employee_id);  
                            $("#employee_name").val(res.full_name); 
                            $("#employee_update_id").val("");
                            check_employee_id(); 
                        } 
                    });
});

//--------------------Payroll Form-------------------------------------------------------------------------------------------
$("#working_hours_tbl").on("click",".delete_btnsss",function(){
    var delete_id = $(this).attr('data-id');
                    // alert(delete_id);


                    Swal.fire({
                      title: 'Are you sure?',
                      text: "You won't be able to revert this!",
                      icon: 'warning',
                      showCancelButton: true,
                      confirmButtonColor: '#3085d6',
                      cancelButtonColor: '#d33',
                      confirmButtonText: 'Yes, delete it!'
                  }).then((result) => {
                      if (result.isConfirmed) {
                        $.ajax({         
                          type: 'POST',                             
                          url: './functions/delete_working_hours.php',                  //the script to call to get data          
                          data: {
                            delete_id : delete_id
                          },                              //data format      
                          success: function(res)         
                          {
                            Swal.fire({
                              position: 'center',
                              icon: 'success',
                              title: res,
                              showConfirmButton: false,
                              timer: 500
                          }).then((result) => {
                              /* Read more about isConfirmed, isDenied below */ 
                              setTimeout( 
                                  function() {
                                    window.location.reload(true);
                                }, 300);
                          });
                      } 
                  });
                    }
                })

              });

$("#working_hours_tbl").on("click",".edit_btnsss", function(){
    var id = $(this).attr('data-id');
                    // alert(id);
                    $.ajax({         
                      type: 'GET',                             
                          url: './functions/retrieve_selected_working_hours.php',                  //the script to call to get data          
                          data: {
                            id : id
                        },                             
                          dataType: 'json',               //data format      
                          success: function(res)         
                          {
                            $("#working_hours_id").val(res.id);
                            $("#cutoff").val(res.cutoff);
                            $("#payroll_month").val(res.month);
                            $("#working_employee_idsss").val(res.emp_id);
                            $("#number_of_days").val(res.num_days);
                            $("#holiday_pay").val(res.holiday_pay);
                            $("#number_of_ot").val(res.num_ot);
                            $("#number_of_late").val(res.num_late);
                            $("#basic_pay").val(res.basic_pay);
                            check_form();                     
                        } 
                    });


                });


$("#tbl_employeess").on("click",".btn_select_employeesss",function(){
    var emp_id = $(this).attr("data-id");
    $.ajax({         
      type: 'GET',                             
                          url: './functions/retrieve_selected_employee.php',                  //the script to call to get data          
                          data: {
                            emp_id : emp_id
                        },                             
                          dataType: 'json',               //data format      
                          success: function(res)         
                          {
                            $("#working_employee_idsss").val(res.employee_id);
                            check_form();                     
                        } 
                    });
});

$("#clear_btnsss").on("click", function(){

    $("#working_hours_id").val('');
    $('#cutoff').prop('selectedIndex',0);
    $("#payroll_month").val('<?php echo date("Y-m");?>');
    $("#working_employee_idsss").val('');
    $("#number_of_days").val('');
    $("#holiday_pay").val('');
    $("#number_of_ot").val('');
    $("#number_of_late").val('');
    $("#basic_pay").val('');
    check_form();


});


check_form();
function check_form(){
    var cutoff = $("#cutoff").val();
    var payroll_month = $("#payroll_month").val();
    var employee_idsss = $("#working_employee_idsss").val();
    var number_of_days = $("#number_of_days").val();
    var holiday_pay = $("#holiday_pay").val();
    var number_of_ot = $("#number_of_ot").val();
    var number_of_late = $("#number_of_late").val();
    var basic_pay = $("#basic_pay").val();

    if(employee_id == '' || number_of_days == '' || holiday_pay == '' || number_of_ot == '' || number_of_late == ''){
        $("#submit_btn").prop('disabled', true);
    }else{
        $("#submit_btn").prop('disabled', false);
    }
}



$("#cutoff").on("change", function(){
    check_form();
});

$("#payroll_month").on("change", function(){
    check_form();
});

$("#number_of_days").on("keyup", function(){
    check_form();
});

$("#holiday_pay").on("keyup", function(){
    check_form();
});

$("#number_of_ot").on("keyup", function(){
    check_form();
});

$("#number_of_late").on("keyup", function(){
    check_form();
});


$("#submit_btnsss").on("click", function(){
// $("#number_of_days").on("change", function(){
    var working_hours_id = $("#working_hours_id").val();
    var cutoff = $("#cutoff").val();
    var payroll_month = $("#payroll_month").val();
    var employee_idsss = $("#working_employee_idsss").val();
    var number_of_days = $("#number_of_days").val();
    var holiday_pay = $("#holiday_pay").val();
    var number_of_ot = $("#number_of_ot").val();
    var number_of_late = $("#number_of_late").val();
    var basic_pay = $("#basic_pay").val();

    $.ajax({         
      type: 'POST',                             
          url: './functions/compute_payroll_form.php',                  //the script to call to get data          
          data: {
           working_hours_id : working_hours_id,
           cutoff : cutoff,
           payroll_month : payroll_month,
           employee_idsss : employee_idsss,
           number_of_days : number_of_days,
           holiday_pay : holiday_pay,
           number_of_ot : number_of_ot,
           number_of_late : number_of_late,        
           basic_pay : basic_pay,
       },                             
          dataType: 'json',               //data format      
          success: function(res)         
          {
            var ot_pay = res.ot_pay;
            var total_allowance = res.total_allowance;
            var gross = res.gross;
            var pagibig_ee = res.pagibig_ee;
            var pagibig_er = res.pagibig_er;
            var sss_ee = res.sss_ee;
            var sss_er = res.sss_er;
            var philhealth_ee = res.philhealth_ee;
            var philhealth_er = res.philhealth_er;
            var tardy_pay = res.tardy_pay;
            var net_pay = res.net_pay;
            // console.log(res);
            // alert(res.basic_pay + "\n" + holiday_pay + "\n" + res.ot_pay + "\n" + res.total_allowance + "\n" + basic_pay + "\n" + res.gross + "\n" + gross); 
            // alert(res.gross);

                $.ajax({
                    url: "functions/submit_working_hours.php",
                    type: "POST",
                    data: {
                       working_hours_id : working_hours_id,
                       cutoff : cutoff,
                       payroll_month : payroll_month,
                       employee_idsss : employee_idsss,
                       number_of_days : number_of_days,
                       holiday_pay : holiday_pay,
                       number_of_ot : number_of_ot,
                       number_of_late : number_of_late,        
                       basic_pay : basic_pay,        
                       ot_pay : ot_pay,        
                       total_allowance : total_allowance,        
                       gross : gross,        
                       pagibig_ee : pagibig_ee,        
                       pagibig_er : pagibig_er,        
                       sss_ee : sss_ee,        
                       sss_er : sss_er,        
                       philhealth_ee : philhealth_ee,        
                       philhealth_er : philhealth_er,        
                       tardy_pay : tardy_pay,        
                       net_pay : net_pay,        
                   },
                   success: function(dataResult){

                    Swal.fire({
                      icon: 'success',
                      title: dataResult,
                      showConfirmButton: false,
                      timer: 800
                  }).then((result) => {
                       // Read more about isConfirmed, isDenied below  
                      setTimeout( 
                          function() {
                                // alert("Asdasd");
                                window.location.reload(true);
                            }, 500);
                  });
              }
          });

        } 
    });


});

$("#number_of_days").on("keyup", function(){
    var num_days = $("#number_of_days").val();
    var employee_idsss = $("#working_employee_idsss").val();
    $.ajax({         
      type: 'POST',                             
                          url: './functions/compute_basic_pay.php',                  //the script to call to get data          
                          data: {
                            num_days : num_days,
                            employee_idsss : employee_idsss,
                        },                             
                          dataType: 'json',               //data format      
                          success: function(res)         
                          {
                            var basic_p = parseFloat(res.basic_pay).toFixed(2)
                            $("#basic_pay").val(basic_p);
                            // $("#basic_pay").val(res.basic_pay);
                            check_form();                       
                        } 
                    });
});

//--------------------Payroll Form-------------------------------------------------------------------------------------------


//--------------------Cash Advance-------------------------------------------------------------------------------------------


$("#working_hours_tbl_ca").on("click",".delete_btn_ca", function(){
    var delete_id = $(this).attr('data-id');


    Swal.fire({
      title: 'Are you sure?',
      text: "You won't be able to revert this!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, delete it!'
  }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({         
          type: 'POST',                             
                          url: './functions/delete_cash_advance.php',                  //the script to call to get data          
                          data: {
                            delete_id : delete_id
                          },                              //data format      
                          success: function(res)         
                          {
                            Swal.fire({
                              position: 'center',
                              icon: 'success',
                              title: res,
                              showConfirmButton: false,
                              timer: 500
                          }).then((result) => {
                              /* Read more about isConfirmed, isDenied below */ 
                              setTimeout( 
                                  function() {
                                    // alert(delete_id);
                                    window.location.reload(true);
                                }, 300);
                          });
                      } 
                  });
    }
})

});


$("#working_hours_tbl_ca").on("click",".edit_btn_ca", function(){
    var id = $(this).attr('data-id');
                    // alert(id);
                    $.ajax({         
                      type: 'GET',                             
                          url: './functions/retrieve_selected_cash_adv.php',                  //the script to call to get data          
                          data: {
                            id : id
                        },                             
                          dataType: 'json',               //data format      
                          success: function(res)         
                          {
                            $("#working_hours_id_ca").val(res.id);
                            $("#cutoff_ca").val(res.cutoff);
                            $("#payroll_month_ca").val(res.month);
                            $("#employee_id_ca").val(res.emp_id);
                            $("#number_of_days_ca").val(res.amount);
                            check_form();                     
                        } 
                    });
                });


$("#tbl_employee_ca").on("click",".btn_select_employee_ca",function(){
    var emp_id = $(this).attr("data-id");
    $.ajax({         
      type: 'GET',                             
                          url: './functions/retrieve_selected_employee.php',                  //the script to call to get data          
                          data: {
                            emp_id : emp_id
                        },                             
                          dataType: 'json',               //data format      
                          success: function(res)         
                          {
                            $("#employee_id_ca").val(res.employee_id);
                            check_form();                     
                        } 
                    });
});

$("#clear_btn_ca").on("click", function(){

    $("#working_hours_id_ca").val('');
    $('#cutoff_ca').prop('selectedIndex',0);
    $("#payroll_month_ca").val('<?php echo date("Y-m");?>');
    $("#employee_id_ca").val('');
    $("#number_of_days_ca").val('');
    $("#holiday_pay_ca").val('');
    $("#number_of_ot_ca").val('');
    $("#number_of_late_ca").val('');
    check_form();


});


check_form();
function check_form(){
    var cutoff = $("#cutoff_ca").val();
    var payroll_month = $("#payroll_month_ca").val();
    var employee_id = $("#employee_id_ca").val();
    var number_of_days = $("#number_of_days_ca").val();
    var holiday_pay = $("#holiday_pay_ca").val();
    var number_of_ot = $("#number_of_ot_ca").val();
    var number_of_late = $("#number_of_late_ca").val();

    if(employee_id == '' || number_of_days == '' || holiday_pay == '' || number_of_ot == '' || number_of_late == ''){
        $("#submit_btn_ca").prop('disabled', true);
    }else{
        $("#submit_btn_ca").prop('disabled', false);
    }
}



$("#cutoff_ca").on("change", function(){
    check_form();
});

$("#payroll_month_ca").on("change", function(){
    check_form();
});

$("#number_of_days_ca").on("keyup", function(){
    check_form();
});


$("#submit_btn_ca").on("click", function(){
    var working_hours_id = $("#working_hours_id_ca").val();
    var cutoff = $("#cutoff_ca").val();
    var payroll_month = $("#payroll_month_ca").val();
    var employee_id = $("#employee_id_ca").val();
    var amount = $("#number_of_days_ca").val();
                    // alert("Asdasd");
                    $.ajax({
                        url: "functions/submit_cash_adv.php",
                        type: "POST",
                        data: {
                            working_hours_id : working_hours_id,
                            cutoff : cutoff,
                            payroll_month : payroll_month,
                            employee_id : employee_id,
                            number_of_days : amount       
                        },
                        success: function(dataResult){

                            Swal.fire({
                              icon: 'success',
                              title: dataResult,
                              showConfirmButton: false,
                              timer: 800
                          }).then((result) => {
                              /* Read more about isConfirmed, isDenied below */ 
                              setTimeout( 
                                  function() {
                                    window.location.reload(true);
                                }, 500);
                          });
                      }
                  });
                    

                });



//--------------------Cash Advance-------------------------------------------------------------------------------------------
//--------------------Time Management----------------------------------------------------------------------------------------
check_time_table();
function check_time_table(){
    var start_date = $("#start_date").val();
    var end_date = $("#end_date").val();
    $.ajax({         
      type: 'POST',                             
          url: './functions/retrieve_time_table.php',                  //the script to call to get data          
          data: {
            start_date : start_date,
            end_date : end_date
          },                              //data format      
          success: function(res)         
          {
    // alert(end_date);
    $("#reloadingg").html(res);       
} 
});
}
$("#start_date").on("change",function(){
    check_time_table();
    addRowHandlers();
});
$("#end_date").on("change",function(){
    check_time_table();
    addRowHandlers();
});

$("#tbl_employee_ca #btn_select_employee_time").on("click",function(){
    var emp_id = $(this).attr("data-id");
    $.ajax({         
      type: 'GET',                             
          url: './functions/retrieve_selected_employee.php',                  //the script to call to get data          
          data: {
            emp_id : emp_id
        },                             
          dataType: 'json',               //data format      
          success: function(res)         
          {
            $("#employee_id_time").val(res.employee_id);
            $("#employee_name_time").val(res.full_name);
            check_form();                     
        } 
    });
});
function check_time_form(){
    var employee_id = $("#employee_id_time").val();
    if(employee_id == ""){
        $("#submit_employee_time").prop('disabled', true);
    }else{
        $("#submit_employee_time").prop('disabled', false);
    }
}
check_time_form();

function addRowHandlers() {
    var table = document.getElementById("tbl_employee_time");
    var rows = table.getElementsByTagName("tr");
    for (i = 0; i < rows.length; i++) {
        var currentRow = table.rows[i];
        var createClickHandler = 
        function(row) 
        {
            return function() { 
                var cell = row.getElementsByTagName("td")[0];
                var id = cell.innerHTML;
                alert("id:" + id);
            };
        };

        currentRow.onclick = createClickHandler(currentRow);
    }
}
window.onload = addRowHandlers();


// $("#reloading #edit_time").on("click",function(e) {
//     e.preventDefault();
//     var time_id = $(this).attr("data-time_id");
//     alert("time_id");
//         // $.ajax({         
//         //   type: 'GET',                             
//         //   url: './functions/retrieve_time_input.php',                  //the script to call to get data          
//         //   data: {
//         //     id : time_id
//         //   },                             
//         //   dataType: 'json',               //data format      
//         //   success: function(res)         
//         //   {


//         //   } 
//         // });
// });
function test_click(){
    alert("Asd");
}

//--------------------Time Management----------------------------------------------------------------------------------------
//--------------------GENERATE PDF-------------------------------------------------------------------------------------------
function retrieve_table_data(){
    var select_company = $('#select_company').val();
    var payroll_month = $('#payroll_month_generate').val();
    var payroll_cutoff = $('#payroll_cutoff_generate').val();
    $.ajax({
        url: "functions/retrieve_payroll_table_data.php",
        type: "POST",
        data: {
           payroll_month : payroll_month,
           payroll_cutoff : payroll_cutoff,
           select_company : select_company
       },
       success: function(dataResult){
           $("#payroll_data_generate").html(dataResult);
       }
   });

}
retrieve_table_data();
$('#payroll_cutoff_generate').on('change',function(){
    retrieve_table_data();
});

$('#payroll_month_generate').on('change',function(){
    retrieve_table_data();
}); 

$('#select_company').on('change',function(){
    retrieve_table_data();
}); 
//--------------------GENERATE PDF-------------------------------------------------------------------------------------------
});
</script>

</body>

</html>