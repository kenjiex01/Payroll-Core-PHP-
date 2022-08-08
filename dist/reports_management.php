<?php 
session_start();
date_default_timezone_set('Asia/Manila');
$_SESSION['user_id'] = "1";

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

                    <h1 style="font-family: verdana;margin-left: 38%;margin-top: 50px;" >PAYROLL System</h1>
                    <h3><a  href="javascript:void(0)" style="margin-left: 42%;margin-top: -10%;color:#4c51ff;">Basic Frames & Photography</a></h3>
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
                        </ul>
                        <div class="card-block tab-content bg-white">



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

        
});
</script>

</body>

</html>