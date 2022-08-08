<?php
session_start();

?>

<!DOCTYPE html>
<style type="text/css">
    .active {
        background-color: white;
    }

   
</style>
<html class="app-ui">

    <head>
        <!-- Meta -->
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />

        <!-- Document title -->
        <title>Payroll System &ndash; Employee Details | AppUI</title>

        <meta name="description" content="AppUI - Admin Dashboard Template & UI Framework" />
        <meta name="author" content="rustheme" />
        <meta name="robots" content="noindex, nofollow" />

      <!-- Favicons -->
        <link rel="apple-touch-icon" href="assets/img/favicons/apple-touch-icon.png" />
        <link rel="icon" href="assets/img/favicons/favicon.ico" />

        <!-- Google fonts -->
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:300,400,400italic,500,900%7CRoboto+Slab:300,400%7CRoboto+Mono:400" />

        <!-- Page JS Plugins CSS -->
        <link rel="stylesheet" href="assets/js/plugins/bootstrap-datepicker/bootstrap-datepicker3.min.css" />
        <link rel="stylesheet" href="assets/js/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css" />
        <link rel="stylesheet" href="assets/js/plugins/select2/select2.min.css" />
        <link rel="stylesheet" href="assets/js/plugins/select2/select2-bootstrap.css" />
        <link rel="stylesheet" href="assets/js/plugins/dropzonejs/dropzone.min.css" />
        <link rel="stylesheet" href="assets/js/plugins/jquery-tags-input/jquery.tagsinput.min.css" />

        <!-- AppUI CSS stylesheets -->
        <link rel="stylesheet" id="css-font-awesome" href="assets/css/font-awesome.css" />
        <link rel="stylesheet" id="css-ionicons" href="assets/css/ionicons.css" />
        <link rel="stylesheet" id="css-bootstrap" href="assets/css/bootstrap.css" />
        <link rel="stylesheet" id="css-app" href="assets/css/app.css" />
        <link rel="stylesheet" id="css-app-custom" href="assets/css/app-custom.css" />
        <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.min.css'>

        <!-- Page JS Plugins CSS -->
        <link rel="stylesheet" href="assets/js/plugins/datatables/jquery.dataTables.min.css" />
        <!-- End Stylesheets -->
    </head>

    <body class="app-ui layout-has-drawer layout-has-fixed-header">
        <div class="app-layout-canvas">
            <div class="app-layout-container">

                <!-- Drawer -->
                <aside class="app-layout-drawer" style="background-color: #0665ff;">

                    <!-- Drawer scroll area -->
                    <div class="app-layout-drawer-scroll">
                        <!-- Drawer logo -->
                        <div id="logo" class="drawer-header">
                            <a href="index.php"><img class="img-responsive" src="assets/img/logo/BasicLogo.png" style="margin-left: 20%;margin-top: 5%;width: 130px;" title="AppUI" alt="AppUI" /></a>
                        </div>

                        <!-- Drawer navigation -->
                        <nav class="drawer-main">
                            <ul class="nav nav-drawer">

                                <li class="nav-item nav-item-has-subnav open">
                                    <a href="javascript:void(0)"><i class="ion-ios-speedometer-outline"></i> Dashboard</a>
                                    <ul class="nav nav-subnav">

                                        <li style="color:#ffffff;">
                                            <a href="index.php">File Upload</a>
                                        </li>

                                        <li style="color:#ffffff;">
                                            <a href="employee_time_management.php">Employee Time Management</a>
                                        </li>
                                        <li class="active">
                                            <a href="employee_management.php">Employee Management</a>
                                        </li>

                                        <li style="color:#ffffff;">
                                            <a href="payroll_form.php">Payroll Form</a>
                                        </li>

                                    </ul>
                                </li>


                            </ul>
                        </nav>
                        <!-- End drawer navigation -->

                        <div class="drawer-footer" style="position: absolute;margin-left: 2%;margin-bottom: -15%;">
                            <p class="copyright">Basic Frames & Photography</p>
                        </div>
                    </div>
                    <!-- End drawer scroll area -->
                </aside>
                <!-- End drawer -->

                <!-- Header -->
                <header class="app-layout-header">
                    <nav class="navbar navbar-default">
                        <div class="container-fluid">
                            <div class="navbar-header">
                                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#header-navbar-collapse" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                                <button class="pull-left hidden-lg hidden-md navbar-toggle" type="button" data-toggle="layout" data-action="sidebar_toggle">
                    <span class="sr-only">Toggle drawer</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                                <span class="navbar-page-title">
                    
                    Payroll System &ndash; Employee Details
                </span>
                            </div>

                            
                        </div>
                        <!-- .container-fluid -->
                    </nav>
                    <!-- .navbar-default -->
                </header>
                <!-- End header -->

                <main class="app-layout-content">

                    <!-- Page Content -->
                    <div class="container-fluid p-y-md">
                       


                        <!-- DropzoneJS and Tags Input -->
                        <div class="row">
                            <div class="col-lg-8">
                                <h2><b>Employee Details Table</b></h2>
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

                                    $sql = "SELECT * FROM employee_details ";
                                        $result = $conn->query($sql);

                                        if ($result->num_rows > 0) {
                                              // output data of each row
                                            while($row = $result->fetch_assoc()) {
                                                $emp_id = $row['employee_id'];

                                                $sql1 = "SELECT * FROM employee_tbl WHERE employee_id = '$emp_id'";
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
                                                        <button class='btn btn-primary' id='edit_btn' data-id='".$row['employee_id']."'><i class='fa fa-pencil'></i></button>
                                                        <button class='btn btn-danger' id='delete_btn' data-id='".$row['employee_id']."'><i class='fa fa-trash'></i></button>
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
                                        <h4>Employee Details Form</h4>
                                        
                                               <button class="btn btn-primary" style="margin-left: 60%;" type="button" data-toggle="modal" data-target="#modal-employee_select"><i class="fa fa-user"></i></button>
                                            
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


                        <div class="row">
                            <div class="col-lg-8">
                                <h2><b>Employee Table</b></h2>
                                <table class="table table-bordered table-striped table-vcenter js-dataTable-full" id="employee_tbl">
                                    <thead>
                                        <tr>
                                            <td>Employee ID</td>
                                            <td>Fingerprint</td>
                                            <td>Full Name</td>
                                            <td>Company</td>
                                            <td>Position</td>
                                            <td>Action</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        include('connection.php');
                                         $sql = "SELECT * FROM employee_tbl";
                                        $result = $conn->query($sql);

                                        if ($result->num_rows > 0) {
                                              // output data of each row
                                            while($row = $result->fetch_assoc()) {
                                                echo "<tr>";
                                                echo "<td>".$row['employee_id']."</td>";
                                                echo "<td>".$row['finger_id']."</td>";
                                                echo "<td>".$row['employee_first_name']." ".$row['employee_middle_name']." ".$row['employee_last_name']."</td>";
                                                echo "<td>".$row['company']."</td>";
                                                echo "<td>".$row['position']."</td>";
                                                echo "<td>
                                                <button type='button' class='btn btn-primary' id='employee_edit_btns' data-edit_id='".$row['employee_id']."'><i class='fa fa-pencil'></i></button>
                                                <button type='button' class='btn btn-danger' id='employee_delete_btns' data-delete_id='".$row['employee_id']."'><i class='fa fa-trash'></i></button>
                                                </td>";
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
                                        <h4>Employee Form</h4>
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
                                                        <input class="form-control" type="text" id="middle_initial" name="middle_initial" style="text-align: right;" maxlength="1">
                                                        <label for="middle_initial">Middle Initial</label>
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
                                                        <select class="form-control" id="company_name" name="company_name">
                                                            <option></option>
                                                            <?php 
                                                            include('connection.php');

                                                            $sql = "SELECT * FROM company";
                                                            $result = $conn->query($sql);

                                                            if ($result->num_rows > 0) {
                                                              // output data of each row
                                                              while($row = $result->fetch_assoc()) {
                                                                echo "<option value='".$row['company_name']."'>". $row['company_name']."</option>";
                                                              }
                                                            }
                                                            ?>
                                                        </select>

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
                    <!-- End Page Content -->


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

                                        $sql = "SELECT * FROM employee_tbl ";
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
                                                    echo "<td><button type='button' class='btn btn-success' id='btn_select_employee' data-id='".$row['employee_id']."' data-dismiss='modal'>Select</button></td>";
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

                $("#clear_employee_form").on("click", function(){
                    $("#new_employee_id").val("");  
                    $("#new_finger_number").val("");  
                    $("#first_name").val(""); 
                    $("#middle_initial").val(""); 
                    $("#last_name").val(""); 
                    $("#company_name").val("").change(); 
                    $("#employee_position").val(""); 
                });

                $("#employee_tbl #employee_delete_btns").on("click", function(){
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

                $("#employee_tbl #employee_edit_btns").on("click", function(e){
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
                            $("#company_name").val(res.company).change(); 
                            $("#employee_position").val(res.position); 
                            check_employee_id(); 
                          } 
                    });
                });

                $("#tbl_employee_details #edit_btn").on("click",function(){
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


                $("#delete_btn").on("click",function(){
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


                $("#tbl_employee #btn_select_employee").on("click",function(){
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



            }); //$(document).ready(function(){
        </script>
    </body>

</html>