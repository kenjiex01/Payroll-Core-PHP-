<?php
session_start();
date_default_timezone_set('Asia/Manila');
$_SESSION['user_id'] = "1";

$curr_month = date("Y-m");

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
        <title>Payroll System &ndash; Index | AppUI</title>

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
                            <a href="index.html"><img class="img-responsive" src="assets/img/logo/BasicLogo.png" style="margin-left: 20%;margin-top: 5%;width: 130px;" title="AppUI" alt="AppUI" /></a>
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

                                        <li style="color:#ffffff;">
                                            <a href="employee_management.php">Employee Management</a>
                                        </li>

                                        <li class="active">
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
                    
                    Payroll System &ndash; Index
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
                       

                        <div class="row">
                            <div class="col-lg-6">
                                <!-- DropzoneJS -->
                                <!-- For more info and examples please check http://www.dropzonejs.com/#usage -->
                                <div class="card">
                                    <div class="card-block card-block-full">
                                <h2 class="section-title">Generate Report</h2>
                                        <!-- DropzoneJS Container -->
                                        <form method="POST" action='./functions/payroll_pdf.php'>
                                       <div class="form-group">
                                            <div class="col-sm-12">
                                                <div class="form-material floating">
                                                    <input class="form-control" type="month" id="payroll_month_generate" name="payroll_month_generate" style="text-align: right;" value='<?php echo $curr_month; ?>'>
                                                        <label for="payroll_month_generate">Month</label>
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
                                                <input type="submit" name="submit_btn1" id="submit_btn1" />

                                            </div>
                                        </div>
                                        </form>
                                                <br>
                                                <br>
                                                <br>
                                                <br>
                                                <br>
                                                <br>
                                                <br>
                                                <br>

                                    </div>
                                    <!-- .card-block -->
                                </div>
                                <!-- .card -->
                                <!-- End DropzoneJS -->
                            </div>
                            <!-- .col-lg-6 -->
                        </div>
                        <!-- DropzoneJS and Tags Input -->
                        <div class="row">
                            <div class="col-lg-12">
                                <?php $val = "Name";?>
                                <!-- <iframe src="display_pdf.php" style="width: 1170px;height: 800px;"></iframe> -->
                                <table class="table table-bordered" id="payroll_table_generate">
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
                                            <td>SSS</td>
                                            <td>PhilHealth</td>
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
                    <!-- End Page Content -->

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
                                   <table class="table table-bordered table-striped table-vcenter js-dataTable-full" id="tbl_employee_generate">
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
                                                    echo "<tr>";
                                                    echo "<td>". $row['employee_id'] ."</td>";
                                                    echo "<td>". $row['employee_first_name']. " " .$row['employee_middle_name']." ".$row['employee_last_name']."</td>";
                                                    echo "<td>". $row['company'] ."</td>";
                                                    echo "<td>". $row['position'] ."</td>";
                                                    echo "<td><button type='button' class='btn btn-success' id='btn_select_employee' data-id='".$row['employee_id']."' data-dismiss='modal'>Select</button></td>";
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

                $('#payroll_cutoff_generate').on('change',function(){
                    retrieve_table_data();
                });

                $('#payroll_month_generate').on('change',function(){
                    retrieve_table_data();
                });                

                function retrieve_table_data(){
                    var payroll_month = $('#payroll_month_generate').val();
                    var payroll_cutoff = $('#payroll_cutoff_generate').val();
                    $.ajax({
                        url: "functions/retrieve_payroll_table_data.php",
                        type: "POST",
                        data: {
                           payroll_month : payroll_month,
                           payroll_cutoff : payroll_cutoff
                        },
                        success: function(dataResult){
                               $("#payroll_data_generate").html(dataResult);
                        }
                    });

                }
                retrieve_table_data();

                $("#working_hours_tbl #delete_btn").on("click", function(){
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


                $("#working_hours_tbl #edit_btn").on("click", function(){
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
                            $("#working_hours_id").val(res.id);
                            $("#cutoff").val(res.cutoff);
                            $("#payroll_month").val(res.month);
                            $("#employee_id").val(res.emp_id);
                            $("#number_of_days").val(res.amount);
                            check_form();                     
                          } 
                        });


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
                            check_form();                     
                          } 
                        });
                });

                $("#clear_btn").on("click", function(){

                    $("#working_hours_id").val('');
                    $('#cutoff').prop('selectedIndex',0);
                    $("#payroll_month").val('<?php echo date("Y-m");?>');
                    $("#employee_id").val('');
                    $("#number_of_days").val('');
                    $("#holiday_pay").val('');
                    $("#number_of_ot").val('');
                    $("#number_of_late").val('');
                    check_form();


                });


                check_form();
                function check_form(){
                    var cutoff = $("#cutoff").val();
                    var payroll_month = $("#payroll_month").val();
                    var employee_id = $("#employee_id").val();
                    var number_of_days = $("#number_of_days").val();
                    var holiday_pay = $("#holiday_pay").val();
                    var number_of_ot = $("#number_of_ot").val();
                    var number_of_late = $("#number_of_late").val();
                    
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


                $("#submit_btn").on("click", function(){
                    var working_hours_id = $("#working_hours_id").val();
                    var cutoff = $("#cutoff").val();
                    var payroll_month = $("#payroll_month").val();
                    var employee_id = $("#employee_id").val();
                    var amount = $("#number_of_days").val();
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



            });
        </script>

    </body>

</html>