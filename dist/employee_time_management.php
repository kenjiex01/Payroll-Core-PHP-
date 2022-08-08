<?php
session_start();
include('connection.php'); 
if(isset($_GET['edit_id'])){
    $_SESSION['edit_id'] = $_GET['edit_id'];
    include('retrieve_time_table_edit.php');
    $edit_id = $_GET['edit_id'];
}
else{
    $edit_id = "";
    $employee_id = "";
    $employee_full_name = "";
    $employee_date = "";
    $employee_time = "";
}

if(isset($_SESSION['edit_id'])){
    $edit_id = $_SESSION['edit_id'];
    $emp_id = $_SESSION['employee_id'];
    $full_name = $_SESSION['full_name'];
    $date_in_out = $_SESSION['date_in_out'];
    $time_in_out = $_SESSION['time_in_out'];
}else{
     $edit_id = "";
    $emp_id = "";
    $full_name = "";
    $date_in_out = date("Y-m-d");
    $time_in_out = "";
}


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
        <title>Payroll System &ndash; Employee Time Management | AppUI</title>

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

        <!-- Page JS Plugins CSS -->
        <link rel="stylesheet" href="assets/js/plugins/datatables/jquery.dataTables.min.css" />

        <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.min.css'>
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

                                        <li  class="active">
                                            <a href="employee_time_management.php">Employee Time Management</a>
                                        </li>

                                        <li style="color:#ffffff;">
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
                    
                    Payroll System &ndash; Employee Time Management
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

                                <table class="table table-bordered table-striped table-vcenter js-dataTable-full" style="text-align: center;">
                                    <thead>
                                        <td>Employee ID</td>
                                        <td>Employee Name</td>
                                        <td>Date</td>
                                        <td>Time</td>
                                        <td>Action</td>
                                    </thead>

                                <?php include('retrieve_employee_time_table_management.php');?>
                                </table>

                            </div>
                            <div class="col-lg-4">
                                <b><h2 style="text-align: center;">Employee Time Form</h2></b>
                                <form method="POST" action="submit_employee_time.php">

                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <div class="form-material floating">
                                                <input class="form-control" type="text" id="counter_id" name="counter_id" style="text-align: right;" value = "<?php echo $edit_id;?>" readonly>
                                                <label for="counter_id">ID</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <div class="form-material floating">
                                                <input class="form-control" type="text" id="employee_id" name="employee_id" style="text-align: right;" value = "<?php echo $emp_id;?>" required>
                                                <label for="employee_id">Employee ID</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <div class="form-material floating">
                                                <input class="form-control" type="text" id="employee_first_name" name="employee_first_name" style="text-align: right;" value = "<?php echo $full_name;?>" readonly>
                                                <label for="employee_first_name">Employee Full Name</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <div class="form-material floating">
                                                <input class="form-control" type="date" id="employee_date" name="employee_date" style="text-align: right;" value = "<?php echo date('Y-m-d', strtotime($date_in_out));?>" required>
                                                <label for="employee_date">Employee Date In/out</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <div class="form-material floating">
                                                <input class="form-control" type="time" id="employee_time" name="employee_time" style="text-align: right;" value = "<?php echo $time_in_out;?>" required>
                                                <label for="employee_time">Employee Time In/Out</label>
                                            </div>
                                        </div>
                                    </div>


                                    <input class="btn btn-success" type="submit" name="submit_employee_time_btn" style="margin-left: 25%;margin-top: 5%;" >
                                    <a href="unset_employee_id.php"><input class="btn btn-danger" type="button" name="clear_time_form" value="Clear From" style="margin-top: 5%;"></a>

                                </form>
                            </div>
                        <!-- .row -->


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
        <script src="assets/js/core/jquery.min.js"></script>
        <script src="assets/js/core/bootstrap.min.js"></script>
        <script src="assets/js/core/jquery.slimscroll.min.js"></script>
        <script src="assets/js/core/jquery.scrollLock.min.js"></script>
        <script src="assets/js/core/jquery.placeholder.min.js"></script>
        <script src="assets/js/app.js"></script>
        <script src="assets/js/app-custom.js"></script>


        <script src="assets/js/plugins/dropzonejs/dropzone.min.js"></script>

        <!-- Page JS Plugins -->
        <script src="assets/js/plugins/datatables/jquery.dataTables.min.js"></script>

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.all.min.js"></script>

        <!-- Page JS Code -->
        <script src="assets/js/pages/base_tables_datatables.js"></script>
        <script type="text/javascript">
            $(document).ready(function(){

                $("#employee_id").focus();

                $("#try_swal").on("click", function(){
                    
                     Swal.fire({
                      icon: 'success',
                      title: 'Custom Collection Added Successfully.',
                      showConfirmButton: false,
                      timer: 1000
                    });
                });
            
            });
        </script>

    </body>

</html>